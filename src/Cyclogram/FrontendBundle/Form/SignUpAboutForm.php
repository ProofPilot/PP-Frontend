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

        $builder->add('countrySelect', new Type\FrontendEntityType( $this->container->get('doctrine')), array(
                'class' => 'CyclogramProofPilotBundle:Country',
                'property' => 'countryName',
                'label' => $this->container->get('translator')->trans('label_country_select', array(), 'signup_about'),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
                )
            );
        $builder->add('zipcode', 'text', array(
                'label'=> $this->container->get('translator')->trans('label_zipcode', array(), 'signup_about'),
                'data' => $this->container->get('translator')->trans('postcode_text', array(), 'signup_about'),
        ));
        
        $builder->add('daysSelect', new Type\FrontendChoiceType( $this->container->get('doctrine')), array(
                'label'=> $this->container->get('translator')->trans('label_day_main', array(), 'signup_about'),
                'choices' => array(
                        'days' => range(1,31),
                ),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));
        
        $builder->add('monthsSelect', new Type\FrontendChoiceType( $this->container->get('doctrine')), array(
                'label'=> $this->container->get('translator')->trans('label_monthmain', array(), 'signup_about'),
                'choices' => array(
                        'months' => range(1,12),
                ),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));

        
        $builder->add('yearsSelect', new Type\FrontendChoiceType( $this->container->get('doctrine')), array(
                'label'=> $this->container->get('translator')->trans('label_year_main', array(), 'signup_about'),
                'choices' => array(
                        'years' => range(1950,date("Y")),
                ),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));

        
        $builder->add('gradeSelect',new Type\FrontendEntityType( $this->container->get('doctrine')), array(
                'class' => 'CyclogramProofPilotBundle:GradeLevel',
                'property' => 'gradeLevelName',
                'label'=> $this->container->get('translator')->trans('label_grade_level_main', array(), 'signup_about'),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));
        
        $builder->add('industrySelect',new Type\FrontendEntityType( $this->container->get('doctrine')), array(
                'class' => 'CyclogramProofPilotBundle:Industry',
                'property' => 'industryName',
                'label'=> $this->container->get('translator')->trans('label_industry_main', array(), 'signup_about'),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));
        
        $builder->add('anunalIncome', 'text', array(
                'label'=> $this->container->get('translator')->trans('label_annual_income', array(), 'signup_about'),
                'data' => $this->container->get('translator')->trans('annual_income_text', array(), 'signup_about'),
        ));
        
        $builder->add('maritalStatusSelect',new Type\FrontendEntityType( $this->container->get('doctrine')), array(
                'class' => 'CyclogramProofPilotBundle:MaritalStatus',
                'property' => 'maritalStatusName',
                'label'=> $this->container->get('translator')->trans('label_marital_status_main', array(), 'signup_about'),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));
        
        $builder->add('sexSelect',new Type\FrontendEntityType( $this->container->get('doctrine')), array(
                'class' => 'CyclogramProofPilotBundle:Sex',
                'property' => 'sexName',
                'label'=> $this->container->get('translator')->trans('label_sex_main', array(), 'signup_about'),
                //'empty_value' => 'sex',
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));
        
        $builder->add('childrenSelect', new Type\FrontendChoiceType( $this->container->get('doctrine')), array(
                'label'=> $this->container->get('translator')->trans('label_children_main', array(), 'signup_about'),
                'choices' => array(
                        'have' => 'label_have',
                        'nothave' => 'label_do_not_have',
                ),
                'required'=>false,
                'expanded' =>true,
                'multiple' => false
        ));
        
        $builder->add('interestedSelect', new Type\FrontendChoiceType( $this->container->get('doctrine')), array(
                'label'=> $this->container->get('translator')->trans('label_inresested_main', array(), 'signup_about'),
                'required'=>false,
                'choices' => array(
                        'm' => 'label_man',
                        'w' => 'label_woman',
                        'mw' => 'label_man_woman'
                ),
                'expanded' => true,
                'multiple' => false
        ));
        
        $builder->add('raceSelect',new Type\FrontendEntityType( $this->container->get('doctrine')), array(
                'class' => 'CyclogramProofPilotBundle:Race',
                'property' => 'raceName',
                'label'=> $this->container->get('translator')->trans('label_race_main', array(), 'signup_about'),
                'required'=>false,
                'multiple' => true,
                'expanded' => true,
//                 'choice_empty_name' => 'race'
                ));

        $builder->add('confirm', 'submit', array(
                'label' => 'btn_confirm',
                
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(
                array('csrf_protection' => false,
                        'cascade_validation' => true,
                        'translation_domain' => 'db',
                        'constraints' => array(
                                new Callback(array(

                                        array($this, 'isDateValid'),


                                )))
                ));
    }
    
    public function getName()
    {
        return 'signup_about';
    }


    public function isDateValid($data, ExecutionContextInterface $context){
        if (!empty($data['yearsSelect']) || !empty($data['monthsSelect']) || !empty($data['daysSelect'])) {
            $date = new \DateTime();
            if (!$date->setDate($data['yearsSelect'], $data['monthsSelect'], $data['daysSelect'])){
                if (empty($data['birthdateSelect'])) {
                    $context->addViolationAt('[monthsSelect]', $this->container->get('translator')->trans('date_not_valid', array(), 'validators'));
                }


            }
        }
    }
}
