<?php
namespace Cyclogram\FrontendBundle\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

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
        $builder->add('userName', 'text',
                    array(
                        'label'=>'label_username',
                        'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                ));
            $builder->add('newUserName', 'text',
                    array(
                            'label'=>'label_new_user_name',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                    ));
            $builder->add('newUserNamePassword', 'text',
                    array(
                            'label'=>'label_new_user_name_pass',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                    ));

        $builder->add('password', 'password',
                array(
                        'label'=>'label_password',
                        'constraints' => array( new NotBlank(array('message'=>"error_not_blank"),
                                                new Length(array('min' => 8))))));
            $builder->add('oldPassword', 'password',
                    array(
                            'label'=>'label_old_password',
                            'constraints' => array( new NotBlank(array('message'=>"error_not_blank"),
                                                    new Length(array('min' => 8))))));
            $builder->add('newPassword', 'repeated',
                    array('type' => 'password',
                          'invalid_message' => 'password_fields_must_match.',
                          'first_options'  => array('label' => 'label_new_pass'),
                          'second_options' => array('label' => 'label_repeat_pass'),
                          'constraints' => new NotBlank(array('message'=>"error_not_blank"),
                                           new Length(array('min' => 8)))));

        $builder->add('email', 'text',
                    array(
                        'label'=>'label_email',
                        'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                ));
            $builder->add('newEmail', 'text',
                    array(
                            'label'=>'label_new_email',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                    ));
            $builder->add('confirmEmail', 'text',
                    array(
                            'label'=>'label_confirm_email',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                    ));

        $builder->add('phoneNumber', 'text',
                array(
                        'label'=>'label_phone_number',
                        'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                    ));
            $builder->add('newPhoneNumber', 'text',
                    array(
                            'label'=>'label_new_phone_number',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                ));
            $builder->add('newPhoneNumberPassword', 'text',
                    array(
                            'label'=>'label_new_phone_number_pass',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                    ));
            $builder->add('newPhoneNumberSMS', 'text',
                    array(
                            'label'=>'label_new_phone_number_sms',
                            'constraints' => array ( new NotBlank(array('message'=>"error_not_blank")),
                                                     new Length(array('min' => 4) ))));
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
        ));
    
    }
}