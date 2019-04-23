<?php

namespace ReportBundle\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt', DateType::class, array(
                'format' => \IntlDateFormatter::SHORT,
                'input' => 'datetime',
                'widget' => 'single_text',
                'data' => new \DateTime("now")))


            ->add('text',CKEditorType::class, array(
        'config' => array(
            'uiColor' => '#ffffff')))

            ->add('freelancerReportedId',EntityType::class, array(
                'class'=>'UserBundle:Freelancer',
                'choice_label'=>'firstName',
                'multiple'=>false,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReportBundle\Entity\Report'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reportbundle_report';
    }


}
