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

class individualCustom extends DbCustom
{

    public function updateIndividualAddressByZipcode($id, $address)
    {
    	if($id) {
    		
    		$sql = "UPDATE individual
    				SET    state_id = '{$address['state_id']}',
    					   city_id = '{$address['city_id']}'
    				WHERE  individual_id = '$id'";
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    	}
    	
    }
    
    public function getList() {
    	
    	$sql = "SELECT    t.individual_title_name, i.individual_firstname, i.individual_lastname, i.individual_id,
				          o.organization_name, o.organization_id,
    					  st.state_name, c.city_name
				FROM      organization_individual_link l
				LEFT JOIN individual i
				ON        i.individual_id = l.individual_id
				LEFT JOIN organization o
				ON        o.organization_id = l.organization_id
				LEFT JOIN individual_title t
				ON        t.individual_title_id = i.individual_title_id
    			LEFT JOIN state st 
				ON        st.state_id = i.state_id
    			LEFT JOIN city c
				ON        c.city_id = i.city_id
				ORDER BY  o.organization_id";
    	
    	$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
    }
    
    public function getListLinked($adverse_reaction_id)  {
    	
    	$sql = "SELECT individual_id, organization_id
		    	FROM   adverse_reaction_referal
		    	WHERE  adverse_reaction_id = '$adverse_reaction_id'
		    	AND    status_id = '1'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    		
    }
    
    public function cleanListLinked($adverse_reaction_id) {
    	
    	//Lets disable all of them
    	$sql = "UPDATE adverse_reaction_referal
		    	SET    status_id = '2'
		    	WHERE  adverse_reaction_id = '$adverse_reaction_id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    }
    
    public function saveListLinked($adverse_reaction_id, $individual_id, $representantive_id, $organization_id) {
    	
    	//Lets see if the row exists
    	$sql = "SELECT individual_id
		    	FROM   adverse_reaction_referal
		    	WHERE  individual_id = '$individual_id'
    			AND    adverse_reaction_id = '$adverse_reaction_id'
    			AND    organization_id = '$organization_id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	//Exists! Lets just modify the status    	
    	if($query->fetchAll()) {
    		
    		$sql = "UPDATE adverse_reaction_referal
    				SET    status_id = '1',
    				       adverse_reaction_referal_datetime = NOW()
    				WHERE  individual_id = '$individual_id'
    				AND    adverse_reaction_id = '$adverse_reaction_id'
    				AND    organization_id = '$organization_id'";
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    	}else {
    		//Not exists, lets insert the row
    		$sql = "INSERT INTO adverse_reaction_referal
		    		SET    adverse_reaction_id = '$adverse_reaction_id',
		    			   adverse_reaction_referal_datetime = NOW(),
		    			   representative_id = '$representantive_id',
		    			   organization_id = '$organization_id',
		    			   individual_id = '$individual_id',
		    			   status_id = '1'";
    		
    		$query = $this->db_conn->prepare($sql);
    		$query->execute();
    	}
    }
    
    public function getIndividualsPerOrganization($organization_id) 
    {
    	$sql = "SELECT    l.organization_individual_link_id, l.organization_id, l.individual_id, l.status_id,
				          CONCAT(i.individual_firstname, ' ', i.individual_lastname) individual,
				          o.organization_name organization,
				          s.status_name status
				FROM      organization_individual_link l
				LEFT JOIN organization o
				ON        o.organization_id = l.organization_id
				LEFT JOIN individual i
				ON        i.individual_id = l.individual_id
				LEFT JOIN status s
				ON        s.status_id = l.status_id
				WHERE     l.organization_id = '$organization_id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public function getIndividualReferred($individual_id) 
    {
    	$sql = "SELECT    CONCAT(p.participant_firstname, ' ', participant_lastname) participant,
    			 		  ar.participant_id,
				    	  ar.adverse_reaction_datetime_creation referred_datetime
		    	FROM      adverse_reaction ar
		    	LEFT JOIN adverse_reaction_referal r
		    	ON        r.adverse_reaction_id = ar.adverse_reaction_id
		    	LEFT JOIN participant p
		    	ON        p.participant_id = ar.participant_id
		    	WHERE     1 = 1
		    	AND       r.individual_id = '$individual_id'
		    	GROUP BY  ar.participant_id";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return $query->fetchAll();
    	
    	
    	
    	
    	
    }

}