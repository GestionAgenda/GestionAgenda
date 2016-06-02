<?php
/**
 * Created by PhpStorm.
 * User: misterpilou
 * Date: 01/06/2016
 * Time: 17:44
 */
// src/AppBundle/FormType/ClasseType.php
namespace AppBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CouncilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder -> add('quarter', EntityType::class, array(
                        'class' => 'AppBundle:Quarter\Quarter',
                        ))
                    -> add('classe', EntityType::class, array(
                    'class' => 'AppBundle:Classe\Classe'
                    ))
                    -> add('comment', TextareaType::class, array(
                        'label' => 'comment', 'required' => true,
                    ))
                    ->add('save', SubmitType::class, array('label' =>'Sauvegarder'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Council\Council',
        ));
    }
}