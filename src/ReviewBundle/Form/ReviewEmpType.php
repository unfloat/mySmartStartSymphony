<?php

namespace ReviewBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Range;
use UserBundle\Entity\Employer;
use UserBundle\Entity\Freelancer;

class ReviewEmpType extends AbstractType
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
            ->add('employerReviewedId',EntityType::class, array(
                'class'=>'UserBundle:Employer',
                'choice_label'=>'username',
                'multiple'=>false,
            ))

            ->add('rating',RangeType::class,[
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ]
            ])

            ->add('comment', CKEditorType::class, array(
                    'config' => array(
                        'uiColor' => '#ffffff')
                )
                );
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function($e) {
            if ( $e->getData() instanceof Employer) {
                /* add fields specific to Type1 */
            }
        })->addEventListener(FormEvents::PRE_SUBMIT, function($e) {
            if ($e->getForm()->getData() instanceof Freelancer) {
                /* add fields specific to Type1 */
            }
        });

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReviewBundle\Entity\ReviewEmp'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reviewbundle_reviewemp';
    }


}
