<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Quarter\Quarter;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
/**
 * Class LoadQuarter
 * @package AppBundle\DataFixtures\ORM
 */
 class LoadQuarter extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$quarter = new Quarter();
    	$quarter -> setLabel('1er Trimestre');
    	$quart = new Quarter();
    	$quart -> setLabel('2nd Trimestre');
    	$quarterback = new Quarter();
    	$quarterback -> setLabel('3rd Trimestre');
    	$manager -> persist($quarter);
    	$manager -> persist($quart);
    	$manager -> persist($quarterback);
    	$manager -> flush();
    	$this -> addReference('1st', $quarter);
    	$this -> addReference('2nd', $quart);
    	$this -> addReference('3rd', $quarterback);
    }
    public function getOrder()
    {
    	return 4;
    }
}