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
namespace Cyclogram\FrontendBundle\Classes;

use Symfony\Component\DependencyInjection\Container;

class TriggerGenerator
{
    protected $container;
    
    public function __construct($container) {
        $this->container = $container;
    }
    
    public function triggerGenerator() {
         
        $conn = $this->container->get('database_connection');
        //run a query
        $tables = $conn->fetchAll("show tables");
    
    
    
        foreach($tables as $key1 => $value1) {
            #echo "generating trigger for table: {$value1['Tables_in_proofpilot']}";
            $sql = "DELIMITER $$";
            $sql .= $this->_break();
            $sql .= "DROP TRIGGER IF EXISTS history_{$value1['Tables_in_proofpilot']} $$";
            $sql .= $this->_break();
            $sql .= "CREATE TRIGGER history_{$value1['Tables_in_proofpilot']} AFTER UPDATE on {$value1['Tables_in_proofpilot']}";
            $sql .= $this->_break();
            $sql .= "FOR EACH ROW";
            $sql .= $this->_break();
            $sql .= "BEGIN";
            $sql .= $this->_break();
            	
            $fields = $conn->fetchAll("desc {$value1['Tables_in_proofpilot']}");
    
            foreach($fields as $key2 => $value2) {
                if(0 == $key2) {
                    $pk = $value2['Field'];
                }
                $sql .= "IF (NEW.{$value2['Field']} != OLD.{$value2['Field']}) THEN";
                $sql .= $this->_break();
    
                if(strstr($value2['Field'], "password")) {
                    $sql .= "INSERT INTO history  (table_name, field_name, row_id, previous_value, new_value, history_datetime ) VALUES  ('{$value1['Tables_in_proofpilot']}', '{$value2['Field']}', NEW.$pk, '*****', '*****', NOW());";
                }else {
                    $sql .= "INSERT INTO history  (table_name, field_name, row_id, previous_value, new_value, history_datetime ) VALUES  ('{$value1['Tables_in_proofpilot']}', '{$value2['Field']}', NEW.$pk, OLD.{$value2['Field']}, NEW.{$value2['Field']}, NOW());";
                }
    
                $sql .= $this->_break();
                $sql .= "END IF;";
                $sql .= $this->_break();
            }
    
            	
            $sql .= "END $$";
            $sql .= $this->_break();
            $sql .= "DELIMITER ;\n\r";
            	
            //Executing the Trigger Generation
            echo "$sql<hr>";
            $stmt = $conn->prepare($sql);
            #$stmt->execute();
            	
    }
    
    		die("");
        }
        private function _break() {
            return '<br>';
            return ' ';
            #echo ".";
        }
}
