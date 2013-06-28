<?php

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