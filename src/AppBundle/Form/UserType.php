<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\MovieSelectorType;
use AppBundle\Form\DataTransformer\MovieToStringTransformer;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email')
            ->add('username', 'text')
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ));

        $builder->add('avatar', new AvatarType());
        $builder->add('first_name');
        $builder->add('last_name');
        $builder->add('categories', 'entity', array(
            'class'         => 'AppBundle:Category',
            'choice_label'  => 'name',
            'expanded'      => false,
            'multiple'      => true
        ));
        $builder->add('age_range', 'entity', array(
            'class'     => 'AppBundle:AgeRange',
            'choice_label' => 'age',
            'expanded'  => false,
            'multiple'  => false
        ));
        $builder->add('evaluations', 'collection', array('type' => new MovieEvaluationType()));

        /**
         * @todo : move submit to template
         */
        $builder->add('save', 'submit', array('label' => 'Register'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'app_user';
    }
}
