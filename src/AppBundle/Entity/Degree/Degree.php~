<?php

namespace AppBundle\Entity\Degree;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__degree")
  */
class Degree
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
}