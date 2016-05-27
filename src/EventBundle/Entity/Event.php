<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ADesigns\CalendarBundle\Entity\EventEntity as BaseEvent;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"lesson" = "Lesson", "control" = "Control"})
 */
abstract class Event extends BaseEvent
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe\Classe", inversedBy="events")
    * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
    *
    **/
    private $classe;


    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

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
     * @ORM\Column(type="array", nullable=true)
     */
    protected $otherFields;


    public function __construct()
    {}
    

    

    /**
     * Set otherFields
     *
     * @param array $otherFields
     *
     * @return Event
     */
    public function setOtherFields($otherFields)
    {
        $this->otherFields = $otherFields;

        return $this;
    }

    /**
     * Get otherFields
     *
     * @return array
     */
    public function getOtherFields()
    {
        return $this->otherFields;
    }

        /**
     * @param $classe
     * @return $this
     */
   public function setClasse($classe)
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }
}
