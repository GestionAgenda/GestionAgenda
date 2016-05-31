<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;
use EventBundle\Entity\Event as BaseControl;
/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__control")
  */
class Control extends BaseControl
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Effectuate\Effectuate", mappedBy="control")
     */
    private $effectuates;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var float
     *
     * @Assert\Range(
     *      min = 0.5,
     *      max = 10,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     * @ORM\Column(name="coefficient", type="float")
     */
    protected $coefficient;


    public function __construct()
    {
        parent::__construct();
        $this->effectuates = new ArrayCollection();
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

    /**
     * Add effectuate
     *
     * @param \AppBundle\Entity\Effectuate\Effectuate $effectuate
     *
     * @return Control
     */
    public function addEffectuate(\AppBundle\Entity\Effectuate\Effectuate $effectuate)
    {
        $this->effectuates[] = $effectuate;

        return $this;
    }

    /**
     * Remove effectuate
     *
     * @param \AppBundle\Entity\Effectuate\Effectuate $effectuate
     */
    public function removeEffectuate(\AppBundle\Entity\Effectuate\Effectuate $effectuate)
    {
        $this->effectuates->removeElement($effectuate);
    }

    public function getType()
    {
        return "control";
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf($this->title);
    }
}
