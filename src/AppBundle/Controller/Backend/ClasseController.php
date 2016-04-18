<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Classe\Classe;
use AppBundle\FormType\ClasseType as ClasseType;

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
 * Class StudentController
 * @package AppBundle\Controller\Backend
 * @Route("admin")
 */
class ClasseController extends Controller
{
    /**
     * List all Classes with ApyDataGrid
     *
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/classe", name="classe_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        // GRID
        //$source = new Entity('AppBundle:Classe\Classe');

        //$grid = $this->get('grid');
        //$grid->setSource($source);
        // GRID ROW ACTIONS
        /*
        $rowActionEditUser   = new RowAction("general.edit", "class_edit");
        $rowActionDeleteUser = new RowAction("general.delete", "class_delete", true);
        $rowActionDeleteUser->setConfirmMessage($this->get('translator')->trans('class.delete_confirm'));
        $grid->addRowAction($rowActionEditUser);
        $grid->addRowAction($rowActionDeleteClass);
        // GRID MASS ACTIONS
        $massAction = new MassAction("general.delete", 'AppBundle:Backend\User:deleteMass', true);
        $massAction->setConfirmMessage($this->get('translator')->trans('class.delete_confirm'));
        $grid->addMassAction($massAction);
        */
        //return $grid->getGridResponse($request->isXmlHttpRequest() ? '::layout/grid.html.twig' : ':Student:indexClasse.html.twig');

        $classes = $this->getDoctrine()->getRepository('AppBundle:Classe\Classe')->findAll();
        if (empty($classes)) {
            $this->addFlash('danger', $this->get('translator')->trans('classe.not_found'));

            return $this->redirectToRoute('classe_index');
        }

        return $this->render(':Classe:indexClasse.html.twig', array(
            'classes' => $classes,
        ));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/classe/add", name="classe_add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);

        if ($form->handleRequest($request)->isValid()) {
            try {
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($classe);
                $em->flush();
                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('classe.classe_added', ['%classe%' => $classe->getDegreeTitle()+$classe->getNumber()])
                );
                return $this->redirectToRoute('classe_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render(':Classe:createClasse.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/classe/edit/{id}", name="classe_edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id, Request $request)
    {
        $classe = $this->getDoctrine()->getRepository('AppBundle:Classe\Classe')->find($id);
        if (empty($classe)) {
            $this->addFlash('danger', $this->get('translator')->trans('classe.not_found'));

            return $this->redirectToRoute('classe_index');
        }

        $form = $this->createForm(ClasseType::class, $classe);
        $form->setData($classe);
        if ($form->handleRequest($request)->isValid()) {
            try {

                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($classe);
                $em->flush();
                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('classe.classe_edited', ['%classe%' => $classe->getDegreeTitle()+$classe->getNumber()])
                );

                return $this->redirectToRoute('classe_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render(':Classe:editClasse.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    /**
     * @param int $id
     *
     * @Route("/classe/show/{id}", name="classe_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction($id)
    {
        $classe = $this->getDoctrine()->getRepository('AppBundle:Classe\Classe')->find($id);
        if (empty($classe)) {
            $this->addFlash('danger', $this->get('translator')->trans('classe.not_found'));

            return $this->redirectToRoute('classe_index');
        }

        return $this->render(':Classe:showClasse.html.twig', array(
            'classe' => $classe,
        ));
    }


    /**
     * @param $id
     * @return RedirectResponse
     *
     * @Route("/classe/delete/{id}", name="classe_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $classe = $this->getDoctrine()->getRepository('AppBundle:Classe\Classe')->find($id);
        if (empty($classe)) {
            $this->addFlash('danger', $this->get('translator')->trans('classe.not_found'));

            return $this->redirectToRoute('classe_index');
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($classe);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('classe.classe_deleted', ['%classe%' => $classe->getDegreeTitle()+$classe->getNumber()])
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('classe_index');
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
    /*public function checkProjects($user)
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
    */

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