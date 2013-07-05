<?php
namespace Cyclogram\SexProBundle\Form;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationForm extends AbstractType
{
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email');
        $builder->add('username');
        $builder->add('password', 'repeated',                   
                        array('type' => 'password', 
                               'first_name' => "Password",
//                             'second_name' => "Repeat_password",
//                             'options' => array('required'=>false),
                            'invalid_message' => 'The password fields must match.',
                            'first_options'  => array('label' => false),
                            'second_options' => array('label' => 'Confirm Password')));     
    }

    public function getName()
    {
        return 'registration';
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'csrf_protection' => false,
                'cascade_validation' => true
        ));

    }

}