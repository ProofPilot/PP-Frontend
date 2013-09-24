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

class organizationCustom extends DbCustom
{

    public function updateOrganizationAddressByZipcode($id, $address)
    {
    	if($id) {
    		
    		$sql = "UPDATE organization
    				SET    state_id = '{$address['state_id']}',
    					   city_city_id = '{$address['city_id']}'
    				WHERE  organization_id = '$id'";
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    	}
    	
    }
    
    public function getLogByOrganization($organization_id, $limit = NULL)
    {
    	if($limit):
	    	$_limit = "LIMIT $limit";
    	else:
    		$_limit = "LIMIT 50"; //MAX LIMIT
    	endif;
    
    	$sql = "SELECT    log.participant_communication_log_id, log.participant_communication_log_datetime, log.participant_communication_log_text, log.participant_id, log.communication_channel_id,
				    	  log.from_sender_id, log.`to_sender_id`,
				    	  s.status_name,
				    	  c.communication_channel_name,
				    	  s1.sender_name as 'Sender_from',
				    	  s2.sender_name as 'Sender_To',
		    
		  		    	  CONCAT(i.individual_firstname, ' ', i.individual_lastname) as 'Individual_Sender_Name',
		  			  	  CONCAT(r.representative_firstname, ' ', r.representative_lastname) as 'Representative_Sender_Name',
		    
		   			 	  CONCAT(i2.individual_firstname, ' ', i2.individual_lastname) as 'Individual_From_Name',
		    			  CONCAT(r2.representative_firstname, ' ', r2.representative_lastname) as 'Representative_From_Name',
		    
		    			  p.participant_firstname, p.participant_lastname
		    	FROM      participant_communication_log log
		    	LEFT JOIN communication_channel c
		    	ON        c.communication_channel_id = log.communication_channel_id
		    	LEFT JOIN participant p
		    	ON        p.participant_id = log.participant_id
		    	LEFT JOIN sender s1
		    	ON        log.from_sender_id = s1.sender_id
		    	LEFT JOIN sender s2
		    	ON        log.to_sender_id = s2.sender_id
		    	LEFT JOIN `status` s
		    	ON        s.status_id = log.status_id
		    	LEFT JOIN individual i
		    	ON        i.individual_id = log.from_id
		    	LEFT JOIN representative r
		    	ON        r.representative_id = log.from_id
		    	LEFT JOIN individual i2
		    	ON        i2.individual_id = log.to_id
		    	LEFT JOIN representative r2
		    	ON        r2.representative_id = log.to_id
		    	WHERE     log.status_id = '1'
		    	AND       log.organization_id = '$organization_id'
		    	ORDER BY  log.participant_communication_log_id DESC
		    	$_limit";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }    

}