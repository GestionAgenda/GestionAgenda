<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Classe\Classe;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
/**
 * Class LoadClass
 * @package AppBundle\DataFixtures\ORM
 */
 class LoadClass extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$class = new Classe();
    	$class -> setDegreeTitle('Seconde');
    	$class -> setNumber(1);
    	$classe = new Classe();
    	$classe -> setDegreeTitle('Première L');
    	$classe -> setNumber(1);
    	$manager -> persist($class);
    	$manager -> persist($classe);
    	$manager-> flush();
    	$this -> addReference('premiereL', $classe);
    	$this -> addReference('seconde', $class);
    }
    public function getOrder()
    {
    	return 2;
    }
}