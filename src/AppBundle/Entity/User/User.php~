<?php

namespace AppBundle\Entity\User;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Student\Student;

/**
  * @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserRepository")
  * @ORM\Table(name="agenda__user")
  */
class User extends BaseUser
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Student\Student", mappedBy="user")
     */
    private $students;
    /**
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    protected $roles;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=55)
     */
    protected $lastname;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=55)
     */
    protected $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="member_since", type="datetime")
     *
     * @Assert\DateTime()
     *
     */
    protected $memberSince;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="identifier", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $identifier;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=55)
     */
    protected $firstname;

    /**
     * @Assert\Regex("#^0[1-9]([ ][0-9]{2}){4}$#", message = " Le numéro de téléphone est invalide, syntaxe tolérée : 01 53 78 99 99.")
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=55, nullable=true)
     */
    protected $telephone;

    protected $username;

    /**
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Email(
     *     message = "L'email {{ value }} n'est pas valide.",
     *     checkMX = true,
     *     checkHost = true
     * )
    */
    protected $email;

    protected $enabled;

    protected $confirmationToken;

    /**
     *
     * @var image
     *
     * @ORM\Column(name="avatar", type="string", length=55, nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg","image/png"},
     *      maxSize = "1024k",
     *      mimeTypesMessage = "Erreur,veuillez télécharger un image valide format jpg,png d'un poid de 1024k."
     * )
     */
    protected $avatar;


    public function __construct()
    {
        parent::__construct();
        $this->students = new ArrayCollection();
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
     * @param $prenom
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
     * @param $name
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * @param $memberSince
     * @return $this
     */
    public function setMemberSince($memberSince)
    {
        $this->memberSince = $memberSince;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param $memberSince
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
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
     * @param int $length
     * @return string
     */
    public function randomPassword( $length = 8 ) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        $this->setPlainPassword($password);
        return $password;
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
}
