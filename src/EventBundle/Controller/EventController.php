<?php

namespace EventBundle\Controller;

use ADesigns\CalendarBundle\Controller\CalendarController as BaseController;
use ADesigns\CalendarBundle\Event\CalendarEvent;
use EventBundle\Entity\Event;
use EventBundle\Form\Type\EventType;
use Symfony\Component\HttpFoundation\Request;

class EventController extends BaseController
{
    public function loadCalendarAction(Request $request)
    {
        $startDatetime = new \DateTime();
        $startDatetime->setTimestamp(strtotime($request->get('start')));

        $endDatetime = new \DateTime();
        $endDatetime->setTimestamp(strtotime($request->get('end')));

        $events = $this->container->get('event_dispatcher')->dispatch(CalendarEvent::CONFIGURE, new CalendarEvent($startDatetime, $endDatetime, $request))->getEvents();

        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->headers->set('Content-Type', 'application/json');

        $return_events = array();

        foreach($events as $event) {
            $return_events[] = $event->toArray();
        }

        $response->setContent(json_encode($return_events));

        return $response;
    }

    public function indexAction(Request $request)
    {
        return $this->render('EventBundle:Event:index.html.twig');
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Event')->findOneById($id);

        if (!$event) {
            throw $this->createNotFoundException(sprintf('L\'événement %d n\'a pas été trouvé', $id));
        }

        return $this->render('EventBundle:Event:show.html.twig', array(
            'event' => $event,
        ));
    }

    public function createAction(Request $request)
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('EventBundle:Event:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Event')->findOneById($id);

        if (!$event) {
            throw $this->createNotFoundException(sprintf('La classe %d n\'a pas été trouvé', $id));
        }

        $form = $this->createForm(EventType::class, $event);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->persist($event);
                $em->flush();

                return $this->redirectToRoute('event_show', array('id' => $event->getId()));
            }
        }

        return $this->render('EventBundle:Event:edit.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Event')->findOneById($id);

        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    private function createDeleteForm($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Event')->findOneById($id);

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
