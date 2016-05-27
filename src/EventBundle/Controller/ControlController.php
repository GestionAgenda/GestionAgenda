<?php

namespace EventBundle\Controller;

use ADesigns\CalendarBundle\Controller\CalendarController as BaseController;
use ADesigns\CalendarBundle\Event\CalendarEvent;
use EventBundle\Entity\Control;
use EventBundle\Form\Type\ControlType;
use Symfony\Component\HttpFoundation\Request;

class ControlController extends BaseController
{

    public function createAction(Request $request)
    {
        $control = new Control();

        $form = $this->createForm(ControlType::class, $control);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($control);
            $em->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('EventBundle:Control:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $control = $em->getRepository('EventBundle:Control')->findOneById($id);

        if (!$control) {
            throw $this->createNotFoundException(sprintf('Le contrôle %d n\'a pas été trouvé', $id));
        }

        $form = $this->createForm(ControlType::class, $control);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->persist($control);
                $em->flush();

                return $this->redirectToRoute('event_show', array('id' => $control->getId()));
            }
        }

        return $this->render('EventBundle:Control:edit.html.twig', array(
            'control' => $control,
            'form' => $form->createView(),
        ));
    }
}
