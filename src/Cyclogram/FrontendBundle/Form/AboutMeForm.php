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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Callback;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\ExecutionContextInterface;

class AboutMeForm extends AbstractType
{
    protected $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Country
        $builder->add('country','text', array(
                'label'=>'label_country',
                'required' => false
                ));
        $participant = $this->container->get('security.context')->getToken()->getUser();
        $preffered = 'Select a country';
        $country = $participant->getCountry();
        if (isset($country))
            $preffered = $country->getCountryName();
        $builder->add('countrySelect', 'entity', array(
                'class' => 'CyclogramProofPilotBundle:Country',
                'property' => 'countryName',
                'empty_value' => $preffered,
                'label' =>'label_country_select',
                'required'=>false
                )
            );

        $builder->add('countryConfirm', 'submit', array(
                'label' => 'btn_confirm'
        ));
        
        //Zipcode
        $builder->add('zipcode','text', array(
                'label'=>'label_zipcode',
                'required' => false
        ));
        $builder->add('newzipcode', 'text', array(
                'label'=>'label_zipcode_new',
                'required' => false,
                'attr'=>array(
                        'minLength'=>5,
                        'maxlength'=>10,
                ),
                'constraints' => array( new Regex(array(
                                'pattern' => "/^((\d{5}-\d{4})|\d{5})$/",
                                'match' => true,
                                'message' => "error_not_blank_zipcode"
                        )))
        ));
        $builder->add('zipcodeConfirm', 'submit', array(
                'label' => 'btn_confirm'
        ));
        
        //birthdate
        $builder->add('birthdate','text', array(
                'label'=>'label_birthdate',
                'required' => false
        ));
        
        
        $builder->add('birthdateSelect', 'text', array(
//             'input'  => 'string',
//             'widget' => 'single_text',
            'required'=>false
        ));
        $builder->add('birthdateConfirm', 'submit', array(
                'label' => 'btn_confirm'
        ));
        
        //sex
        $builder->add('sex','text', array(
                'label'=>'label_sex',
                'required'=>false
        ));
        $builder->add('sexSelect', 'choice', array(
                'label'=>'label_sex_main',
                'choices' => array(
                        'male' => 'label_male',
                        'female' => 'label_female',
                        'transgendered' => 'label_transgendered'
                ),
                'data' => 'male',
                'expanded' => true
        ));
        $builder->add('sexConfirm', 'submit', array(
                'label' => 'btn_confirm'
        ));
        
        //interested
        $builder->add('interested','text', array(
                'label'=>'label_interested',
                'required'=>false
        ));
        $builder->add('interestedSelect', 'choice', array(
                'label'=>'label_inresested_main',
                'required'=>false,
                'choices' => array(
                        'm' => 'label_man',
                        'w' => 'label_woman'
                ),
                'expanded' => true,
                'multiple' => true
        ));
        $builder->add('interestedConfirm', 'submit', array(
                'label' => 'btn_confirm'
        ));
        
        //race
        $builder->add('race','text', array(
                'label'=>'label_race',
                'required'=>false
        ));
        $races = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Race')->findAll();
        foreach ($races as $race) {
            $race_chioce[$race->getRaceName()] = $race->getRaceName();
        }
        $builder->add('raceSelect','choice', array(
                'label' => 'label_race_main',
                'required'=>false,
                'choices' => $race_chioce,
                ));
        $builder->add('raceConfirm', 'submit', array(
                'label' => 'btn_confirm'
        ));

        
        $builder->add('validationCheck' , 'hidden');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(
                array('csrf_protection' => false,
                        'cascade_validation' => true,
                        'translation_domain' => 'about_me',
                        'constraints' => array(
                                new Callback(array(
                                        array($this, 'isYearValid'),
                                        array($this, 'isZipcodeValid'),
                                        array($this, 'isInterestedValid'),
                                        array($this, 'isRaceValid')
                                )))
                ));
    }
    
    public function getName()
    {
        return 'about_me';
    }

    public function isYearValid($data, ExecutionContextInterface $context){
        if ($data['validationCheck'] == 'birthdate'){
            if (empty($data['birthdateSelect'])) {
                $context->addViolationAt('[birthdateSelect]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
        }
    }
    
    public function isZipcodeValid($data, ExecutionContextInterface $context){
        if ($data['validationCheck'] == 'zipCode'){
            if (empty($data['newzipcode'])) {
                $context->addViolationAt('[newzipcode]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
        }
    }
    
    public function isRaceValid($data, ExecutionContextInterface $context){
        if ($data['validationCheck'] == 'race'){
            if (empty($data['raceSelect'])) {
                $context->addViolationAt('[raceSelect]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
        }
    }
    
    public function isInterestedValid($data, ExecutionContextInterface $context){
        if ($data['validationCheck'] == 'interested'){
            if (empty($data['interestedSelect'])) {
                $context->addViolationAt('[interestedSelect]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
        }
    }
}
