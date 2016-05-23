<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Student\Student;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadStudent
 * @package AppBundle\DataFixtures\ORM
 */
 class LoadStudent extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$student = new Student();
    	$student -> setFirstname('Corentin');
    	$student -> setLastname('Regnier');
    	$student -> setEmail('corentin.regnier@laposte.net');
    	$student -> setTelephone('06 45 89 66 44');
    	$student -> setClasse(
    		$this->getReference('premiereL')
    	);
		//$student -> setDateNaissance('27-01-1993');
		$student -> setUser(
    		$this->getReference('user')
    	);
		$manager -> persist($student);
		$manager -> flush();
		$this -> addReference('Corentin', $student);
	}
	public function getOrder()
    {
    	return 3;
    }
}