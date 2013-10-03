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

use Symfony\Component\Validator\ExecutionContextInterface;

use Symfony\Component\Validator\Constraints\Callback;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints\Collection;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;


class RegistrationForm extends AbstractType
{
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('participantEmail', 'email', array(
                 'label'=>'label_email'
                 ));
        $builder->add('participantUsername', 'text', array(
                'label'=>'label_username'
                ));
        $builder->add('participantPassword', 'repeated', array(
                'type' => 'password',
                'first_options'  => array(
                            'label' => 'label_password'
                            ),
                'second_options' => array(
                            'label' => 'label_repeat_password'
                            ),
                'invalid_message' => 'error_passwords_do_not_match'
                ));  
        $builder->add('timeZone' , 'hidden', array(
                "mapped" => false
                ));
        $builder->add('next', 'submit', array(
                'label'=>'btn_next'
                ));
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
                'translation_domain' => 'register',
                'constraints' => array(
                        new Callback(array(
                                array($this, 'validateEmail'),
                                array($this, 'validateUsername')
                                ))
                )
        ));

    }
    
    public function validateEmail(Participant $participant, ExecutionContextInterface $context)
    {
        $count = $this->container->get('doctrine')
            ->getRepository('CyclogramProofPilotBundle:Participant')
            ->checkIfEmailNotUsed($participant->getParticipantEmail());
        
        if($count)
            $context->addViolationAt('participantEmail',  $this->container->get('translator')->trans('email_already_registered', array(), 'validators'));
    }
    
    public function validateUsername(Participant $participant, ExecutionContextInterface $context)
    {
        $count = $this->container->get('doctrine')
        ->getRepository('CyclogramProofPilotBundle:Participant')
        ->checkIfUsernameNotUsed($participant->getParticipantUsername());
    
        if($count)
            $context->addViolationAt('participantUsername',  $this->container->get('translator')->trans('username_already_registered', array(), 'validators'));
    }

}