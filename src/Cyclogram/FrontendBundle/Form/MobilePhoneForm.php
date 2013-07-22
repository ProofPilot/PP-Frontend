<?php

namespace Cyclogram\FrontendBundle\Form;

use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MobilePhoneForm extends AbstractType
{
    protected $container;
    protected $phone;
    protected $country_code;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phone_small', 
                      'text', 
                      array(
                              'attr'=>array('maxlength'=>3),
                              'constraints' => new Length(array(
                                      'min'=>1,
                                      'minMessage'=>'error_min_area_code_length',
                                      'max'=>3,
                                      'maxMessage'=>'error_max_area_code_length'
                                       ))
                        ));
        $builder->add('phone_wide' , 
                      'text', 
                      array(
                              'attr'=>array('maxlength'=>10),
                              'constraints' => new Length(array(
                                      'min'=>8,
                                      'minMessage'=>'error_min_phone_code_length',
                                      'max'=>11,
                                      'maxMessage'=>'error_max_phone_code_length'
                                       ))
                       ));
    }

    public function getName()
    {
        return 'phone';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
                ->setDefaults(
                        array('csrf_protection' => false,
                                'cascade_validation' => true));

    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCountryCode()
    {
        return $this->country_code;
    }

    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

}
