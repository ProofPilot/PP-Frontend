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

class participantCustom extends DbCustom
{

    public function getParticipantList($level)
    {
    	$sql = "SELECT    l.participant_campaign_link_id, s.study_name, l.participant_campaign_link_site as site_name, l.participant_campaign_link_datetime, 
    					  p.participant_id 
				FROM      participant p
				LEFT JOIN participant_campaign_link l
				ON        l.participant_id = p.participant_id
				LEFT JOIN campaign c
				ON        l.campaign_id = c.campaign_id
				LEFT JOIN placement pl 
				ON        pl.placement_id = c.placement_id
				LEFT JOIN study s
				ON        s.study_id = pl.study_id
				WHERE     l.participant_level_id = '$level'
    			GROUP BY  p.participant_id
    			ORDER BY  participant_campaign_link_datetime";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();    	

    }
    
    
    public function getParticipant($id)
    {
    	$sql = "SELECT    p.participant_id, p.participant_email, p.participant_mobile_number, p.participant_firstname, p.participant_lastname
		    	FROM      participant p
		    	WHERE     p.participant_id = '$id'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }
    
    public function getParticipantLeads($id) {
    
    	$sql = "SELECT    l.participant_campaign_link_id, l.participant_campaign_link_datetime, l.participant_campaign_link_site as site,
				          c.campaign_name,
				          s.study_name         
				FROM      participant_campaign_link l
				LEFT JOIN campaign c
				ON        c.campaign_id = l.campaign_id
				LEFT JOIN placement p
				ON        p.placement_id = c.placement_id
				LEFT JOIN study s
				ON        s.study_id = p.study_id
				WHERE     l.participant_id = '$id'
				-- AND       l.participant_level_id = '1'"; //level_id #1 = leads
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    }
    
    public function getLeadCampaignDetail($id) {
    
    	$sql = "SELECT    l.participant_campaign_link_id, l.participant_campaign_link_datetime, participant_campaign_link_site as site,
				          c.campaign_name,
				          s.study_name, l.participant_campaign_link_referral_code, l.participant_campaign_link_ip_address
				FROM      participant_campaign_link l
				LEFT JOIN campaign c
				ON        c.campaign_id = l.campaign_id
				LEFT JOIN placement p
				ON        p.placement_id = c.placement_id
				LEFT JOIN study s
				ON        s.study_id = p.study_id
				WHERE     l.participant_campaign_link_id = '$id'
    			LIMIT     1";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();	 
    }
    
