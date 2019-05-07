<?php

namespace ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projectName')
            ->add('idCategory',EntityType::class,array(
                'class'=>'OfferBundle:Category',
                'choice_label'=>'name',
                'multiple'=>false,
            ))
            ->add('idSkill',EntityType::class,array(
                'class'=>'OfferBundle:Skills',
                'choice_label'=>'name',
                'multiple'=>false,
            ))
            ->add('projectLocation')
            ->add('minBudget')
            ->add('maxBudget')
            ->add('projectEndDay')
            ->add('projectDescription')
            ->add('address');

        $builder->add('projectName')->add('projectLocation')->add('minBudget')->add('maxBudget')->add('projectDescription')->add('validityPeriod');



    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_project';
    }


}
