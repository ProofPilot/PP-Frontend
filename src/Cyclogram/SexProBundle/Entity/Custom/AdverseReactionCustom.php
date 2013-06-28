<?php

namespace Cyclogram\SexProBundle\Entity\Custom;

class adverseReactionCustom extends DbCustom
{

	public function insertHistory($id, $rid) {
		
		$sql = "INSERT INTO adverse_reaction_history
				SET    adverse_reaction_id = '$id',
				       adverse_reaction_history_datetime = NOW(),
				       representative_id = '$rid'";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		return true;
	}
	
	public function getList()
	{
		$sql = "SELECT    a.adverse_reaction_id, a.adverse_reaction_datetime_creation, a.adverse_reaction_datetime_lastcontact,
				          CONCAT(p.participant_firstname, ' ', p.participant_lastname) participant,
						  p.participant_id,
				          s.study_name study,
				          it.intervention_type_name intervention,
				          CONCAT(r.representative_firstname, ' ', r.representative_lastname) representative,
				          st.status_name status,
						  DATEDIFF(NOW(), a.adverse_reaction_datetime_lastcontact) AS days
				FROM      adverse_reaction a
				LEFT JOIN participant p
				ON        p.participant_id = a.participant_id
				LEFT JOIN study s
				ON        s.study_id = a.study_id
				LEFT JOIN intervention_type it
				ON        it.intervention_type_id = a.intervention_type_id
				LEFT JOIN representative r
				ON        r.representative_id = a.representative_id
				LEFT JOIN status st
				ON        st.status_id = a.status_id
				WHERE     1 = 1";
		 
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	
	}	
	
	
	public function getListByParticipantID($id)
	{
		$sql = "SELECT    a.adverse_reaction_id, a.adverse_reaction_datetime_creation, a.adverse_reaction_datetime_lastcontact,
				          CONCAT(p.participant_firstname, ' ', p.participant_lastname) participant,
				          p.participant_id,
				          s.study_name study,
				          it.intervention_type_name intervention,
				          CONCAT(r.representative_firstname, ' ', r.representative_lastname) representative,
				          st.status_name status,
						  DATEDIFF(NOW(), a.adverse_reaction_datetime_lastcontact) AS days
				FROM      adverse_reaction a
				LEFT JOIN participant p
				ON        p.participant_id = a.participant_id
				LEFT JOIN study s
				ON        s.study_id = a.study_id
				LEFT JOIN intervention_type it
				ON        it.intervention_type_id = a.intervention_type_id
				LEFT JOIN representative r
				ON        r.representative_id = a.representative_id
				LEFT JOIN status st
				ON        st.status_id = a.status_id
				WHERE     a.participant_id = '$id'";
			
		$query = $this->db_conn->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	
	}
	
	public function getAdverseReactionInfo($id) {
		
		$sql = "SELECT    a.adverse_reaction_id, a.adverse_reaction_datetime_creation, a.adverse_reaction_datetime_lastcontact,
				          CONCAT(p.participant_firstname, ' ', p.participant_lastname) participant,
				          p.participant_id,
				          s.study_name study,
				          it.intervention_type_name intervention,
				          CONCAT(r.representative_firstname, ' ', r.representative_lastname) representative,
				          st.status_name status_name,
						  DATEDIFF(NOW(), a.adverse_reaction_datetime_lastcontact) AS days
				FROM      adverse_reaction a
				LEFT JOIN participant p
				ON        p.participant_id = a.participant_id
				LEFT JOIN study s
				ON        s.study_id = a.study_id
				LEFT JOIN intervention_type it
				ON        it.intervention_type_id = a.intervention_type_id
				LEFT JOIN representative r
				ON        r.representative_id = a.representative_id
				LEFT JOIN status st
				ON        st.status_id = a.status_id
				WHERE     a.adverse_reaction_id = '$id'";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		return $query->fetchAll();		
		
	}
	
	public function getAdverseReactionHistory($id, $order) {
		
		$sql = "SELECT    h.adverse_reaction_history_id, h.adverse_reaction_history_datetime, h.adverse_reaction_id, DATEDIFF(NOW(), h.adverse_reaction_history_datetime) AS days,
				          CONCAT(r.representative_firstname, ' ', r.representative_lastname) representative            
				FROM      adverse_reaction_history h
				LEFT JOIN representative r
				ON        r.representative_id = h.representative_id
				WHERE     h.adverse_reaction_id = '$id'
				ORDER BY  h.adverse_reaction_history_id $order 
				LIMIT     1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		return $query->fetchAll();		
	}
	
	public function getLatestReferral($id) {
		
		$sql = "SELECT    r.adverse_reaction_referal_id, r.adverse_reaction_referal_datetime, r.adverse_reaction_id,
						  CONCAT(rp.representative_firstname, ' ', rp.representative_lastname) representative,
						  CONCAT(i.individual_firstname, ' ', i.individual_lastname) individual,
						  organization_name organization,
						  s.status_name
				FROM      adverse_reaction_referal r
				LEFT JOIN representative rp
				ON        rp.representative_id = r.representative_id
				LEFT JOIN individual i
				ON        i.individual_id = r.individual_id
				LEFT JOIN organization o
				ON        o.organization_id = r.organization_id
				LEFT JOIN status s
				ON        s.status_id = r.status_id
				WHERE     r.adverse_reaction_id = '$id'
				AND       s.status_id = '1'
				ORDER BY  r.adverse_reaction_referal_id DESC
				LIMIT     1";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		return $query->fetchAll();		
	}
	
	
}