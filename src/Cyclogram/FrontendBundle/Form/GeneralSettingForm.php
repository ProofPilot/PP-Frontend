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

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeneralSettingForm extends AbstractType
{
    protected $container;
    protected $factory;
    
    public function __construct(Container $container) {
        $this->container = $container;
        $this->factory = $this->container->get('security.encoder_factory');
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userName', 'text', array(
                'label'=>'label_username'
                ));
        
            $builder->add('newUserName', 'text', array(
                    'label'=>'label_new_user_name',
                    'required' => false
                    ));

            $builder->add('newUserNamePassword', 'password', array(
                    'label'=>'label_new_user_name_pass', 
                    'required' => false
                    ));

            $builder->add('userNameConfirm', 'submit', array(
                    'label' => 'btn_confirm'
                    ));

            $builder->add('validationCheck' , 'hidden');

        $builder->add('password', 'password', array(
                'label'=>'label_password',
                'required' => false,
                'constraints' => new Length(array(
                        'min' => 8
                        ))
                ));

            $builder->add('oldPassword', 'password', array(
                    'label'=>'label_old_password',
                    'required' => false
                    ));

            $builder->add('newPassword', 'repeated', array(
                    'type' => 'password',
                    'required' => false,
                    'invalid_message' => 'password_fields_must_match.',
                    'first_options'  => array(
                            'label' => 'label_new_pass'
                            ),
                    'second_options' => array(
                            'label' => 'label_repeat_pass'
                            ),
                    'constraints' => new Length(array(
                            'min' => 8
                            ))
                    ));

            $builder->add('passwordMobileComfirm', 'text', array(
                    'label'=>'label_password_mobile_confirm',
                    'required' => false,
                    'constraints' => new Length(array(
                            'min' => 4
                            ))
                    ));

            $builder->add('passwordSendSMS', 'submit', array(
                    'label' => 'btn_send_mobile_code'
                    ));

            $builder->add('passwordConfirm', 'submit', array(
                    'label' => 'btn_confirm'
                    ));

        $builder->add('email', 'text', array(
                'label'=>'label_email', 
                'required' => false
                ));

            $builder->add('newEmail', 'repeated', array(
                    'type' => 'text',
                    'label'=>'label_new_email',
                    'required' => false,
                    'invalid_message' => 'email_fields_must_match.',
                    'first_options'  => array(
                            'label' => 'label_new_email'
                            ),
                    'second_options' => array(
                            'label' => 'label_repeat_email'
                            )
                    ));

            $builder->add('emailConfirm', 'submit', array(
                    'label' => 'btn_confirm'
                    ));

        $builder->add('phoneNumber', 'text', array(
                'label'=>'label_phone_number', 
                'required' => false
                ));

            $builder->add('newPhoneNumberSmall', 'text', array(
                    'label'=>'label_new_phone_number_small', 
                    'required' => false,
                    'attr'=>array(
                            'maxlength'=>3
                    ),
                    ));
            
            $builder->add('newPhoneNumberWide', 'text', array(
                    'label'=>'label_new_phone_number_wide',
                    'required' => false,
                    'attr'=>array(
                            'maxlength'=>11
                    ),
            ));

            $builder->add('newPhoneNumberPassword', 'password', array(
                    'label'=>'label_new_phone_number_pass', 
                    'required' => false
                    ));

            $builder->add('newPhoneNumberSMS', 'text', array(
                    'label'=>'label_new_phone_number_sms',
                    'required' => false,'required' => false,
                     'constraints' => new Length(array(
                             'min' => 4
                             ))
                    ));

            $builder->add('phoneSendSMS', 'submit', array(
                    'label' => 'btn_send_mobile_code'
                    ));
            
            $builder->add('phoneConfirm', 'submit', array(
                    'label' => 'btn_confirm'
                    ));
        $builder->add('incentiveEmail', 'text', array(
                'label' => 'label_incentive_email',
                'required' => false
                ));
            $builder->add('newIncentiveEmail', 'repeated', array(
                    'type' => 'text',
                    'label'=>'label_new_incentive_email',
                    'required' => false,
                    'invalid_message' => 'email_fields_must_match.',
                    'first_options'  => array(
                            'label' => 'label_new_incentive_email'
                    ),
                    'second_options' => array(
                            'label' => 'label_repeat_incentive_email'
                    )
            ));
            $builder->add('incentiveEmailConfirm', 'submit', array(
                    'label' => 'btn_confirm'
            ));
            
        $builder->add('language', 'text', array(
                    'label' => 'label_language',
                    'required' => false
            ));
        $locales = $this->container->getParameter('locales');
        foreach ($locales as $locale) {
            $language = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($locale);
            $choice_locales[$locale] = $language->getlanguageName();
        }
            $builder->add('languageSelect', 'choice', array(
                    'choices' => $choice_locales,
                    'label' => 'label_language_select'
                    
            ));
            $builder->add('languageConfirm', 'submit', array(
                    'label' => 'btn_confirm'
            ));
        }
    
    public function getName()
    {
        return 'general_settings';
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'csrf_protection' => false,
                'cascade_validation' => true,
                'translation_domain' => 'general_settings',
                'constraints' => array(
                        new Callback(array(
                                array($this, 'isUserNameValid'),
                                array($this, 'isPasswordValid'),
                                array($this, 'isEmailValid'),
                                array($this, 'isPhoneValid'),
                                array($this, 'isIncentiveEmailValid')
                        ))
                )
        ));
    
    }
    
    public function isUserNameValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        $encoder = $this->factory->getEncoder($participant);
        
        if ($data['validationCheck'] == 'username'){
            if (empty($data['newUserName'])) {
                $context->addViolationAt('[newUserName]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            } else {
                //check if username already exists
                $existing  = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantUsername'=>$data['newUserName']));
                if($existing) {
                     $context->addViolationAt('[newUserName]',$this->container->get('translator')->trans('username_already_registered', array(), 'validators'));
                }
            }

            if (empty($data['newUserNamePassword'])) {
                $context->addViolationAt('[newUserNamePassword]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            
            if (!empty($data['newUserNamePassword'])) { 
                $ecnodedPassword = $encoder->encodePassword($data['newUserNamePassword'], $participant->getSalt());
                if ($ecnodedPassword != $participant->getParticipantPassword()) {
                    $context->addViolationAt('[newUserNamePassword]', $this->container->get('translator')->trans('wrong_pass', array(), 'validators'));
                }
            }
            
        }
    }

    public function isPasswordValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        $encoder = $this->factory->getEncoder($participant);
        
        if ($data['validationCheck'] == 'password-sms'){
            if (empty($data['oldPassword'])) {
                $context->addViolationAt('[oldPassword]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if (!empty($data['oldPassword'])) { 
                $ecnodedPassword = $encoder->encodePassword($data['oldPassword'], $participant->getSalt());
                if($ecnodedPassword != $participant->getParticipantPassword()) {
                    $context->addViolationAt('[oldPassword]', $this->container->get('translator')->trans('wrong_pass', array(), 'validators'));
                }
            }
            if (empty($data['newPassword'])) {
                $context->addViolationAt('[newPassword]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
        }
        if ($data['validationCheck'] == 'password'){
            if (empty($data['passwordMobileComfirm'])){
                $context->addViolationAt('[passwordMobileComfirm]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if(!empty($data['passwordMobileComfirm']) && $data['passwordMobileComfirm'] != $participant->getParticipantMobileSmsCode()){
                $context->addViolationAt('[passwordMobileComfirm]', $this->container->get('translator')->trans('wrong_code', array(), 'validators'));
            }
        }
    }

    public function isEmailValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'email'){
            if (empty($data['newEmail'])){
                $context->addViolationAt('[newEmail]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            } else {
                //check if email already exists
                $existing  = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmail'=>$data['newEmail']));
                if($existing) {
                    $context->addViolationAt('[newEmail]',  $this->container->get('translator')->trans('email_already_registered', array(), 'validators'));
                }
            }
        }
    }

    public function isPhoneValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        $securityContext = $this->container->get('security.context');
        $encoder = $this->factory->getEncoder($participant);
        if ($data['validationCheck'] == 'mobile-sms'){
            
            if (empty($data['newPhoneNumberSmall'])){
                $context->addViolationAt('[newPhoneNumberSmall]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            } elseif (empty($data['newPhoneNumberWide'])) {
                $context->addViolationAt('[newPhoneNumberWide]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            } else{
                //check if phone already exists
                $existing  = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantMobileNumber'=>$data['newPhoneNumberSmall'].$data['newPhoneNumberWide']));
                if($existing) { 
                    $context->addViolationAt('[newPhoneNumberWide]',  $this->container->get('translator')->trans('error_mobile_phone_already_registered', array(), 'validators'));
                }
            }
            
            if (!$securityContext->isGranted('ROLE_FACEBOOK_USER') && !$securityContext->isGranted('ROLE_GOOGLE_USER')){
                
                if(empty($data['newPhoneNumberPassword'])) {
                    $context->addViolationAt('[newPhoneNumberPassword]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
                }
                if (!empty($data['newPhoneNumberPassword'])){ 
                    $ecnodedPassword = $encoder->encodePassword($data['newPhoneNumberPassword'], $participant->getSalt());
                    if($ecnodedPassword != $participant->getParticipantPassword()) {
                        $context->addViolationAt('[newPhoneNumberPassword]',  $this->container->get('translator')->trans('wrong_pass', array(), 'validators'));
                    }
                }
            }
        }
        
        if ($data['validationCheck'] == 'mobile') {
            if (empty($data['newPhoneNumberSMS'])){
                $context->addViolationAt('[newPhoneNumberSMS]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if(!empty($data['newPhoneNumberSMS']) && ($data['newPhoneNumberSMS'] != $participant->getParticipantMobileSmsCode())){
                $context->addViolationAt('[newPhoneNumberSMS]',  $this->container->get('translator')->trans('wrong_code', array(), 'validators'));
            }
        }
    }
    
    public function isIncentiveEmailValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        $securityContext = $this->container->get('security.context');
        if ($data['validationCheck'] == 'incentive'){
            if (empty($data['newIncentiveEmail'])){
                $context->addViolationAt('[newIncentiveEmail]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            } else {
                //check if phone already exists
                $existing  = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantAppreciationEmail'=>$data['newIncentiveEmail']));
                if($existing) {
                    $context->addViolationAt('[newIncentiveEmail]',  $this->container->get('translator')->trans('email_already_registered', array(), 'validators'));
                }
                $existing  = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmail'=>$data['newIncentiveEmail']));
                if($existing) {
                    $context->addViolationAt('[newIncentiveEmail]',  $this->container->get('translator')->trans('email_already_registered', array(), 'validators'));
                }
            }
        }
    }
}