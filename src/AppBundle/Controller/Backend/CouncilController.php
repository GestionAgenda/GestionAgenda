<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Council\Council;
use AppBundle\FormType\CouncilType as CouncilType;

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
 * Class CouncilController
 * @package AppBundle\Controller\Backend
 * @Route("admin")
 */
class CouncilController extends Controller
{
	/**
     * List all users with ApyDataGrid
     *
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/council", name="council_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function indexAction(Request $request)
	{
		$councils = $this->getDoctrine()->getRepository('AppBundle:Council\Council')->findAll();


        return $this->render(':Council:indexCouncil.html.twig', array(
            'councils' => $councils,
        ));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/council/add", name="council_add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
    	$council = new Council();
        $form = $this->createForm(CouncilType::class, $council);
        if ($form->handleRequest($request)->isValid()) {
            try {
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($council);
                $em->flush();
            
                 return $this->redirectToRoute('council_index');
                } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
                }
            }
        return $this->render(':Council:createCouncil.html.twig', array(
            'form' => $form->createView(),
        ));
	}

    /**
     * @param $id
     * @param request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("council/edit/{id}", name = "council_edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id, Request $request)
    {
        $council = $this->getDoctrine() -> getRepository('AppBundle\Entity\Council\Council') -> find($id);
        if (empty($council))
        {
            $this->addFlash('danger', $this->get('translator')->trans('council.not_found'));

            return $this->redirectToRoute('council_index');
        }
        $form = $this->createForm(CouncilType::class, $council);
        $form -> setData($council);
        if ($form->handleRequest($request)->isValid()) {
            try {
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($council);
                $em->flush();
                /*$this->addFlash(
                    'success',
                    $this->get('translator')->trans('council.council_edited', ['%council%' => $council])
                );*/

                return $this->redirectToRoute('council_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render(':Council:createCouncil.html.twig', array(
            'form'=> $form->createView(),
        ));
    }

    /**
     * @param $id
     * @return RedirectResponse
     *
     * @Route("/council/delete/{id}", name="council_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id) 
    {
        $council = $this->getDoctrine()->getRepository('AppBundle:Council\Council')->find($id);
        if (empty($council)) {
            $this->addFlash('danger', $this->get('translator')->trans('council.not_found'));

            return $this->redirectToRoute('council_index');
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($council);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('council.council_deleted', ['%council%' => $council])
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('council_index');
    }
}