<?php

namespace EventBundle\Controller;

use ADesigns\CalendarBundle\Controller\CalendarController as BaseController;
use ADesigns\CalendarBundle\Event\CalendarEvent;
use EventBundle\Entity\Lesson;
use EventBundle\Form\Type\LessonType;
use Symfony\Component\HttpFoundation\Request;

class LessonController extends BaseController
{

    public function createAction(Request $request)
    {
        $lesson = new Lesson();

        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('EventBundle:Lesson:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->getRepository('EventBundle:Lesson')->findOneById($id);

        if (!$lesson) {
            throw $this->createNotFoundException(sprintf('Le cours %d n\'a pas été trouvé', $id));
        }

        $form = $this->createForm(LessonType::class, $lesson);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->persist($lesson);
                $em->flush();

                return $this->redirectToRoute('event_show', array('id' => $lesson->getId()));
            }
        }

        return $this->render('EventBundle:Lesson:edit.html.twig', array(
            'lesson' => $lesson,
            'form' => $form->createView(),
        ));
    }
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->getRepository('EventBundle:Lesson')->findOneById($id);

        $form = $this->createDeleteForm($lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lesson);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    private function createDeleteForm($id)
    {
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->getRepository('EventBundle:Lesson')->findOneById($id);

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lesson_delete', array('id' => $lesson->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
