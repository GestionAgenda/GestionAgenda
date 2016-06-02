<?php

namespace AppBundle\Entity\Council;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__council")
  */
class Council
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
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Quarter\Quarter", inversedBy="councils")
    * @ORM\JoinColumn(name="quarter_id", referencedColumnName="id")
    *
    **/
    private $quarter;

    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe\Classe", inversedBy="councils")
    * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
    *
    **/
    private $classe;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;


     public function __construct()
    {
        $this->effectuates = new ArrayCollection();
        $this->councils = new ArrayCollection();
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
     * Set comment
     *
     * @param string $comment
     *
     * @return Council
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set quarter
     *
     * @param \AppBundle\Entity\Quarter\Quarter $quarter
     *
     * @return Council
     */
    public function setQuarter(\AppBundle\Entity\Quarter\Quarter $quarter = null)
    {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return \AppBundle\Entity\Quarter\Quarter
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * Set classe
     *
     * @param \AppBundle\Entity\Classe\Classe $classe
     *
     * @return Classe
     */
    public function setClasse(\AppBundle\Entity\Classe\Classe $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \AppBundle\Entity\Classe\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }


}
