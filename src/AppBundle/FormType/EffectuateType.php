<?php
// src/AppBundle/FormType/EffectuateType.php
namespace AppBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
class EffectuateType extends AbstractType
{
    private $idClasse;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $attributes=$builder->getAttributes(1);
        $attributes=$attributes["data_collector/passed_options"];
        $idClasse=$attributes["data"]->getControl()->getClasse()->getId();

        $builder->add('note', Type\NumberType::class)
                ->add('student', EntityType::class, array(
                            'class' => 'AppBundle:Student\Student',
                            'query_builder' => function (EntityRepository $er) use ($idClasse) {
                                
                                return $er->createQueryBuilder('s')
                                    ->where('s.classe = :idclasse')
                                    ->setParameter(':idclasse', $idClasse );
                            }
                        ))
                ->add('save', SubmitType::class, array('label' =>'Sauvegarder'));
       /* if ($form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $builder->getData();
        }*/
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Effectuate\Effectuate',
        ));
    }
}