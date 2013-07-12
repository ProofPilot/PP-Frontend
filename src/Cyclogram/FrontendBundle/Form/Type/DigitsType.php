<?php
namespace Cyclogram\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class DigitsType extends AbstractType
{
    public function getParent()
    {
        return 'text';
    }
    
    public function getName()
    {
        return 'digits';
    }
    
}
