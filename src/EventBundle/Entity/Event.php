<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ADesigns\CalendarBundle\Entity\EventEntity as BaseEvent;

/**
 * @ORM\Entity
 * @ORM\Table(name="agenda__event")
 */
class Event extends BaseEvent
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $bgColor;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $startDatetime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endDatetime;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $allDay;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    protected $otherFields;


    public function __construct()
    {}

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}

