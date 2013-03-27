<?php

namespace Study\AspirinaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('initial')
            ->add('site', 
                    'entity',  
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Site', 
                        'property'=>'number', 
                    )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Study\AspirinaBundle\Entity\Subject'
        ));
    }

    public function getName()
    {
        return 'study_aspirinabundle_subjecttype';
    }
}
