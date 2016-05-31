<?php

namespace AppBundle\Entity\Effectuate;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use APY\DataGridBundle\Grid\Mapping as GRID;
use AppBundle\Entity\Control\Control;
use AppBundle\Entity\User\User;



/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__effectuate")
  */
class Effectuate 
{


    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student\Student", inversedBy="effectuates")
    * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
    *
    **/
    private $student;

    /**
    *
    * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Control", inversedBy="effectuates")
    * @ORM\JoinColumn(name="control_id", referencedColumnName="id")
    *
    **/
    private $control;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var float
     *
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     * @ORM\Column(name="note", type="float")
     */
    protected $note;


    /**
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
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
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return float
     */
    public function getNote()
    {
        return $this->note;
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

    /**
     * @param $student
     * @return $this
     */
   public function setStudent($student)
    {
        $this->student = $student;
        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }
}
