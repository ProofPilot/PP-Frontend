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

class elegibilityCustom extends DbCustom
{

	public function getSurveyResult($save_id, $sid)
	{
		$sql = "SELECT    id, token, submitdate, lastpage, startlanguage, startdate, datestamp, ipaddr, refurl, 
						  CAST(553173X46X521 AS SIGNED) 553173X46X521, 
						  553173X46X522, 
						  553173X46X523SQ001, 
						  553173X46X523SQ002, 
						  553173X46X523SQ003, 
						  553173X46X523SQ004, 
						  553173X46X523SQ005, 
						  553173X46X523SQ006, 
						  553173X46X523SQ007, 
						  CAST(553173X46X531 AS SIGNED) 553173X46X531,  
						  553173X46X532, 
						  553173X46X536, 
						  553173X46X537, 
						  553173X46X538, 
						  553173X46X539, 
						  553173X46X540, 
						  553173X46X541, 
						  553173X46X542
				FROM      limesurvey.lime_survey_$sid
				WHERE     id = '$save_id'";
		 
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		$return = $query->fetchAll();
		return $return[0];
	
	}

    public function getSurveyResponseData($save_id, $sid){
        $sql = "SELECT    *
				FROM      limesurvey.lime_survey_$sid
				WHERE     id = '$save_id'";

        $query = $this->db_conn->prepare($sql);
        $query->execute();

        $return = $query->fetchAll();
        return $return[0];
    }
	
	public function getLaunchSurveyURL($participant_id) {
		
		$sql = "SELECT    l.sid_id, s.surveyls_title, i.intervention_response_url, l.save_id
				FROM      participant_survey_link l
				LEFT JOIN limesurvey.lime_surveys_languagesettings s
				ON        s.surveyls_survey_id = l.sid_id
				LEFT JOIN intervention i
				ON        i.sid_id = l.sid_id
				WHERE     l.participant_id = '$participant_id'
				AND       i.intervention_type_id = '2'
				ORDER BY  l.participant_survey_link_id DESC
				LIMIT     1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();

		
	}
}