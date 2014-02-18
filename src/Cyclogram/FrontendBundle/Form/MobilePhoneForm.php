<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

namespace Cyclogram\FrontendBundle\Form;

use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\ExecutionContextInterface;

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
        $builder->add('phone_small', 'text', array(
                 'label'=>'label_phone_small',
                 'attr'=>array(
                         'maxlength'=>3
                         ),
                 'constraints' => new Length(array(
                         'min'=>1,
                         'minMessage'=>'error_min_area_code_length',
                         'max'=>3,
                         'maxMessage'=>'error_max_area_code_length'
                         )),
                'required'=>false
                 ));
        $builder->add('phone_wide' , 'text', array(
                'label'=>'label_phone_wide',
                'attr'=>array(
                        'maxlength'=>11,
                        'minlenght' =>8
                        ),
                'constraints' => array(
                                       new Length(array(
                                                  'min'=>8,
                                                  'minMessage'=>'error_min_phone_code_length',
                                                  'max'=>11,
                                                  'maxMessage'=>'error_max_phone_code_length'
                                                    )),new NotBlank(array(
                                                      'message'=>"error_not_blank_wide_phone"
                                                    ))
                        ),
                'required'=>false
                ));

        $builder->add('sendCode', 'submit', array(
                'label' => 'btn_send_confirmation'
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
                              'cascade_validation' => true,
                              'translation_domain' => 'dashboard',
                              'constraints' => array(
                                        new Callback(array(
                                                        array($this, 'validatePhone')
                                                )
                                       ))
                        ));
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
    
    public function validatePhone($formData, ExecutionContextInterface $context)
    {
        $phone = $formData["phone_small"] . $formData["phone_wide"];
        $count = $this->container->get('doctrine')
        ->getRepository('CyclogramProofPilotBundle:Participant')
        ->checkIfPhoneNotUsed($phone);
    
        if($count)
            $context->addViolationAt('phone_wide',  $this->container->get('translator')->trans('error_mobile_phone_already_registered', array(), 'validators'));
    }
    

}
