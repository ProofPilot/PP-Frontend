<?php
namespace Cyclogram\FrontendBundle\Form;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints\Collection;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;


class RegistrationForm extends AbstractType
{
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('participantEmail', 'email', array('label'=>'email'));
        $builder->add('participantUsername', 'text', array('label'=>'username'));
        $builder->add('participantPassword', 'repeated',                   
                        array('type' => 'password', 
                              'invalid_message' => 'error_passwords_do_not_match')
                      );     
    }

    public function getName()
    {
        return 'registration';
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'csrf_protection' => false,
                'cascade_validation' => true,
                'data_class' => 'Cyclogram\Bundle\ProofPilotBundle\Entity\Participant',
                'translation_domain' => 'register'
        ));

    }

}