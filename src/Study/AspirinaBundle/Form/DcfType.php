<?php

namespace Study\AspirinaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DcfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('site',
                  'entity',  
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Site', 
                        'property'=>'number', 
                    ))
            ->add('subject',
                  'entity',  
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Subject', 
                        'property'=>'initial', 
                    ))
            ->add('visit', 
                    'entity', 
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Visit', 
                        'property'=>'title', 
                    ))
            ->add('section',
                    'entity',  
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Section', 
                        'property'=>'title', 
                    ))
            ->add('type')
            ->add('question')
            ->add('comments')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Study\AspirinaBundle\Entity\Dcf'
        ));
    }

    public function getName()
    {
        return 'study_aspirinabundle_dcftype';
    }
}
