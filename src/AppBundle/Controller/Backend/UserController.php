<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\User\User;
use AppBundle\Form\Type\UserType;

use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\MassAction;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UserController
 * @package AppBundle\Controller\Backend
 * @Route("users")
 */
class UserController extends Controller
{
    /**
     * List all users with ApyDataGrid
     *
     * @param Request $request
     * @return mixed
     *
     * @Route("/client", name="user_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        // GRID
        $source = new Entity('AppBundle:User\User');
        $tableAlias = $source->getTableAlias();
        $source->manipulateQuery(
            function ($query) use ($tableAlias)
            {
                $query->andWhere($tableAlias . '.roles LIKE :role')
                      ->setParameter('role', '%ROLE_CLIENT%');
            }
        );

        $grid = $this->get('grid');
        $grid->setSource($source);
        // GRID ROW ACTIONS
        $rowActionEditUser   = new RowAction("general.edit", "user_edit");
        $rowActionDeleteUser = new RowAction("general.delete", "user_delete", true);
        $rowActionDeleteUser->setConfirmMessage($this->get('translator')->trans('user.delete_confirm'));
        $grid->addRowAction($rowActionEditUser);
        $grid->addRowAction($rowActionDeleteUser);
        // GRID MASS ACTIONS
        $massAction = new MassAction("general.delete", 'AppBundle:Backend\User:deleteMass', true);
        $massAction->setConfirmMessage($this->get('translator')->trans('user.delete_confirm'));
        $grid->addMassAction($massAction);

        return $grid->getGridResponse($request->isXmlHttpRequest() ? '::layout/grid.html.twig' : ':User:index.html.twig');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/add", name="user_add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $user = new User();
        $user->setEnabled(true);
        $form = $this->createForm(UserType::class, $user);

        if ($form->handleRequest($request)->isValid()) {
            try {
                // Check is projects exists in ERP's database
                if (!$this->checkProjects($user)) {
                    return $this->redirectToRoute('user_add');
                }
                // Upload avatar
                if ($user->getAvatar() != null) {
                    $file = $user->getAvatar();
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    $avatarDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/avatar';
                    $file->move($avatarDir, $fileName);
                    $user->setAvatar($fileName);
                }
                // Add User's config
                $user->randomPassword();
                $user->setRoles(['ROLE_CLIENT']);
                $user->setUsername($user->getEmail());
                $this->sendRegistrationMail($user);
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('user.user_added', ['%user%' => $user->getUsername()])
                );

                return $this->redirectToRoute('user_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render(':User:createUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/edit/{id}", name="user_edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User\User')->find($id);
        if (empty($user)) {
            $this->addFlash('danger', $this->get('translator')->trans('user.not_found'));

            return $this->redirectToRoute('user_index');
        }
        $photo = $user->getAvatar();

        $form = $this->createForm(UserType::class, $user);
        $form->setData($user);
        if ($form->handleRequest($request)->isValid()) {
            try {
                // Check is projects exists in ERP's database
                if (!$this->checkProjects($user)) {
                    return $this->redirectToRoute('user_add');
                }
                // Upload avatar
                if ($user->getAvatar() != null) {
                    $file = $user->getAvatar();
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    $avatarDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/avatar';
                    $file->move($avatarDir, $fileName);
                    $user->setAvatar($fileName);
                } else {
                    $user->setAvatar($photo);
                }
                $user->setUsername($user->getEmail());
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('user.user_edited', ['%user%' => $user->getUsername()])
                );

                return $this->redirectToRoute('user_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render(':User:editUser.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $id
     * @return RedirectResponse
     *
     * @Route("/delete/{id}", name="user_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User\User')->find($id);
        if (empty($user)) {
            $this->addFlash('danger', $this->get('translator')->trans('user.not_found'));

            return $this->redirectToRoute('user_index');
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('user.user_deleted', ['%user%' => $user->getUsername()])
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('user_index');
    }

    /*
     * APY DATA GRID MASS ACTIONS
     */

    /**
     * @param $primaryKeys
     * @param $allPrimaryKeys
     * @return RedirectResponse
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteMassAction($primaryKeys, $allPrimaryKeys)
    {
        try {
            $this->getDoctrine()->getRepository('AppBundle:User\User')->deleteMany($primaryKeys)->getQuery()->execute();
            $this->addFlash('success',$this->get('translator')->trans('user.user_mass_deleted'));
        } catch (\Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('user_index');
    }

    /*
     * CONTROLLER'S FUNCTIONS
     */

    /**
     * Check if user's projects exists
     *
     * @param User $user
     * @return bool
     */
    public function checkProjects($user)
    {
        foreach ($user->getProjets() as $key => $value) {
            if (!$this->get('app.manager.project')->findDevis($value)) {
                $this->addFlash(
                    'danger',
                    $this->get('translator')->trans('user.project_not_found', ['%project%' => $value])
                );

                return false;
            }
        }

        return true;
    }

    /**
     * Send email registration
     *
     * @param User $user
     */
    public function sendRegistrationMail($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Inscription au gestionnaire de tickets MentalWorks')
            ->setFrom('noreply@MentalWorks.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'Emails/answerRegistration.email.twig',
                    ['user' => $user, 'pwd' => $user->getPlainPassword()]
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
    }

    /*
     * AJAX FUNCTION
     */

    /**
     * @Route("/autocomplete", name="project_autocomplete")
     */
    public function autocompleteAction(Request $request)
    {
        // TODO: Renommer la fonction en camelCase
        $param = [
            'numeroDevis' => $request->query->get('term'),
            'nomProjet' => $request->query->get('term'),
        ];
        $projects = $this->get('app.manager.project')->findBy($param, "OR");
        $numDevis = [];
        foreach ($projects as $project => $value) {
            $numDevis[] = $value["numeroDevis"];
        }
        $response = new JsonResponse(); 
        $response->setData($numDevis);
        return $response;
    }
}