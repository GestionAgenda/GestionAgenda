<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Student\Student;
use AppBundle\FormType\StudentType as StudentType;

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
class StudentController extends Controller
{
    /**
     * List all users with ApyDataGrid
     *
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/student", name="student_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        // GRID
        //$source = new Entity('AppBundle:Student\Student');

        //$grid = $this->get('grid');
        //$grid->setSource($source);
        // GRID ROW ACTIONS
        /*
        $rowActionEditUser   = new RowAction("general.edit", "user_edit");
        $rowActionDeleteUser = new RowAction("general.delete", "user_delete", true);
        $rowActionDeleteUser->setConfirmMessage($this->get('translator')->trans('user.delete_confirm'));
        $grid->addRowAction($rowActionEditUser);
        $grid->addRowAction($rowActionDeleteUser);
        // GRID MASS ACTIONS
        $massAction = new MassAction("general.delete", 'AppBundle:Backend\User:deleteMass', true);
        $massAction->setConfirmMessage($this->get('translator')->trans('user.delete_confirm'));
        $grid->addMassAction($massAction);
        */
        //return $grid->getGridResponse($request->isXmlHttpRequest() ? '::layout/grid.html.twig' : ':Student:indexStudent.html.twig');

        $students = $this->getDoctrine()->getRepository('AppBundle:Student\Student')->findAll();
        if (empty($students)) {
            $this->addFlash('danger', $this->get('translator')->trans('student.not_found'));

            return $this->redirectToRoute('student_index');
        }

        return $this->render(':Student:indexStudent.html.twig', array(
            'students' => $students,
        ));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/student/add", name="student_add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        if ($form->handleRequest($request)->isValid()) {
            try {
                // Upload avatar
                if ($student->getAvatar() != null) {
                    $file = $student->getAvatar();
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    $avatarDir = $this->container->getParameter('kernel.root_dir') . '/../web/img/upload/avatar';
                    $file->move($avatarDir, $fileName);
                    $student->setAvatar($fileName);
                }
                else {
                    $student->setAvatar('avatar.png');
                }

                $student->setUser($this->getUser());
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($student);
                $em->flush();
                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('student.student_added', ['%student%' => $student->getFirstname()])
                );

                return $this->redirectToRoute('student_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render(':Student:createStudent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/student/edit/{id}", name="student_edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id, Request $request)
    {
        $student = $this->getDoctrine()->getRepository('AppBundle:Student\Student')->find($id);
        if (empty($student)) {
            $this->addFlash('danger', $this->get('translator')->trans('student.not_found'));

            return $this->redirectToRoute('student_index');
        }
        $photo = $student->getAvatar();

        $form = $this->createForm(StudentType::class, $student);
        $form->setData($student);
        if ($form->handleRequest($request)->isValid()) {
            try {
                // Upload avatar
                if ($student->getAvatar() != null) {
                    $file = $student->getAvatar();
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    $avatarDir = $this->container->getParameter('kernel.root_dir') . '/../web/img/upload/avatar';
                    $file->move($avatarDir, $fileName);
                    $student->setAvatar($fileName);
                } else {
                    $student->setAvatar($photo);
                }

                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($student);
                $em->flush();
                /*$this->addFlash(
                    'success',
                    $this->get('translator')->trans('student.student_edited', ['%student%' => $student])
                );*/

                return $this->redirectToRoute('student_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render(':Student:editStudent.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @param int $id
     *
     * @Route("/student/show/{id}", name="student_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction($id)
    {
        $student = $this->getDoctrine()->getRepository('AppBundle:Student\Student')->find($id);
        if (empty($student)) {
            $this->addFlash('danger', $this->get('translator')->trans('student.not_found'));

            return $this->redirectToRoute('student_index');
        }

        return $this->render(':Student:showStudent.html.twig', array(
            'student' => $student,
        ));
    }
    /**
     * @param $id
     * @return RedirectResponse
     *
     * @Route("/student/delete/{id}", name="student_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $student = $this->getDoctrine()->getRepository('AppBundle:Student\Student')->find($id);
        if (empty($student)) {
            $this->addFlash('danger', $this->get('translator')->trans('student.not_found'));

            return $this->redirectToRoute('student_index');
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('student.student_deleted', ['%student%' => $student])
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('student_index');
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