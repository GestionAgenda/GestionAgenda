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
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Control\Control", inversedBy="effectuates")
    * @ORM\JoinColumn(name="control_id", referencedColumnName="id")
    *
    **/
    private $control;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    protected $note;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    protected $comment;


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
     * @param $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
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
