<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

/**
 * @author MaSsI00 <massipasquesi@gmail.com>
 */
class MovieSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'required' => false,
        ));
        $builder->add('director', 'text', array(
            'required' => false,
        ));
        $builder->add('year', 'text', array(
            'required' => false,
        ));
        $builder->add('user', 'entity', array(
            'class'         => 'AppBundle:User',
            'choice_label'  => 'username',
            'expanded'      => false,
            'multiple'      => false,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Movie'
        ));
    }

    public function getName()
    {
        return 'movie_search';
    }
}
