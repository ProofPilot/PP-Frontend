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

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\Custom;

use \Doctrine\DBAL\Connection;

class DbCustom
{

    protected $db_conn;

    function __construct()
    {
        $args = func_get_args();

        if(is_array($args) && count($args)>0)
            if($args[0] instanceof Connection) {
                $this->db_conn = $args[0];
            }
            else {
                throw new \Exception('error');
            }

        return $this;
    }

    public function getFactory($entity) {
        $obj = null;
        if ($entity) {
        	$name = "\Cyclogram\Bundle\ProofPilotBundle\Entity\Custom\\$entity";
        	$obj = new $name($this->db_conn);
            return $obj;
        }
    }

}