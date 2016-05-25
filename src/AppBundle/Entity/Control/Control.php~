<?php

namespace AppBundle\Entity\Control;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use APY\DataGridBundle\Grid\Mapping as GRID;
use AppBundle\Entity\Lesson\Lesson;

/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__control")
  */
class Control 
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Effectuate\Effectuate", mappedBy="control")
     */
    private $effectuates;

    /**
    *
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\Lesson\Lesson", inversedBy="control")
    * @ORM\JoinColumn(name="lesson_id", referencedColumnName="id")
    *
    **/
    private $lesson;


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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=55)
     */
    protected $title;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float")
     */
    protected $coefficient;



    public function __construct()
    {
        $this->effectuates = new ArrayCollection();
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
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $coefficient
     * @return $this
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
        return $this;
    }

    /**
     * @return float
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }   

     /**
     * @param $lesson
     * @return $this
     */
   public function setLesson($lesson)
    {
        $this->lesson = $lesson;
        return $this;
    }

    /**
     * @return Lesson
     */
    public function getLesson()
    {
        return $this->lesson;
    }


    /**
     * @return array
     */
    public function getEffectuates()
    {
        return $this->students;
    }

    /**
     * @param $effectuates
     * @return $this
     */
    public function setEffectuates($effectuates)
    {
        $this->effectuates = $effectuates;
        return $this;
    }
}
