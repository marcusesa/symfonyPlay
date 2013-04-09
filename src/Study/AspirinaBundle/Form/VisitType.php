<?php

namespace Study\AspirinaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VisitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('alias')
            ->add('sections', 
                    'entity',
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Section', 
                        'property'=>'title', 
                        'multiple' => true,
                    ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Study\AspirinaBundle\Entity\Visit'
        ));
    }

    public function getName()
    {
        return 'study_aspirinabundle_visittype';
    }
}
