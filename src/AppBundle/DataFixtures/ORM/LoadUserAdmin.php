<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\User\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserAdmin
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserAdmin implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admnagendappe@gmail.com');
        $userAdmin->setEmail('admnagendappe@gmail.com');
        $userAdmin->setFirstname('PrenomAdmin');
        $userAdmin->setLastname('NomAdmin');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEnabled(true);
        $userAdmin->addRole('ROLE_SUPER_ADMIN');
        $userAdmin->setTitle("Administrateur");
        $userAdmin->setIdentifier(1);
        $userAdmin->setMemberSince(new \Datetime());
        $manager->persist($userAdmin);
        $manager->flush();
    }
}