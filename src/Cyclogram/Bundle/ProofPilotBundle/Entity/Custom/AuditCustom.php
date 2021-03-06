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

class AuditCustom extends DbCustom
{

    public function getAuditList($params) {
    	
    	$sql = "SELECT id, 
    				   `msg-type` as msg_type,     			
    					FROM_UNIXTIME(`date`, '%m/%d/%Y') date,
    				   `thread-id` as thread_id, 
    				   `query-id` as query_id, 
    			       `priv_user`, 
    			       `cmd`, 
    			       `query`
    			FROM   audit.event
    			";
    	
    	$query = $this->db_conn->prepare($sql);
    	$return = $query->execute();
    	
    	return $query->fetchAll();
	}
	
	public function getEventList($params) {
		 
		$sql = "SELECT    e.event_id, e.event_datetime, e.event_ip, 
						  e.event_type_id, et.event_type_desc,
						  e.user_id, user_email, 
						  e.participant_id, concat(p.participant_firstname, ' ', p.participant_lastname) participant,
						  e.event_description, e.event_controller, e.event_extra
				FROM      proofpilot.event e
				LEFT JOIN event_type et
				ON        et.event_type_id = e.event_type_id
				LEFT JOIN participant p
				ON        p.participant_id = e.participant_id
				LEFT JOIN user u
				ON        u.user_id = e.user_id";
		 
		$query = $this->db_conn->prepare($sql);
		$return = $query->execute();
		 
		return $query->fetchAll();
	}
	
	public function save($params) {
		
		if($params) {
		
			$query = mysql_real_escape_string($params->query);
			$cmd = mysql_real_escape_string($params->cmd);
			
			$sql = "INSERT INTO audit.event
					SET    `msg-type`  = '{$params->{'msg-type'}}',
						   `date`      = '{$params->date}',
						   `thread-id` = '{$params->{'thread-id'}}',
						   `query-id`  = '{$params->{'query-id'}}',
						   `priv_user` = '{$params->priv_user}',
						   `cmd`       = '$cmd',
						   `query`     = '$query'";
	
			$query = $this->db_conn->prepare($sql);
			$query->execute();
		}
	}

}