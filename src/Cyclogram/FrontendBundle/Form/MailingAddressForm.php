<?php
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

class MailingAddressForm extends AbstractType
{
    protected $container;
    protected $participant;
    
    public function __construct(Container $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('participantFirstname', 'text', array(
                 'label'=>'label_firstname',
                 'constraints' => new NotBlank(array(
                          'message'=>"error_not_blank_name"
                           ))
                 ));
        $builder->add('participantLastname', 'text', array(
                 'label'=>'label_lastname',
                 'constraints' => new NotBlank(array(
                         'message'=>"error_not_blank_lastname"
                         ))
                 ));
        $builder->add('participantAddress1', 
                      'text', array(
                              'label'=>'label_address1',
                              'constraints' => new NotBlank(array(
                                      'message'=>"error_not_blank_street1"
                                      ))
                              ));
        $builder->add('participantAddress2', 'text', array(
                 'label'=>'label_address2', 
                 'required'=>false
                ));
        $builder->add('participantZipcode', 'text', array(
                'label'=>'label_zipcode',
                'attr'=>array(
                        'minLength'=>5,
                        'maxlength'=>10,
                        ),
                'constraints' => array(new NotBlank(array(
                       'message'=>"error_not_blank_zipcode"
                        )),
                        new Regex(array(
                                'pattern' => "/^((\d{5}-\d{4})|\d{5})$/",
                                'match' => true,
                                'message' => "error_not_blank_zipcode"
                                )))
                ));
        $builder->add('cityId', 'hidden');
        $builder->add('city', 'text', array(
                'label'=>'label_city',
                'constraints' => new NotBlank(array(
                        'message'=>"error_not_blank_city"
                         ))
                ));
        $builder->add('stateId', 'hidden');
        $builder->add('state', 'text', array(
                 'label'=>'label_state',
                'attr'=>array(
                        'minlength'=>2,
                        'maxlength'=>2
                ),
                 'constraints' => array(new NotBlank(array(
                          'message'=>"error_not_blank_state"
                           )),
                         new Length(array(
                                 'min'=> 2,
                                 'max'=> 2,
                                 'exactMessage'=>'error_state_length',
                         )))
                 ));

        $builder->add('sign', 'choice', array(
                'label'=>'label_sign_main',
                'choices' => array(
                        'notSign' => 'label_not_sign',
                        'sign' => 'label_sign'
                        ),
                'expanded' => true,
                'constraints' => new NotBlank(array(
                        'message'=>"error_not_blank_choice"
                ))
        ));
        $builder->add('saveMailingAddress', 'submit', array(
                'label' => 'btn_save_mailing_address'
                ));
    }
    
    public function getName()
    {
        return 'mailing_address';
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'csrf_protection' => false,
                'cascade_validation' => true,
                'translation_domain' => 'register',
                'constraints' => array(
                        new Callback(array(
                                array($this, 'isValidState'),
                                array($this, 'isValidCity')
                        ))
                )
        ));
    
    }
    
    public function isValidState($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if (empty($data['stateId'])){
            if (!empty($data['state'])) {
                $context->addViolationAt('[state]', $this->container->get('translator')->trans('error_not_blank_state', array(), 'validators'));
            }
        }
    }
    
    public function isValidCity($data, ExecutionContextInterface $context){
        $participant = $this->container->get('security.context')->getToken()->getUser();
        if (empty($data['cityId'])){
            if (!empty($data['city'])) {
                 $context->addViolationAt('[city]', $this->container->get('translator')->trans('incorrect_city', array(), 'validators'));
            }
        }
    }
}