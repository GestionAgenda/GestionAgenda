<?php
// src/AppBundle/FormType/ClasseType.php
namespace AppBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('degreeTitle', ChoiceType::class, [
                                                        'label' =>'Degré',
                                                        'required' =>true,

                                                        'choices' => [
                                                                                'Seconde' => [
                                                                                    'Générale' => 'Seconde Général'
                                                                                ],
                                                                                'Première' => [
                                                                                    'ES' => 'Premiere ES',
                                                                                    'S' => 'Premiere S',
                                                                                    'L' => 'Premiere L',
                                                                                    'STMG' => 'Premiere STMG'
                                                                                ],
                                                                                'Terminale' => [
                                                                                    'ES' => 'Terminale ES',
                                                                                    'S' => 'Terminale S',
                                                                                    'L' => 'Terminale L',
                                                                                    'STMG' => 'Terminale STMG'
                                                                                ],
                                                                                 'BTS' => [
                                                                                    'SIO' => 'BTS SIO'
                                                                                ],



                                                            /*
                                                             'Seconde' => [
                                                                                    'Seconde Générale' => 'Seconde Général'
                                                                                ],
                                                                                'Première' => [
                                                                                    'Premiere ES' => 'Premiere ES',
                                                                                    'Premiere S' => 'Premiere S',
                                                                                    'Premiere L' => 'Premiere L',
                                                                                    'Premiere STMG' => 'Premiere STMG'
                                                                                ],
                                                                                'Terminale' => [
                                                                                    'Terminale ES' => 'Terminale ES',
                                                                                    'Terminale S' => 'Terminale S',
                                                                                    'Terminale L' => 'Terminale L',
                                                                                    'Terminale STMG' => 'Terminale STMG'
                                                                                ],
                                                                                 'BTS' => [
                                                                                    'BTS SIO' => 'BTS SIO'
                                                                                ]
                                                             */
                                                            ],
                                                            'choices_as_values' => true,
                ])
                ->add('numero', TextType::class, array('label' =>'Numéro', 'required' =>true))
                ->add('save', SubmitType::class, array('label' =>'Sauvegarder'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Classe\Classe',
        ));
    }
}