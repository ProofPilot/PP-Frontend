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

class commonCustom extends DbCustom
{

    public function getAddressInfoByZipcode($zipcode = null)
    {
    	if($zipcode) {
    	
	    	$sql = "SELECT    ct.country_id, ct.country_name,
					          c.state_id, s.state_name,
					          c.city_id, city_name, c.city_zipcode, 
					          c.city_latitude, c.city_longitude, 
					          c.city_county
	    			FROM      city c
	    			LEFT JOIN state s
	    			ON        s.state_id = c.state_id
	    			LEFT JOIN country ct
	    			ON        s.country_id = ct.country_id
					WHERE     c.city_zipcode = '$zipcode'";
	    	
	    	$query = $this->db_conn->prepare($sql);
	    	$query->execute();
	
	    	$return = $query->fetchAll();
	    	return $return[0];
	    }
    }
    
    private function eventExtra($full = FALSE) 
    {
    	$return = array();
    	$return['HTTP_USER_AGENT'] = @$_SERVER['HTTP_USER_AGENT'];
    	$return['HTTP_REFERER'] = @$_SERVER['HTTP_REFERER'];
    	$return['REQUEST_URI'] = @$_SERVER['REQUEST_URI'];
    	
    	if($full) return json_encode($_SERVER);
    	else return json_encode($return);
    }
    
    public function addEvent($user_id, $participant_id = null, $event_type_id, $event_controller, $event_description, $extra = null) 
    {
    	if(!is_numeric($user_id) && filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
    		$user_id = $this->getIdByEmail($user_id);
    	}
    	
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$extra = isset($extra) ? $extra : FALSE;
    	$event_extra = $this->eventExtra($extra);
    	
    	if(!$participant_id) $participant_id = $user_id;
    	
    	$sql = "INSERT INTO event
    			SET    event_datetime = NOW(),
    			       event_ip = '$ip',
    				   user_id = '$user_id',
    				   participant_id = '$participant_id',
    				   event_controller = '$event_controller',
    				   event_description = '$event_description',
    				   event_extra = '$event_extra',
    				   event_type_id = '$event_type_id'";

    	$query = $this->db_conn->prepare($sql);
    	$query->execute();    	
    }
    
    private function getIdByEmail($email) 
    {
    	//Getting Participant Mobile Number
    	$sql = "SELECT participant_id
		    	FROM   participant
    			WHERE  participant_email = '$email'
		    	LIMIT  1";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	$result = $query->fetchAll();
    	
    	if($result) return $result[0]['participant_id'];
    	else return false;
    }
    
    public function executeSQL($sql)
    {    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    }
}