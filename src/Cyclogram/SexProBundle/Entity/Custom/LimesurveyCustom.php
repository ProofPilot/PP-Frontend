<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\Custom;

class limesurveyCustom extends DbCustom
{

	public function getResult($sid_id, $save_id)
	{
		
		$sql = "";
		 
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	
	}	
	
}