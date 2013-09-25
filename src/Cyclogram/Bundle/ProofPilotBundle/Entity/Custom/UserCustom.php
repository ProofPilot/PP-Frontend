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

class userCustom extends DbCustom
{

    public function getUserRoleLink($user_id)
    {
    	$sql = "SELECT    l.user_user_id user_id, l.user_role_user_role_id user_role_id, r.user_role_name 
				FROM      user_role_link l
				LEFT JOIN user_role r
				ON        r.user_role_id = l.user_role_user_role_id
				WHERE     l.user_user_id = '$user_id'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();    	

    }

    public function userRoleLinkClean($user_id) 
    {
    	$sql = "DELETE FROM user_role_link
    			WHERE  user_user_id = '$user_id'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    }
    
    public function addUserRoleLink($user_id, $role_id) 
    {
    	$sql = "INSERT INTO user_role_link
		    	SET    user_role_user_role_id = '$role_id',
		    		   user_user_id = '$user_id'";
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    }
    
    public function addUserByRep($data) {
    	
    	//Inserting the user based on representative data 
    	//To allow the representative login as ...
    	
    	$sql = "INSERT INTO user
    			SET    user_email = '{$data['representativeEmail']}',
    				   user_password = '{$data['representativePassword']}',
    				   user_email_confirmed = '1',
    				   user_mobile_number = '{$data['representativePhone1']}',
    				   user_mobile_sms_code = '1234',
    				   user_mobile_sms_code_confirmed = '1',
					   status_id = '{$data['status']}'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	$user_id = $this->db_conn->lastInsertId('user_id');

    	//Inserting the representative ROLE
    	$sql = "INSERT INTO `user_role_link` (`user_role_user_role_id`, `user_user_id`) VALUES (4, $user_id)";
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $user_id;
    }
    
    public function getStudyPerRepresentativeId($user_id) {
    	
    	
    }
}