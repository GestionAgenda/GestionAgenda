<?php

namespace EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', Type\TextType::class)
            ->add('url', Type\TextType::class)
            ->add('bgColor', Type\HiddenType::class)
            ->add('startDatetime', Type\DateType::class)
            ->add('endDatetime', Type\DateType::class)
            ->add('type', Type\TextType::class)
            ->add('allDay', Type\CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EventBundle\Entity\Event'
        ));
    }
}
