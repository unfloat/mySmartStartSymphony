<?php

namespace JobBundle\Form;

use Doctrine\DBAL\Platforms\Keywords\KeywordList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title' ,TextType::class)
            ->add('type' , ChoiceType::class,
                array('choices'=>array(
                    'FullTime'=>'FullTime',
                    'PartTime'=>'PartTime',
                    'Internship'=>'Internship',
                    'Temporary'=>'Temporary'
                ),
                    'choices_as_values'=>true,'multiple'=>false))
            ->add('location', TextType::class)
            ->add('minSalary',NumberType::class)
            ->add('maxSalary')
            ->add('description')
            ->add('tags')
            ->add('category',EntityType::class,array('class'=>'OfferBundle\Entity\Category','choice_label'=>'name','multiple'=>false));

    }
    /**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JobBundle\Entity\Job'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobbundle_job';
    }


}
