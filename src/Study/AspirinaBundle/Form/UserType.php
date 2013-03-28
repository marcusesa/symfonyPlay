<?php

namespace Study\AspirinaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', 'repeated', array(
                'first_name' => 'Password',
                'second_name' => 'Repeat_Password',
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
            ))
            ->add('active')
            ->add('email', 'email')
            ->add('role', 
                    'entity',  
                    array(
                        'class'=>'Study\AspirinaBundle\Entity\Role', 
                        'property'=>'name', 
                    ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Study\AspirinaBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'study_aspirinabundle_usertype';
    }
}
