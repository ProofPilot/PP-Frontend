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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Callback;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\ExecutionContextInterface;

class SignUpAboutForm extends AbstractType
{
    protected $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('countrySelect', 'entity', array(
                'class' => 'CyclogramProofPilotBundle:Country',
                'property' => 'countryName',
                'empty_value' => 'country',
                'label' =>'label_country_select',
                'required'=>false
                )
            );
        
        $builder->add('sexSelect', 'entity', array(
                'class' => 'CyclogramProofPilotBundle:Sex',
                'property' => 'sexName',
                'label'=>'label_sex_main',
                'empty_value' => 'sex',
                'required'=>false
        ));
        
        $builder->add('interestedSelect', 'choice', array(
                'label'=>'label_inresested_main',
                'required'=>false,
                'choices' => array(
                        'm' => 'label_man',
                        'w' => 'label_woman'
                ),
                'empty_value' => 'sex preference',
                'expanded' => true,
                'multiple' => true
        ));
        
        $races = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Race')->findAll();
        foreach ($races as $race) {
            $race_chioce[$race->getRaceName()] = $race->getRaceName();
        }
        $builder->add('raceSelect','entity', array(
                'class' => 'CyclogramProofPilotBundle:Race',
                'property' => 'raceName',
                'empty_value' => 'race',
                'label'=>'label_race_main',
                'required'=>false,
                ));

        $builder->add('confirm', 'submit', array(
                'label' => 'btn_confirm'
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(
                array('csrf_protection' => false,
                        'cascade_validation' => true,
                        'translation_domain' => 'signup_about',
                ));
    }
    
    public function getName()
    {
        return 'signup_about';
    }

}
