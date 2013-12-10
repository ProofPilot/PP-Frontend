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
namespace Cyclogram\FrontendBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FrontendChoiceTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return 'frontend_entity';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('choice_empty_name'));
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('choice_empty_name', $options)) {
            $parentData = $form->getParent()->getData();
    
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $emptyName = $accessor->getValue($parentData, $options['choice_empty_name']);
            } else {
                $emptyName = null;
            }
    
            $view->vars['choice_empty_name'] = $emptyName;
        }
    }
}
