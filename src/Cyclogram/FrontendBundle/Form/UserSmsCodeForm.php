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


class UserSmsCodeForm extends AbstractType
{
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sms_code', 'text', array(
                'label' => 'label_sms_code',
                'constraints' => new Length(array(
                        'min' => 4
                        ))
                ));
        $builder->add('timeZone' , 'hidden', array(
                "mapped" => false
        ));
        $builder->add('confirmCode', 'submit', array(
                'label' => 'btn_confrimcoe_login'
        ));
    }
    
    public function getName()
    {
        return 'sms_confirm';
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'csrf_protection' => false,
                'translation_domain' => 'login'
        ));
    
    }
    
}
