<?php

namespace EventBundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class CalendarEventListener
{
    private $entityManager;
    private $router;
    public function __construct(EntityManager $entityManager, Router $router)
    {
        $this->router=$router;
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $events = $this->entityManager->getRepository('EventBundle:Event')
            ->createQueryBuilder('e')
            ->where('e.startDatetime BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
            ->getQuery()->getResult();

        foreach($events as $event) {

            // create an event with a start/end time, or an all day event
            if ($event->getAllDay() === false) {
                $eventEntity = new EventEntity(
                    $event->getTitle(),
                    $event->getStartDatetime(),
                    $event->getEndDatetime()
                );
            }
            else {
                $eventEntity = new EventEntity(
                    $event->getTitle(),
                    $event->getStartDatetime(),
                    null,
                    true
                );
            }

            //optional calendar event settings
            $eventEntity->setAllDay($event->getAllDay());
            $eventEntity->setBgColor($event->getBgColor());
            $eventEntity->setUrl(
                $this->router->generate('event_show', array(
                    'id' => $event->getId()
                    ))
                );
            /*
            if ('exam' == $event->getType()) {
                $eventEntity->setUrl(
                    $this->router->generate('exam_show', array(
                        'id' => $event->getId()
                    ))
                );
            } else {
                $eventEntity->setUrl(
                    $this->router->generate('lesson_show', array(
                        'id' => $event->getId()
                    ))
                );
            }*/

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }
    }
}
