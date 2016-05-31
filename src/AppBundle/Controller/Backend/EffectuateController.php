<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Effectuate\Effectuate;
use AppBundle\FormType\EffectuateType as EffectuateType;

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
 * Class EffectuateController
 * @package AppBundle\Controller\Backend
 * @Route("admin")
 */
class EffectuateController extends Controller
{
    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/effectuate/edit/{id}", name="effectuate_edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id, Request $request)
    {
        $effectuate = $this->getDoctrine()->getRepository('AppBundle:Effectuate\Effectuate')->find($id);
        if (empty($effectuate)) {
            $this->addFlash('danger', $this->get('translator')->trans('effectuate.not_found'));

            return $this->redirectToRoute('event_index');
        }

        $form = $this->createForm(EffectuateType::class, $effectuate);
        $form->setData($effectuate);
        if ($form->handleRequest($request)->isValid()) {
            try {

                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($effectuate);
                $em->flush();
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render(':Effectuate:editEffectuate.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/effectuate/add/{id}", name="effectuate_add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction($id,Request $request)
    {
        $control = $this->getDoctrine()->getRepository('EventBundle:Control')->find($id);
        $students = $this->getDoctrine()->getRepository('AppBundle:Student\Student')->findByClasse($control->getClasse()->getId());
        $effectuate = new Effectuate();
        $effectuate->setControl($control);
        $form = $this->createForm(EffectuateType::class, $effectuate);
        
        if ($form->handleRequest($request)->isValid()) {
            try {
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($effectuate);
                $em->flush();
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render(':Effectuate:editEffectuate.html.twig', array(
            'form' => $form->createView(),
            'effectuate' =>$effectuate,
        ));
    }
}