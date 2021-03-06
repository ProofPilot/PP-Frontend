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

class interventionCustom extends DbCustom
{

	public function getInteventionType()
	{
		$sql = "SELECT intervention_type_id, intervention_type_name
				FROM   intervention_type
				WHERE  status_id = '1'";
		 
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	
	}

	public function getInterventionBaseOnParticipantArm($id){
		
		$sql = "SELECT    i.intervention_id, i.intervention_name,
						  t.intervention_type_id, t.intervention_type_name 
				FROM      intervention i
				JOIN      arm_intervention_link l
				ON        i.intervention_id = l.intervention_id
				LEFT JOIN intervention_type t
				ON        t.intervention_type_id = i.intervention_type_id
				WHERE     l.arm_id IN (SELECT arm_id FROM participant_arm_link l WHERE l.participant_id = '$id')
				AND       i.intervention_id NOT IN (select intervention_id FROM participant_intervention_link WHERE participant_id = '$id')
				AND       l.status_id = '1'
				AND       i.status_id = '1'
				GROUP BY  i.intervention_id
				ORDER BY  i.intervention_name";
			
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		return $query->fetchAll();
		
	}
	
}