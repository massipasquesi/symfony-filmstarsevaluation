<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('avatarFile', 'file');
        $builder->add('first_name');
        $builder->add('last_name');
        $builder->add('categories_choices', new UserChoiceCategoryType() );
        $builder->add('age_range', 'entity', array(
            'class'     => 'AppBundle:AgeRange',
            'choice_label' => 'age',
            'expanded'  => false,
            'multiple'  => false
        ));
    }

    public function getParent()
    {
        //return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