    public function getParticipantArm($id) {
    	
    	$sql = "SELECT    a.arm_id, a.arm_name, l.participant_arm_link_datetime, 
    	                  s.study_name,
    	                  st.status_name
				FROM      participant_arm_link l
				LEFT JOIN arm a
				ON        l.arm_id = a.arm_id
				LEFT JOIN study s
				ON        a.study_id = s.study_id
				LEFT JOIN status st
				ON        st.status_id = l.status_id
				WHERE     l.participant_id = '$id'";
    	
		$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public function addParticipantArm($participant_id, $arm_id, $status_id) {
    	
    	$sql = "INSERT INTO participant_arm_link
    			SET    arm_id = '$arm_id',
    				   participant_id = '$participant_id',
    				   participant_arm_link_datetime = NOW(),
    				   status_id = '$status_id'";
    	
		$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	//@TODO: Update the Participant to (Client) Participant Level #2	
    	//Getting the CampaignID
    	$sql = "SELECT    c.campaign_id 
				FROM      campaign c
				LEFT JOIN participant_campaign_link l
				ON        l.campaign_id = c.campaign_id
				LEFT JOIN placement p
				ON        p.placement_id = c.placement_id
				LEFT JOIN study s
				ON        s.study_id = p.study_id
				LEFT JOIN arm a
				ON        a.study_id = s.study_id
				WHERE     a.arm_id = '$arm_id'
				AND       l.participant_id = '$participant_id'
				LIMIT     1";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	$result = $query->fetchAll();
    	if($result) {
    		$campaign_id = $result[0]['campaign_id'];
    		
    		$sql = "UPDATE participant_campaign_link
		    		SET    participant_level_id= '2'
		    		WHERE  participant_id = '$participant_id'
		    		AND    campaign_id = '$campaign_id'
		    		LIMIT  1";
    		 
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    	}
    	else return false;
    	
    	return true;
    }
    
    public function addParticipantIntervention($participant_id, $intervention_id, $status_id) {
    	 
    	$sql = "INSERT INTO participant_intervention_link
		    	SET    participant_intervention_link_datetime_start = NOW(),
		    		   intervention_id = '$intervention_id',
		    		   participant_id = '$participant_id',
		    		   status_id = '1'";
		    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return true;
    }
    
    
    
    public function getParticipantInterventions($id) {
    	 
    	$sql = "SELECT    i.intervention_id, t.intervention_type_name, i.intervention_name,  i.intervention_url,
    					  l.participant_intervention_link_id, l.participant_intervention_link_datetime_start,
				          s.status_name
				FROM      participant_intervention_link l
				LEFT JOIN intervention i
				ON        i.intervention_id = l.intervention_id
				LEFT JOIN intervention_type t
				ON        t.intervention_type_id = i.intervention_type_id
				LEFT JOIN `status` s
				ON        s.status_id = i.status_id
				WHERE     l.participant_id = '$id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return $query->fetchAll();
    }
    
    public function getParticipantInterventionDetail($id) {
    	
    	$sql = "SELECT    i.intervention_id, t.intervention_type_name, i.intervention_name, i.intervention_url,
						  l.participant_intervention_link_datetime_start, l.participant_intervention_link_datetime_end, s.status_name
				FROM      participant_intervention_link l
				LEFT JOIN intervention i
				ON        i.intervention_id = l.intervention_id
				LEFT JOIN intervention_type t
				ON        t.intervention_type_id = i.intervention_type_id
				LEFT JOIN `status` s
				ON        s.status_id = i.status_id 
				WHERE     l.participant_intervention_link_id = '$id'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public function getMobileNumber($participant_id) {
    	
    	//Getting Participant Mobile Number
    	$sql = "SELECT participant_mobile_number
		    	FROM   participant
		    	WHERE  participant_id = '$participant_id'
		    	LIMIT  1";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	$result = $query->fetchAll();
    	if($result) return $result[0]['participant_mobile_number'];
    	else return false;
    }
    
    public function getEmail($participant_id) {
    	 
    	//Getting Participant Mobile Number
    	$sql = "SELECT participant_email
    			FROM   participant
    			WHERE  participant_id = '$participant_id'
    			LIMIT  1";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	$result = $query->fetchAll();
    	if($result) return $result[0]['participant_email'];
    	else return false;
    }
    
    public function getAddress($participant_id) {

    	$sql = "SELECT    p.participant_zipcode,
		    			  c.city_name, c.city_latitude, c.city_longitude, c.city_county,
		    			  s.state_code, s.state_name
		    	FROM      participant p
		    	LEFT JOIN city c
		    	ON        c.city_id = p.city_id
		    	LEFT JOIN state s
		    	ON        s.state_id = p.state_id
		    	WHERE     p.participant_id = '1'
    			LIMIT     1";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return $query->fetchAll();

    }
    
    public function getSurveyInformation($participant_campaign_link_id) {
    	
    	$sql = "SELECT    s.sid_id, s.save_id 
				FROM      participant_survey_link s
				LEFT JOIN participant_campaign_link l
				ON        s.participant_survey_link_uniqid = l.participant_survey_link_uniqid
				WHERE     l.participant_campaign_link_id = '$participant_campaign_link_id';";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();    	
    	
    }
    
    public function getCampaignLinkID($participant_id) {
    	
    	$sql = "SELECT participant_campaign_link_id
				FROM   participant_campaign_link 
				WHERE  participant_id = '$participant_id'
				AND    campaign_id = '2'
				LIMIT  1";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	$return = $query->fetchAll();
    	return $return[0]['participant_campaign_link_id'];
    }
    
    public function export1() {
    	
    	$sql = "SELECT    p.participant_id PARTICIPANT_ID,
				          cl.participant_campaign_link_datetime SESSION_DATE_MM_DD_YYYY, 
				          o.organization_name AGENCY_ID,
				          cl.participant_campaign_link_site SITE_ID,
				          '' SITE_TYPE, '' SITE_ZIP, '' SITE_COUNTY,
				          p.participant_birthdate CLIENT_DOB_MM_DD_YYYY,
				          sta.state_name CLIENT_STATE,
				          '' CLIENT_COUNTY,
				          p.participant_zipcode CLIENT_ZIP
    			FROM      participant p
    			LEFT JOIN participant_campaign_link cl
    			ON        cl.participant_id = p.participant_id
				LEFT JOIN campaign c
				ON        cl.campaign_id = c.campaign_id
				LEFT JOIN placement pla
				ON        pla.placement_id = c.placement_id
				LEFT JOIN study st
				ON        st.study_id = pla.study_id
				LEFT JOIN study_organization_link stol
				ON        stol.study_id = st.study_id
				LEFT JOIN organization o
				ON        o.organization_id = stol.organization_id
				LEFT JOIN state sta
				ON        sta.state_id = p.state_id
				WHERE     cl.campaign_id = '2'
				GROUP BY  p.participant_id";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return $query->fetchAll();
    	 
    }
    
    public function export2($surveyInfo) {
    
    	$surveyInfo = @$surveyInfo[0];

    	if($surveyInfo) {
    	
	    	$sql = "SELECT *
	    			FROM   limesurvey.lime_survey_{$surveyInfo['sid_id']}
	    			WHERE  id = '{$surveyInfo['save_id']}'";
	    	 
	    	$query = $this->db_conn->prepare($sql);
	    	$query->execute();
	
	    	$return = array();
	    	
	    	$result = $query->fetchAll();
	    	$result = $result[0];
	    	
			#print_r($result);echo "<hr>";
	    	
	    	foreach ($result as $key1 => $value1) {
				
	    		$question = $answer = '';
	    		
	    		if(strstr($key1, $surveyInfo['sid_id'])) {
#	       		if(strstr($key1, "SQ")) {
	
	    			$_tmp = explode('X', $key1);
					$sid = $_tmp[0];
	    			$qid = $_tmp[2];
	    			
	    			if(strstr($qid, "_")) {
	    			
	    				$_qid = explode('_', $qid);
	    				$qid = substr($_qid[0], 0, -1);
	    			}
	    				
	    			//Question
	    			$sql1 = "SELECT qid, question
	    					 FROM   limesurvey.lime_questions
	    					 WHERE  sid = '$sid'
	    					 AND    qid = '$qid'";
	
	    			$query1 = $this->db_conn->prepare($sql1);
	    			$query1->execute();
					$result1 = $query1->fetchAll();
					
					
					if($result1) {
		    			$question = $result1[0]['question'];
						$question = str_replace('<div>','', $question);
						$question = str_replace('</div>','', $question);
						$question = str_replace('�','', $question);
						$question = $this->nl2br2($question);
						
						$qid = $result1[0]['qid'];
					}
					
					if($value1 && $question) {
	    			
						$answer = $question;
						#echo $key1 . ' == ';
						#echo trim($question) . "?: [{$value1}] ";
						
						//Questions with several answers; thread them like another question
		    			if(strstr($key1, "SQ") and $value1 == "Y") {
		
		    				$_tmp2 = explode("SQ", $_tmp[2]);
	
		    				//SQ
		    				$sql2 = "SELECT question
				    				 FROM   limesurvey.lime_questions
		    						 WHERE  title = 'SQ{$_tmp2[1]}'
		    						 AND    parent_qid = '$qid'
		    						 AND    sid = '{$surveyInfo['sid_id']}'";
		    				 
		    				$query2 = $this->db_conn->prepare($sql2);
		    				$query2->execute();
		    				$result2 = $query2->fetchAll();
	
		    				if($result2) {
		    					$answer = $result2[0]['question']; 
		    					#echo "<FONT COLOR='green'> (" . trim($answer) . ") </font>";
		    				}
		    				
		    			}else {
			    				
				    			//Short Answers
				    			$sql4 = "SELECT answer
				    					 FROM   limesurvey.lime_answers
				    					 WHERE  code = '$value1'
				    					 AND    qid = '{$_tmp[2]}'";
				    			
				    			$query4 = $this->db_conn->prepare($sql4);
				    			$query4->execute();
				    			$result4 = $query4->fetchAll();
				    			
				    			if($result4) {
					    			$answer = $result4[0]['answer'];
					    			#echo "<FONT COLOR='blue'>" . trim($answer) . "</font>";
				    			}
			    			}
		    		}
		    		$_return[$key1] = $answer;

		    		#echo "<hr>";
					
					$return = $_return;
	    		
	    		}
	    		
	    	}
    	  
    	return $return;
    	
    	} return false;
    }
    
    
    function nl2br2($string) {
    	$string = str_replace(array("\r\n", "\r", "\n"), "", $string);
    	return $string;
    }
    
    
    public function getFirstRep($participant_id) {
    	
    	$sql = "SELECT    l.from_sender_id, r.representative_username
				FROM      participant_communication_log l
				LEFT JOIN representative r
				ON        r.representative_id = l.from_sender_id 
				WHERE     l.participant_id = '$participant_id'
				AND       l.from_sender_id = '1'
				AND       l.communication_channel_id IN (2,4)
				ORDER BY  l.participant_communication_log_id
				LIMIT     1;";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	$return = $query->fetchAll();
    	if($return) return $return[0];
    	else return array('representative_username' => 'None');
    }
    
    public function getRepresentativeSurvey($participant_id) {
    	
    	$sql = "SELECT sid_id, save_id
    			FROM   representative_survey_link
    			WHERE  participant_id = '$participant_id'
    			LIMIT  1";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	$result = $query->fetchAll();
    	$surveyInfo = @$result[0];
    	
    	if($surveyInfo) {
    	
	    	$sql = "SELECT *
			    	FROM   limesurvey.lime_survey_{$surveyInfo['sid_id']}
	    			WHERE  id = '{$surveyInfo['save_id']}'";
		   
	    	$query = $this->db_conn->prepare($sql);
	    	$query->execute();
	    	
	    	$result = $query->fetchAll();
	    	$result = $result[0];
	    	
	    	#echo '<pre>';
	    	#print_r($result);echo "<hr>";exit;
	    	
		    foreach ($result as $key1 => $value1) {
	
		    	$question = $answer = '';
		    		
		    	if(strstr($key1, $surveyInfo['sid_id'])) {
		
					$_tmp = explode('X', $key1);
					$sid = $_tmp[0];
		    		$qid = $_tmp[2];
		    		
		    		if(strstr($qid, "_")) {
		    			$_qid = explode('_', $qid);
		    			$qid = substr($_qid[0], 0, -1);
		    		}
			
		    		//Question
					$sql1 = "SELECT qid, question
		    				 FROM   limesurvey.lime_questions
		    				 WHERE  sid = '$sid'
		    				 AND    qid = '$qid'";
		
		    		$query1 = $this->db_conn->prepare($sql1);
		    		$query1->execute();
					$result1 = $query1->fetchAll();
	
					if($result1) {
			    		$question = $result1[0]['question'];
						$question = str_replace('<div>','', $question);
						$question = str_replace('</div>','', $question);
						$question = str_replace('�','', $question);
						$question = $this->nl2br2($question);
							
						$qid = $result1[0]['qid'];
					}
						
					if($question) {
		    			
						$answer = $question;
						
						#echo $key1 . ' == ' . trim($question) . "?: [{$value1}] ";
							
		    			//Short Answers
				    	$sql4 = "SELECT answer
				    			 FROM   limesurvey.lime_answers
				    			 WHERE  code = '$value1'
				    			 AND    qid = '{$_tmp[2]}'";
				    			
				    	$query4 = $this->db_conn->prepare($sql4);
				    	$query4->execute();
				    	$result4 = $query4->fetchAll();
				    			
				    	if($result4) {
					    	$answer = $result4[0]['answer'];
					    	#echo "<FONT COLOR='blue'>" . trim($answer) . "</font>";
				    	}
			    	}

			    	$_return[$key1] = array($question, $answer,$value1);
			    	
		    		#echo "<hr>";
		    		$return = $_return;		    	
		    	}
		    	
		    } //end for each
	    #exit;
	    	return $return;
	    } 
	    
	    return false;
    }
    
    public function getParticipantHistory($participant_id)
    {
    	$sql = "SELECT   history_datetime, field_name, previous_value, new_value 
				FROM     history
				WHERE    table_name = 'participant' 
				AND      row_id = '$participant_id'
				ORDER BY history_datetime DESC
    			LIMIT    20";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public function addParticipantIdToSurvey($participant_id, $survey_id, $save_id) {
    
    	$sql = "UPDATE limesurvey.lime_survey_$survey_id
    			SET    token = CONCAT(token,':$participant_id')
    			WHERE  id = '$save_id'";
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return true;
    }
    
}
    
 