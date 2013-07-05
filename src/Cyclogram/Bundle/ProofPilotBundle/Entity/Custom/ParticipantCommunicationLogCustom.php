<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\Custom;

class participantCommunicationLogCustom extends DbCustom
{

    public function getLog($participant_id, $limit = NULL)
    {
		if($limit):
			$_limit = "LIMIT $limit";
		else:
			$_limit = "LIMIT 10"; //MAX LIMIT
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
				WHERE     log.participant_id = '$participant_id'
				AND	 	  log.status_id = '1'
				ORDER BY  log.participant_communication_log_id DESC
    			$_limit";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();    	

    }
    
    public function getList() {
    	
    	$sql = "SELECT    log.participant_communication_log_id, log.participant_communication_log_datetime, 
    					  SUBSTRING(log.participant_communication_log_text,1,100) as participant_communication_log_text, 
    					  log.participant_id, log.communication_channel_id,

		    			  s.status_name,
		    			  c.communication_channel_name,
    					   p.participant_firstname, p.participant_lastname
		    	FROM      participant_communication_log log
		    	LEFT JOIN communication_channel c
		    	ON        c.communication_channel_id = log.communication_channel_id
		    	LEFT JOIN participant p
		    	ON        p.participant_id = log.participant_id

		    	LEFT JOIN `status` s
		    	ON        s.status_id = log.status_id
		    	HAVING    log.participant_communication_log_id >=
    						(SELECT MAX(log2.participant_communication_log_id)
		    				 FROM   participant_communication_log AS log2
		    				 WHERE  log.participant_id = log2.participant_id 
    						 GROUP BY log2.participant_id
    						)
		    	ORDER BY  log.participant_communication_log_id DESC";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();
    	
    }
    
    public function getLogMessage($id)
    {
    	$sql = "SELECT    log.participant_communication_log_id, log.participant_communication_log_datetime, log.participant_communication_log_text, log.participant_id, log.representative_id, log.communication_channel_id,
				    	  r.representative_username,
				    	  s.status_name,
				    	  c.communication_channel_name,
				    	  s1.sender_name as 'Sender_from',
				    	  s2.sender_name as 'Sender_To'
		    	FROM      participant_communication_log log
		    	LEFT JOIN communication_channel c
		    	ON        c.communication_channel_id = log.communication_channel_id
		    	LEFT JOIN participant p
		    	ON        p.participant_id = log.participant_id
		    	LEFT JOIN representative r
		    	ON        r.representative_id = log.representative_id
		    	LEFT JOIN sender s1
		    	ON        log.from_sender_id = s1.sender_id
		    	LEFT JOIN sender s2
		    	ON        log.to_sender_id = s2.sender_id
		    	LEFT JOIN `status` s
		    	ON        s.status_id = log.status_id
		    	WHERE     log.participant_communication_log_id = '$id'
		    	AND       log.status_id = '1'
		    	ORDER BY  log.participant_communication_log_id DESC";
 		
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
				WHERE     log.participant_communication_log_id = '$id'
		    	AND       log.status_id = '1'
		    	ORDER BY  log.participant_communication_log_id DESC";
		    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }
    
	    public function logPhoneCall($participant_id, $message) {
    		return $this->logCommunication($participant_id, "Phone Call", $message, 5, 1, 1, 2, $participant_id); //5 communication channel, 1 representative, 1, 1 representativeID 1, 2 = participant
    	}
    
    public function logPhoneCallnew($participant_id, $message, $from_sender_id, $from_id) {
    	return $this->logCommunication($participant_id, "Phone Call", $message, 5, $from_sender_id, $from_id, 2, $participant_id); //5 communication channel, 1 representative, 1, 1 representativeID 1, 2 = participant
    }
    
	    //ATENTION: This function will be replace it for sendSMSnew
    	public function sendSMS($participant_id, $message) {
    		return $this->logCommunication($participant_id, "SMS", $message, 3, 1, 1, 2, $participant_id); 
    	}
    
    public function sendSMSnew($participant_id, $message, $from_sender_id, $from_id) {
    	return $this->logCommunication($participant_id, "SMS", $message, 3, $from_sender_id, $from_id, 2, $participant_id);
    }
    
	    //ATENTION: This function will be replace it for sendEmail
    	public function sendEmail($participant_id, $subject, $message) {
    		return $this->logCommunication($participant_id, $subject, $message, 1, 1, 1, 2, $participant_id); 
    	}
    
    public function sendEmailnew($participant_id, $subject, $message, $from_sender_id, $from_id) {
    	return $this->logCommunication($participant_id, $subject, $message, 1, $from_sender_id, $from_id, 2, $participant_id);
    }
  
    private function logCommunication ($participant_id, $participant_communication_log_subject, $participant_communication_log_text, $communication_channel_id, $from_sender_id, $from_id, $to_sender_id, $to_id) {

    	$sql = "INSERT INTO participant_communication_log
		    	SET    participant_id = '$participant_id',
			    	   participant_communication_log_datetime = NOW(),
			    	   participant_communication_log_subject = '$participant_communication_log_subject',
			    	   participant_communication_log_text = '$participant_communication_log_text',
			    	   communication_channel_id = '$communication_channel_id',
			    	   from_sender_id = '$from_sender_id',
			    	   from_id = '$from_id',
			    	   to_sender_id = '$to_sender_id',
			    	   to_id = '$to_id',
			    	   status_id = '1'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return true;
    }
    
    public function getParticipantByMessageID($id) {
    	
    	$sql = "SELECT participant_id
				FROM   participant_communication_log log
				WHERE  participant_communication_log_id = '$id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	foreach($query->fetchAll() as $row => $value):
    		return $value['participant_id'];
    	endforeach;
    }

    public function archiveMessage($id) {
    	
    	$sql = "UPDATE participant_communication_log
    			SET    status_id = '3'
    			WHERE  participant_communication_log_id = '$id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return true;    	
    }
    
    public function getLogPerIndividual($individual_id, $limit = NULL)
    {
    	if($limit):
    		$_limit = "LIMIT $limit";
    	else:
    		$_limit = "LIMIT 30"; //MAX LIMIT
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
		    	WHERE     (log.to_id = '$individual_id'
		    	OR        log.from_id = '$individual_id')
		    	AND       (log.to_sender_id = '3'
		    	OR        log.from_sender_id = '3')
				AND	 	  log.status_id = '1'
		    	ORDER BY  log.participant_communication_log_id DESC
		    	$_limit";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }
    
}