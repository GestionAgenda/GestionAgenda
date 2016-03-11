<?php
namespace AppBundle\Model;
// ...

use CorentinRegnier\AdminTemplateBundle\Model\UserInterface as ThemeUser;

class UserModel implements  ThemeUser {
    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var \DateTime
     */
    protected $memberSince;

    /**
     * @var bool
     */
    protected $isOnline = false;

    function __construct($username='', $avatar = '', $memberSince = null, $isOnline = true, $name='', $title='')
    {
        $this->avatar      = $avatar;
        $this->isOnline    = $isOnline;
        $this->memberSince = $memberSince ?:new \DateTime();
        $this->username    = $username;
        $this->name        = $name;
        $this->title       = $title;
    }


    /**
     * @param string $avatar
     *
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param boolean $isOnline
     *
     * @return $this
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * @param \DateTime $memberSince
     *
     * @return $this
     */
    public function setMemberSince(\DateTime $memberSince)
    {
        $this->memberSince = $memberSince;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @param string $name
     *
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
     * @param string $firstname
     *
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
     * @param string $title
     *
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
     * @return bool
     */
    public function isOnline()
    {
        return $this->getIsOnline();
    }

    public function getIdentifier() {
        return str_replace(' ', '-', $this->getUsername());
    }
}