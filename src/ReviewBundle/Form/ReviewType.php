<?php

namespace ReviewBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('projectId',EntityType::class, array(
            'class'=>'ProjectBundle:Project',
            'choice_label'=>'projectName',
            'multiple'=>false,
        ))

            ->add('onBudget',ChoiceType::class,
                array('choices'=> array(
                    'Yes' => '1',
                    'No' => '0'),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true))
            ->add('onTime',ChoiceType::class,
                array('choices'=> array(
                    'Yes' => '1',
                    'No' => '0'),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true))
            ->add('rating',RangeType::class,[
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ]
            ])
            ->add('comment', TextareaType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReviewBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reviewbundle_review';
    }


}
