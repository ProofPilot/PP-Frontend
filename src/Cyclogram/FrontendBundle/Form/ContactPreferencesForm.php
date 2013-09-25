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

class ContactPreferencesForm extends AbstractType
{
    protected $container;
    
    public function __construct(Container $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

            $builder->add('userNameConfirm', 'submit', array(
                    'label' => 'btn_confirm'
                    ));

            $builder->add('passwordSendSMS', 'submit', array(
                    'label' => 'btn_send_mobile_code'
                    ));


            $builder->add('phoneConfirm', 'submit', array(
                    'label' => 'btn_confirm'
                    ));
    }
    
    public function getName()
    {
        return 'contact_preferences';
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
                                array($this, 'isPhoneValid')
                        ))
                )
        ));
    
    }
    
    public function isUserNameValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'username'){
            if (empty($data['newUserName'])) {
                $context->addViolationAt('[newUserName]', $this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if (empty($data['newUserNamePassword'])) {
                $context->addViolationAt('[newUserNamePassword]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            $em = $this->container->get('doctrine')->getEntityManager();
            if (!empty($data['newUserName']) && ($participant->getParticipantUsername() == $data['newUserName'])){
                $context->addViolationAt('[newUserName]',$this->container->get('translator')->trans('username_already_registered', array(), 'validators'));
            }
            if (!empty($data['newUserNamePassword']) && $data['newUserNamePassword'] != $participant->getParticipantPassword()) {
                $context->addViolationAt('[newUserNamePassword]', $this->container->get('translator')->trans('wrong_pass', array(), 'validators'));
            }
        }
    }

    public function isPasswordValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'password-sms'){
            if (empty($data['oldPassword'])) {
                $context->addViolationAt('[oldPassword]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if (!empty($data['oldPassword']) && $data['oldPassword'] != $participant->getParticipantPassword()) {
                $context->addViolationAt('[oldPassword]', $this->container->get('translator')->trans('wrong_pass', array(), 'validators'));
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
            }
            if (!empty($data['newEmail']) && ($participant->getParticipantEmail() == $data['newEmail'])){
                $context->addViolationAt('[confirmEmail]',  $this->container->get('translator')->trans('email_already_registered', array(), 'validators'));
            }
        }
    }

    public function isPhoneValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'mobile-sms'){
            if (empty($data['newPhoneNumber'])){
                $context->addViolationAt('[newPhoneNumber]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if (empty($data['newPhoneNumberPassword'])){
                $context->addViolationAt('[newPhoneNumberPassword]',$this->container->get('translator')->trans('please_fill_this_field', array(), 'validators'));
            }
            if (!empty($data['newPhoneNumber']) && ($participant->getParticipantMobileNumber() == $data['newPhoneNumber'])){
                $context->addViolationAt('[newPhoneNumber]',  $this->container->get('translator')->trans('error_mobile_phone_already_registered', array(), 'validators'));
            }
            if (!empty($data['newPhoneNumberPassword']) && $data['newPhoneNumberPassword'] != $participant->getParticipantPassword()) {
                $context->addViolationAt('[newPhoneNumberPassword]',  $this->container->get('translator')->trans('wrong_pass', array(), 'validators'));
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
}