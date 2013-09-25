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

class chartsCustom extends DbCustom
{
	
	public function getParticipantPerDay($number_of_days = 10, $campaign_id = null) {
		
		$where = "";
		if($campaign_id) $where .= "AND campaign_id = '$campaign_id'";
		
		$sql = "SELECT   DATE_FORMAT(participant_campaign_link_datetime, '%d/%m') signup_date,  COUNT(participant_id)  number_of_participants
				FROM     participant_campaign_link
				WHERE    participant_campaign_link_datetime BETWEEN CURDATE() - INTERVAL $number_of_days DAY AND CURDATE() + INTERVAL 1 DAY
				$where
				GROUP BY DATE_FORMAT(participant_campaign_link_datetime, '%d/%m')";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		return $query->fetchAll();		
	}
	
	public function getParticipantPerZipcode() {
	
	
		$sql = "SELECT   participant_zipcode zipcode,  COUNT(participant_id)  number_of_participants
				FROM     participant
				GROUP BY participant_zipcode";
	
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	}
	
	public function getParticipantPerRace() {
	
	
		$sql = "SELECT    r.race_name,  COUNT(participant_id)  number_of_participants
				FROM      participant p
				LEFT JOIN race r
				ON        r.race_id = p.race_id
				GROUP BY  p.race_id";
	
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	}

	
	
}