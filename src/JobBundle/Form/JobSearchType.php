<?php

namespace JobBundle\Form;

use Doctrine\DBAL\Platforms\Keywords\KeywordList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobSearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('category',EntityType::class,array('class'=>'OfferBundle\Entity\Category','choice_label'=>'name','multiple'=>false));

    }
    /**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobbundle_jobSearch';
    }


}
