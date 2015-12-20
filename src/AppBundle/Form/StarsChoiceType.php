<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Evaluation;

class StarsChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices'  => $this->getStarsChoiceArray(),
            // *this line is important*
            'choices_as_values' => true,
            'placeholder' => 'Combien d\'étoile ?',
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'stars_choice_evaluation';
    }

    protected function getStarsChoiceArray($number = null)
    {
        if (!isset($number) || is_int($number)) {
            $number = Evaluation::STARS_NUMBER;
        }

        $choice_array = array();
        for ($i=0; $i <= $number; $i++) {
            $index = strval($i);
            $choice_array[$index] = $i;
        }

        return $choice_array;
    }
}
