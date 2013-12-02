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

use Symfony\Component\Validator\Constraints\Callback;

use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\ExecutionContextInterface;

class MailAddressForm extends AbstractType
{
    protected $container;
    protected $phone;
    protected $country_code;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('participantEmail', 'email', array(
                 'label'=>'label_email',
                'constraints' => array(new NotBlank(array(
                        'message'=>"error_not_blank_email"
                )))));
        $builder->add('send', 'submit', array(
                'label' => 'btn_send_confirmation_email'
                ));
    }

    public function getName()
    {
        return 'mail_address';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
                ->setDefaults(
                        array('csrf_protection' => false,
                              'cascade_validation' => true,
                              'translation_domain' => 'register',
                              'constraints' => array(
                                        new Callback(array(
                                                array($this, 'validateEmail')
                                       ))
                        )));
    }

    
    public function validateEmail($formData, ExecutionContextInterface $context)
    {
        $count = $this->container->get('doctrine')
            ->getRepository('CyclogramProofPilotBundle:Participant')
            ->checkIfEmailNotUsed($formData['participantEmail']);
            
        if($count != 1)
            $context->addViolationAt('participantEmail',  $this->container->get('translator')->trans('no_such_email', array(), 'validators'));
    }
    

}
