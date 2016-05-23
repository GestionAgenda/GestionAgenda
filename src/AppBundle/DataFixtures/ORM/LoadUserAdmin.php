<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\User\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadUserAdmin
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserAdmin extends AbstractFixture implements OrderedFixtureInterface
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
        $this->addReference('user', $userAdmin);
    }
    public function getOrder()
    {
        return 1;
    }
}