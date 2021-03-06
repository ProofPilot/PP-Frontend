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

class studyCustom extends DbCustom
{

    public function get($id = 0)
    {
    	if($id) $where = "AND s.study_id = '$id'";
    	else $where = "";
    	
    	$sql = "SELECT    s.study_id, s.study_name, s.status_id, st.status_name
    			FROM      study s
    			LEFT JOIN status st
				ON        st.status_id = st.status_id
				WHERE     s.status_id != '3'
    			$where
    			GROUP BY  s.study_id
    			ORDER BY  s.study_name";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	if($id) {
    		$return = $query->fetchAll();
    		return $return[0];
    	}else return $query->fetchAll();    	

    }
    
    public function getStudyOrganizationLink($study_id) {
    	
    	if($study_id) {
    		 
    		$sql = "SELECT organization_id 
    				FROM   study_organization_link
    				WHERE  study_id = '$study_id'
    				AND    status_id = '1'";
    		 
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    		 
    		return $query->fetchAll();
    	}
    }
    
    public function addStudyOrganizationLink($study_id, $organization_id) {
    	
    	if($study_id && $organization_id) {
    		
    		$sql = "SELECT study_organization_link_id 
    				FROM   study_organization_link
    				WHERE  study_id = '$study_id'
    				AND    organization_id = '$organization_id'";
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    		 
    		if($query->fetchAll()) {
    			$sql = "UPDATE study_organization_link
    					SET    status_id = '1'
    					WHERE  study_id = '$study_id'
    					AND    organization_id = '$organization_id'";
    		}else {
	    		$sql = "INSERT INTO study_organization_link
	    				SET    study_id = '$study_id',
	    					   organization_id = '$organization_id',
	    					   study_organization_role_id = '1',
	    		               status_id = '1'";	    	
    		}
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    		
    		return true;

    	}
    	
    }
    
    public function studyOrganizationLinkClean($study_id) {
    	
    	if($study_id) {
    		
    		#$sql = "DELETE FROM study_organization_link
    		#		WHERE  study_id = '$study_id'";

    		//Removing DB style
    		$sql = "UPDATE study_organization_link
    				SET    status_id = '5'
    				WHERE  study_id = '$study_id'";
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();

    		return true;
    	}
    }
    
    

}