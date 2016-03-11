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
     * @ORM\Column(name="numero", type="integer", length=55)
     */
    protected $numero;



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
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    
}