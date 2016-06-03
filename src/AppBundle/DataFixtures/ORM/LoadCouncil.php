<?php
/**
 * Created by PhpStorm.
 * User: misterpilou
 * Date: 03/06/2016
 * Time: 08:50
 */

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Council\Council;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
/**
 * Class LoadClass
 * @package AppBundle\DataFixtures\ORM
 */
class LoadCouncil extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $council = new Council();
        $council->setQuarter(
            $this->getReference('1st')
        );
        $council->setClasse(
            $this->getReference('premiereL')
        );
        $council->setComment('Apres un debut d\'année difficile, se réveillent enfin');
        $councilor = new Council();
        $councilor->setQuarter(
            $this->getReference('1st')
        );
        $councilor->setClasse(
            $this->getReference('seconde')
        );
        $councilor->setComment('Enfin une bonne classe, ca fait 10 ans que j\'attend ca');
        $manager->persist($council);
        $manager->persist($councilor);
        $manager->flush();
    }
    public function getOrder()
    {
        return 5;
    }
}