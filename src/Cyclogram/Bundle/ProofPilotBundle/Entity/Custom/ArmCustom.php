<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\Custom;

class armCustom extends DbCustom
{

	public function getArms($participant_id = null)
	{
    	$exception = "";
    	if($participant_id):
    		$exception = "AND a.arm_id NOT IN (SELECT arm_id FROM participant_arm_link WHERE participant_id = '$participant_id')";
    	endif;
		
		$sql = "SELECT    a.arm_id, a.arm_name, a.arm_quota, a.arm_ceilling, a.study_id, a.arm_description,
						  st.status_name,
						  s.study_name
				FROM      arm a
				LEFT JOIN study s
				ON        s.study_id = a.study_id
				LEFT JOIN `status` st
				ON        s.status_id = a.status_id
				WHERE     a.status_id = '1' 
				$exception
				GROUP BY  a.arm_id";
		 
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	
	}	
	
    public function getArmsPerStudy($study_id)
    {    	
    	$sql = "SELECT    a.arm_id, a.arm_name, a.arm_quota, a.arm_ceilling, a.study_id, a.arm_description,
				          st.status_name, 
				          s.study_name
				FROM      arm a
				LEFT JOIN study s
				ON        s.study_id = a.study_id
				LEFT JOIN `status` st
				ON        s.status_id = a.status_id
				WHERE     a.study_id = '$study_id'
				AND       a.status_id = '1'
				GROUP BY  a.arm_id;";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();    	

    }
}