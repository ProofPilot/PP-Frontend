<?php
namespace Cyclogram\FrontendBundle\Form;

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
        $builder->add('participantFirstname', 'text', array('label'=>'firstname'));
        $builder->add('participantLastname', 'text', array('label'=>'lastname'));
        $builder->add('participantAddress1', 'text', array('label'=>'address1'));
        $builder->add('participantAddress2', 'text', array('label'=>'address2'));
        $builder->add('participantZipcode', 'text', array('label'=>'zipcode'));
        $builder->add('cityId', 'hidden');
        $builder->add('city', 'text');
        $builder->add('stateId', 'hidden');
        $builder->add('state', 'text');
    }
    
    public function getName()
    {
        return 'mailing_address';
    }
}