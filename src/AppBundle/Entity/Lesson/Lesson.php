<?php

namespace AppBundle\Entity\Lesson;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use APY\DataGridBundle\Grid\Mapping as GRID;
use AppBundle\Entity\Classe\Classe;

/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__cours")
  */
class Lesson 
{


    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe\Classe", inversedBy="lessons")
    * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
    *
    **/
    private $classe;

    /**
    *
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\Control\Control", mappedBy="lesson")
    *
    **/
    private $control;

    /**
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var time
     *
     * @ORM\Column(name="hourStart", type="time", length=55)
     */
    protected $hourStart;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var time
     *
     * @ORM\Column(name="hourEnd", type="time", length=55)
     */
    protected $hourEnd;


    public function __construct()
    {
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $date
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $hourStart
     * @return $this
     */
    public function setHourStart(\Time $hourStart)
    {
        $this->hourStart = $hourStart;
        return $this;
    }

    /**
     * @return time
     */
    public function getHourStart()
    {
        return $this->hourStart;
    }

    /**
     * @param $hourEnd
     * @return $this
     */
    public function setHourEnd(\Time $hourEnd)
    {
        $this->hourEnd = $hourEnd;
        return $this;
    }

    /**
     * @return time
     */
    public function getHourEnd()
    {
        return $this->hourEnd;
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

    /**
     * @param $control
     * @return $this
     */
   public function setControl($control)
    {
        $this->control = $control;
        return $this;
    }

    /**
     * @return Control
     */
    public function getControl()
    {
        return $this->control;
    }

    
}
