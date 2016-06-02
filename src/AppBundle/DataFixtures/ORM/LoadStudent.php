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
    	$studentes = new Student();
    	$studentes -> setFirstname('Corentin');
    	$studentes -> setLastname('Regnier');
    	$studentes -> setEmail('corentin.regnier@laposte.net');
    	$studentes -> setTelephone('06 45 89 66 44');
    	$studentes -> setClasse(
    		$this->getReference('premiereL')
    	);
		$study = new Student();
		$study -> setFirstname('Thibaut');
		$study -> setLastname('Bar');
		$study -> setEmail('thibaut.bar@laposte.net');
		$study -> setTelephone('06 55 89 66 44');
		$study -> setClasse(
			$this->getReference('seconde')
		);
		$studente = new Student();
		$studente -> setFirstname('Artimes');
		$studente -> setLastname('Regnier');
		$studente -> setEmail('artimes.regnier@laposte.net');
		$studente -> setTelephone('06 44 89 66 44');
		$studente -> setClasse(
			$this->getReference('premiereL')
		);
		$stud = new Student();
		$stud -> setFirstname('Corentine');
		$stud -> setLastname('Coquin');
		$stud -> setEmail('corentine.coquin@laposte.net');
		$stud -> setTelephone('06 45 89 65 44');
		$stud -> setClasse(
			$this->getReference('seconde')
		);
		$stude = new Student();
		$stude -> setFirstname('Lenny');
		$stude -> setLastname('Felicite');
		$stude -> setEmail('lenny.felicite@gmail.net');
		$stude -> setTelephone('06 45 89 66 53');
		$stude -> setClasse(
			$this->getReference('premiereL')
		);
		$student = new Student();
		$student -> setFirstname('Madeleine');
		$student -> setLastname('Mamamama');
		$student -> setEmail('mamamama.madeleine@gmail.net');
		$student -> setTelephone('06 45 89 55 44');
		$student -> setClasse(
			$this->getReference('premiereL')
		);
		$studen = new Student();
		$studen -> setFirstname('Julien');
		$studen -> setLastname('Thouin');
		$studen -> setEmail('julien.thouin@hotmail.com');
		$studen -> setTelephone('06 45 89 66 47');
		$studen -> setClasse(
			$this->getReference('seconde')
		);
		//$student -> setDateNaissance('27-01-1993');
		$student -> setUser(
    		$this->getReference('user')
    	);
		$manager -> persist($studen);
		$manager -> persist($student);
		$manager -> persist($stude);
		$manager -> persist($stud);
		$manager -> persist($studente);
		$manager -> persist($study);
		$manager -> persist($studentes);
		$manager -> flush();
		$this -> addReference('Corentin', $student);
		$this -> addReference('Thibaut', $study);
		$this -> addReference('Artimes', $studente);
		$this -> addReference('Corentine', $stud);
		$this -> addReference('Madeleine', $stude);
		$this -> addReference('Julien', $studen);
	}
	public function getOrder()
    {
    	return 3;
    }
}