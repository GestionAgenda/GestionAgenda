<?php

namespace AppBundle\Entity\Quarter;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;



/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__quarter")
  */
class Quarter
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
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=55)
     */
    protected $label;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Council\Council", mappedBy="quarter")
     */
    private $councils;

    public function __construct()
    {
        $this->councils = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s", $this->label);
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
     * @param $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return array
     */
    public function getCouncils()
    {
        return $this->councils;
    }

    /**
     * @param $councils
     * @return $this
     */
    public function setEffectuates($councils)
    {
        $this->councils = $councils;
        return $this;
    }

    /**
     * Add council
     *
     * @param \AppBundle\Entity\Council\Council $council
     *
     * @return Council
     */
    public function addEffectuate(\AppBundle\Entity\Effectuate\Effectuate $council)
    {
        $this->councils[] = $council;

        return $this;
    }

    /**
     * Remove council
     *
     * @param \AppBundle\Entity\Council\Council $council
     */
    public function removeEffectuate(\AppBundle\Entity\Effectuate\Effectuate $council)
    {
        $this->effectuates->removeElement($council);
    }
}
