<?php
namespace Cyclogram\FrontendBundle\Form;

use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailingAddressForm extends AbstractType
{
    protected $container;
    
    public function __construct(Container $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('participantFirstname', 
                      'text', 
                       array(
                              'label'=>'label_firstname',
                               'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                               ));
        $builder->add('participantLastname', 
                      'text', 
                      array(
                              'label'=>'label_lastname',
                              'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                              ));
        $builder->add('participantAddress1', 
                      'text', 
                      array(
                              'label'=>'label_address1',
                              'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                              ));
        $builder->add('participantAddress2', 
                      'text', 
                      array(
                              'label'=>'label_address2', 
                              'required'=>false));
        $builder->add('participantZipcode', 
                      'text', 
                      array('label'=>'label_zipcode',
                            'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                              ));
        $builder->add('cityId', 
                      'hidden');
        $builder->add('city', 
                      'text', 
                      array(
                              'label'=>'label_city',
                              'constraints' => new NotBlank(array('message'=>"error_not_blank"))
                              ));
        $builder->add('stateId', 
                      'hidden');
        $builder->add('state', 
                      'text', 
                      array(
                              'label'=>'label_state',
                              'constraints' => new NotBlank(array('message'=>"error_not_blank"))
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
        ));
    
    }
}