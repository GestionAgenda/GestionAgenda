<?php
// src/AppBundle/FormType/StudentType.php
namespace AppBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, array('label' =>'Prénom', 'required' =>true))
                ->add('lastname', TextType::class, array('label' =>'Nom', 'required' =>true))
                ->add('classe', EntityType::class, array(
                    'class' => 'AppBundle:Classe\Classe',
                ))
                ->add('dateNaissance', BirthdayType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'label' => 'Date de naissance',
                    'required' => false
                ))
                ->add('telephone', TextType::class, array('label' =>'Téléphone', 'required' =>false))
                ->add('email', TextType::class, array('label' =>'E-mail', 'required' =>false))
                ->add('avatar', FileType::class, array('label' =>'Avatar', 'data_class' => null, 'required' =>false))
                ->add('save', SubmitType::class, array('label' =>'Sauvegarder'));
       /* if ($form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $builder->getData();
        }*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Student\Student',
        ));
    }
}