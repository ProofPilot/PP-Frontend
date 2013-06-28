<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\Custom;

class ApiCustom extends DbCustom
{
	public function getLatestVersion($app) {
		
		$sql = "SELECT version_number
				FROM   version
				WHERE  version_app = '$app'
				LIMIT  1";
		 
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		 
		$return = $query->fetchAll();
		return $return[0]['version_number'];		
	}
	
	public function setLatestVersion($app, $version) {
	
		$sql = "UPDATE version
				SET    version_number = '$version'
				WHERE  version_app = '$app'
				LIMIT  1";
			
		$query = $this->db_conn->prepare($sql);
		$query->execute();
			
		return true;
	}
	
	
    public function getDevice($udid, $return = FALSE) {
    	
    	$sql = "SELECT device_udid, device_token, device_desc, device_used, status_id
    			FROM   device
    			WHERE  device_udid = '$udid'
    			LIMIT  1";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	if($return) {
    		$return = $query->fetchAll();
    		return $return[0];
    	}else {    	
	    	if($query->fetchAll()) return TRUE;
    		else return FALSE;
    	}
	}
	
	public function setToken($token, $udid) {
		
		$sql = "UPDATE device
				SET    device_token = '$token', 
				       status_id = '1'
				WHERE  device_udid = '$udid'
				LIMIT  1";

		$query = $this->db_conn->prepare($sql);
		$query->execute();
	}
	
	public function userExits($username) {
		
		$sql = "SELECT user_id, user_email, login_attempts, status_id
				FROM   user
				WHERE  user_email = '$username'
				AND    user_type_id = '2'
				LIMIT  1";

		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		$return = $query->fetchAll();
		
		if($return) return $return[0];
		else return FALSE;
	}
	
	public function login($username, $password) {
		
		$sql = "SELECT    r.user_id id, r.representative_firstname firstname, r.representative_lastname lastname, r.representative_email email,
						  r.representative_phone1 phone, r.organization_id, 
		                  u.login_attempts
				FROM      representative r
				LEFT JOIN user u
				ON        r.user_id = u.user_id
				WHERE     u.user_email = '$username'
				AND       u.user_password = '$password'
				AND       u.status_id = '1'
				AND       u.user_type_id = '2'
				LIMIT     1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		$return = $query->fetchAll();
		
		if($return) {
			
			//Resetting the login attempts
			$sql = "UPDATE user
					SET    login_attempts = '0'
					WHERE  user_email = '$username'
					AND    user_password = '$password'
					AND    status_id = '1'
					AND    user_type_id = '2'
					LIMIT  1";

			$query = $this->db_conn->prepare($sql);
			$query->execute();
			
			return $return[0];
		}
		else {
			return FALSE;
		}
	}
	
	public function increase_login_attempt($user_id) {
		
		$sql = "UPDATE user
				SET    login_attempts = login_attempts + 1
				WHERE  user_id = '$user_id'
				AND    user_type_id = '2'
				LIMIT  1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		$sql = "SELECT login_attempts
				FROM   user
				WHERE  user_id = '$user_id'
				AND    user_type_id = '2'
				LIMIT  1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		$return = $query->fetchAll();
		
		if($return) return $return[0]['login_attempts'];
		
	}
	
	public function lockUser($user_id) {
		
		$sql = "UPDATE user
				SET    status_id = '2'
				WHERE  user_id = '$user_id'
				AND    user_type_id = '2'
				LIMIT  1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	}
	
	public function getTestList($study_id) {
	
		#$sql = "SELECT    DISTINCT p.participant_username, t.test_id, t.test_phase_id, tp.test_phase_name, TIME_FORMAT( TIMEDIFF (NOW(), t.test_date_creation), '%Hh %im %ss') time_elapse
		$sql = "SELECT    DISTINCT p.participant_username, t.test_id, t.test_phase_id, tp.test_phase_name, UNIX_TIMESTAMP() - UNIX_TIMESTAMP(t.test_date_creation) time_elapse				  
				FROM      orders o
				LEFT JOIN order_specimen_link osl
				ON        osl.order_id = o.order_id
				LEFT JOIN specimen_test_link stl
				ON        stl.specimen_id = osl.specimen_id
				LEFT JOIN test t 
				ON        t.test_id = stl.test_id
				LEFT JOIN test_phase tp
				ON        tp.test_phase_id = t.test_phase_id
				LEFT JOIN participant_campaign_link pcl
				ON        o.participant_id = pcl.participant_id
				LEFT JOIN participant p
				ON        p.participant_id = pcl.participant_id
				WHERE     t.test_id AND p.participant_username
				AND       o.study_id = '2'
				AND       pcl.campaign_id = '3'
				AND       t.status_id = '1'
				ORDER BY  t.test_date_creation DESC";
	
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		$return = $query->fetchAll();
	
		if($return) return $return;
		else return FALSE;
	}
	
	public function catalog($table_name) {
		
		$sql = "SELECT * FROM $table_name";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		$return = $query->fetchAll();
		
		if($return) return $return;
		else return FALSE;
		
	}
}