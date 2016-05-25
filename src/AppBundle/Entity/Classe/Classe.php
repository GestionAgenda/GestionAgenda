<?php

namespace AppBundle\Entity\Classe;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__classe")
  */
class Classe
{

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Student\Student", mappedBy="classe")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lesson\Lesson", mappedBy="classe")
     */
    private $lessons;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="degreeTitle", type="string", length=55)
     */
    protected $degreeTitle;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Range(
     *      min = 1,
     *      max = 10,
     *      minMessage = "Le numéro de la classe ne peut pas être inférieur à 1",
     *      maxMessage = "Le numéro de la classe ne peut pas être supérieur à 10"
     * )
     * @var int
     *
     * @ORM\Column(name="number", type="integer", length=55)
     */
    protected $number;



    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->lessons = new ArrayCollection();
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
     * @param $degreeTitle
     * @return $this
     */
    public function setDegreeTitle($degreeTitle)
    {
        $this->degreeTitle = $degreeTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getDegreeTitle()
    {
        return $this->degreeTitle;
    }

    /**
     * @param $numero
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s - %d", $this->degreeTitle, $this->number);
    }

    /**
     * @return array
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param $students
     * @return $this
     */
    public function setStudents($students)
    {
        $this->students = $students;
        return $this;
    }

    /**
     * @return array
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * @param $lessons
     * @return $this
     */
    public function setLessons($lessons)
    {
        $this->lessons = $lessons;
        return $this;
    }

    /**
     * Add student
     *
     * @param \AppBundle\Entity\Student\Student $student
     *
     * @return Classe
     */
    public function addStudent(\AppBundle\Entity\Student\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \AppBundle\Entity\Student\Student $student
     */
    public function removeStudent(\AppBundle\Entity\Student\Student $student)
    {
        $this->students->removeElement($student);
    }

    /**
     * Add lesson
     *
     * @param \AppBundle\Entity\Lesson\Lesson $lesson
     *
     * @return Classe
     */
    public function addLesson(\AppBundle\Entity\Lesson\Lesson $lesson)
    {
        $this->lessons[] = $lesson;

        return $this;
    }

    /**
     * Remove lesson
     *
     * @param \AppBundle\Entity\Lesson\Lesson $lesson
     */
    public function removeLesson(\AppBundle\Entity\Lesson\Lesson $lesson)
    {
        $this->lessons->removeElement($lesson);
    }
}
