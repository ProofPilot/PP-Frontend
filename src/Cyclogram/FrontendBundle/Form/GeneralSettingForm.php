<?php
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
    
    public function __construct(Container $container) {
        $this->container = $container;
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

            $builder->add('newPhoneNumber', 'text', array(
                    'label'=>'label_new_phone_number', 
                    'required' => false
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
                                array($this, 'isPhoneValid')
                        ))
                )
        ));
    
    }
    
    public function isUserNameValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'username'){
            if (empty($data['newUserName'])) {
                $context->addViolationAt('[newUserName]', 'Please fill this field !');
            }
            if (empty($data['newUserNamePassword'])) {
                $context->addViolationAt('[newUserNamePassword]', 'Please fill this fields !');
            }
            $em = $this->container->get('doctrine')->getEntityManager();
            if (!empty($data['newUserName']) && ($participant->getParticipantUsername() == $data['newUserName'])){
                $context->addViolationAt('[newUserName]', 'User with this username already exist!');
            }
            if (!empty($data['newUserNamePassword']) && $data['newUserNamePassword'] != $participant->getParticipantPassword()) {
                $context->addViolationAt('[newUserNamePassword]', 'Password is wrong!');
            }
        }
    }

    public function isPasswordValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'password-sms'){
            if (empty($data['oldPassword'])) {
                $context->addViolationAt('[oldPassword]', 'Please fill this field !');
            }
            if (!empty($data['oldPassword']) && $data['oldPassword'] != $participant->getParticipantPassword()) {
                $context->addViolationAt('[oldPassword]', 'Password is wrong!');
            }
            if (empty($data['newPassword'])) {
                $context->addViolationAt('[newPassword]', 'Please fill new password and confirm it!');
            }
        }
        if ($data['validationCheck'] == 'password'){
            if (empty($data['passwordMobileComfirm'])){
                $context->addViolationAt('[passwordMobileComfirm]', 'Please fill this field !');
            }
            if(!empty($data['passwordMobileComfirm']) && $data['passwordMobileComfirm'] != $participant->getParticipantMobileSmsCode()){
                $context->addViolationAt('[passwordMobileComfirm]', 'Wrong mobile code!');
            }
        }
    }

    public function isEmailValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'email'){
            if (empty($data['newEmail'])){
                $context->addViolationAt('[newEmail]', 'Please fill this field !');
            }
            if (!empty($data['newEmail']) && ($participant->getParticipantEmail() == $data['newEmail'])){
                $context->addViolationAt('[confirmEmail]', 'This email already exist !');
            }
        }
    }

    public function isPhoneValid($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if ($data['validationCheck'] == 'mobile-sms'){
            if (empty($data['newPhoneNumber'])){
                $context->addViolationAt('[newPhoneNumber]', 'Please fill this field !');
            }
            if (empty($data['newPhoneNumberPassword'])){
                $context->addViolationAt('[newPhoneNumberPassword]', 'Please fill this field !');
            }
            if (!empty($data['newPhoneNumber']) && ($participant->getParticipantMobileNumber() == $data['newPhoneNumber'])){
                $context->addViolationAt('[newPhoneNumber]', 'This mobile number already exist!');
            }
            if (!empty($data['newPhoneNumberPassword']) && $data['newPhoneNumberPassword'] != $participant->getParticipantPassword()) {
                $context->addViolationAt('[newPhoneNumberPassword]', 'Password is wrong!');
            }
        }
        if ($data['validationCheck'] == 'mobile') {
            if (empty($data['newPhoneNumberSMS'])){
                $context->addViolationAt('[newPhoneNumberSMS]', 'Please fill this field !');
            }
            if(!empty($data['newPhoneNumberSMS']) && ($data['newPhoneNumberSMS'] != $participant->getParticipantMobileSmsCode())){
                $context->addViolationAt('[newPhoneNumberSMS]', 'Wrong mobile code!');
            }
        }
    }
}