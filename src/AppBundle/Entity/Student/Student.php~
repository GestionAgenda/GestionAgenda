<?php

namespace AppBundle\Entity\Student;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\User\User;

/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__student")
  * @GRID\Source(columns="id,lastname,firstname,telephone,dateNaissance,email,telephone")
  */
class Student 
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Effectuate\Effectuate", mappedBy="student")
     */
    private $effectuates;

    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="students")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    *
    **/
    private $user;

    /**
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe\Classe", inversedBy="students")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     *
     **/
    private $classe;

    /**
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(field="id", visible=false)
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=55)
     * @GRID\Column(field="lastname",title="Nom : ", operatorsVisible=false)
     */
    protected $lastname;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=55)
     * @GRID\Column(field="firstname",title="Prénom : ", operatorsVisible=false)
     */
    protected $firstname;


    /**
     * @Assert\DateTime()
     *
     * @var datetime
     *
     * @ORM\Column(name="dateNaissance", type="datetime",nullable=true)
     * @GRID\Column(field="dateNaissance",title="Date de naissance : ", operatorsVisible=false)
     */
    protected $dateNaissance;


    /**
     * @Assert\Regex("#^0[1-9]([ ][0-9]{2}){4}$#", message = " Le numéro de téléphone est invalide, syntaxe tolérée : 01 53 78 99 99.")
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=55, nullable=true)
     * @GRID\Column(field="telephone",title="Téléphone : ", operatorsVisible=false)
     */
    protected $telephone;

    /**
     *
     * @var string
     *
     * @Assert\Email(
     *     message = "L'email {{ value }} n'est pas valide.",
     *     checkMX = true,
     *     checkHost = true
     * )
     *
     * @ORM\Column(name="email", type="string", length=150,nullable=true)
     * @GRID\Column(field="email",title="E-mail : ", operatorsVisible=false)
    */
    protected $email;

    /**
     *
     * @var avatar
     *
     * @ORM\Column(name="avatar", type="string", length=55, nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg","image/png","image/gif"},
     *      maxSize = "1024k",
     *      mimeTypesMessage = "Erreur,veuillez télécharger un image valide format jpg,png d'un poid de 1024k."
     * )
     */
    protected $avatar;

    

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
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param $telephone
     * @return $this
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param $dateNaissance
     * @return $this
     */
    public function setDateNaissance(\DateTime $dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return int
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
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
     * @return User
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @return array
     */
    public function getEffectuates()
    {
        return $this->effectuates;
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