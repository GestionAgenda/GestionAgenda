<?php
namespace AppBundle\EventListener;
use AppBundle\Entity\User\User;
use CorentinRegnier\AdminTemplateBundle\Event\ShowUserEvent;
use AppBundle\Model\UserModel;

class MyShowUserListener {


    public function onShowUser(ShowUserEvent $event) {

        $user = $this->getUser();
        $event->setUser($user);

    }

    protected function getUser()
    {
        return new User;
    }

}