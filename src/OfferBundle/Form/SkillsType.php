<?php

namespace OfferBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('category',EntityType::class,array(
                'class'=>'OfferBundle:Category',
                'choice_label'=>'name',
                'multiple'=>false))
            ->add('offer',EntityType::class,array(
                'class'=>'OfferBundle:Offer',
                'choice_label'=>'name',
                'multiple'=>false))
            ->add('save',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OfferBundle\Entity\Skills'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'offerbundle_skills';
    }


}
