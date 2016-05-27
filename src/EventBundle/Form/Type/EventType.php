<?php

namespace EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', Type\TextType::class)
            ->add('bgColor', Type\HiddenType::class)
            ->add('startDatetime', Type\DateTimeType::class,array('data' => new \DateTime("now")))
            ->add('endDatetime', Type\DateTimeType::class,array('data' => new \DateTime("now")))
            ->add('classe', EntityType::class, array(
                    'class' => 'AppBundle:Classe\Classe',
                ))
            ->add('allDay', Type\CheckboxType::class, array('label' =>'Toute la journée','required' => false,));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EventBundle\Entity\Event'
        ));
    }
}
