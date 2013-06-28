<?php

namespace Cyclogram\SexProBundle\Entity\Custom;

class AppointmentCustom extends DbCustom
{
	public function getDetail($id) {
		
		$sql = "SELECT    a.appointment_id, a.appointment_datetime, a.test_id, a.participant_id, a.organization_id, a.individual_id, a.appointment_type_id, a.appointment_status_id,
				          CONCAT(p.participant_firstname, ' ', p.participant_lastname) participant,
				          o.organization_name organization,
				          CONCAT(i.individual_firstname, ' ', i.individual_lastname) individual,
				          apt.appointment_type_name,
				          aps.appointment_status_name,
				          st.status_name status 
				FROM      appointment a
				LEFT JOIN participant p
				ON        p.participant_id = a.participant_id
				LEFT JOIN organization o
				ON        o.organization_id = a.organization_id
				LEFT JOIN individual i
				ON        i.individual_id = a.individual_id
				LEFT JOIN appointment_type apt
				ON        apt.appointment_type_id = a.appointment_type_id
				LEFT JOIN appointment_status aps
				ON        aps.appointment_status_id = a.appointment_status_id
				LEFT JOIN status st
				ON        st.status_id = a.status_id
				WHERE     a.appointment_id = '$id';";
		
		$query = $this->db_conn->prepare($sql);
		$query->execute();
		
		$result = $query->fetchAll();
		return $result[0];
	}
	
	
}