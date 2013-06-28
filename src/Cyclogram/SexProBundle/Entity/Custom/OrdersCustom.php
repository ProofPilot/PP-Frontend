<?php

namespace Cyclogram\SexProBundle\Entity\Custom;

class ordersCustom extends DbCustom
{

    public function getSpecimenListByOrderID($id)
    {
    	$sql = "SELECT    s.specimen_id, s.specimen_kit_number, s.specimen_name, s.specimen_fda_approval_status,
				          ph.specimen_phase_name,
				          t.specimen_collection_tool_name,
				          f.collector_forum_name,
				          st.status_name
				FROM      specimen s
				LEFT JOIN specimen_phase ph
				ON        s.specimen_phase_id = ph.specimen_phase_id
				LEFT JOIN specimen_collection_tool t
				ON        t.specimen_collection_tool_id = s.specimen_collection_tool_id
				LEFT JOIN collector_forum f
				ON        f.collector_forum_id = s.collector_forum_id
				LEFT JOIN status st
				ON        st.status_id = s.status_id
				WHERE     s.specimen_id IN (SELECT specimen_id FROM order_specimen_link WHERE order_id = '$id')";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();    	

    } 
    
    public function getSpecimenListByParticipantID($id)
    {
    	$sql = "SELECT    s.specimen_id, s.specimen_kit_number, s.specimen_name, s.specimen_fda_approval_status,
				          ph.specimen_phase_name,
				          t.specimen_collection_tool_name,
				          f.collector_forum_name,
				          st.status_name,
				          l.order_id
				FROM      specimen s
				LEFT JOIN order_specimen_link l
				ON        l.specimen_id = s.specimen_id
				LEFT JOIN specimen_phase ph
				ON        s.specimen_phase_id = ph.specimen_phase_id
				LEFT JOIN specimen_collection_tool t
				ON        t.specimen_collection_tool_id = s.specimen_collection_tool_id
				LEFT JOIN collector_forum f
				ON        f.collector_forum_id = s.collector_forum_id
				LEFT JOIN status st
				ON        st.status_id = s.status_id
				WHERE     s.specimen_id IN (SELECT specimen_id FROM order_specimen_link WHERE order_id IN (SELECT order_id FROM orders WHERE participant_id = '$id'))";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }
    
    public function getHistoryBySpecimen($id) {
    	
    	$sql = "SELECT    h.specimen_history_id, h.specimen_history_datetime, h.specimen_history_ip_address, h.specimen_history_latitude, h.specimen_history_longitude,
				          p.specimen_phase_name,
				          CONCAT(r.representative_firstname, ' ', r.representative_lastname) as representative 
				FROM      specimen_history h
				LEFT JOIN specimen_phase p
				ON        p.specimen_phase_id = h.specimen_phase_id
				LEFT JOIN representative r
				ON        r.representative_id = h.representative_id
				WHERE     h.specimen_id = '$id'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public function getOrderIdBySpecimenId($specimen_id) {
    	
    	$sql = "SELECT order_id FROM order_specimen_link WHERE specimen_id = '$specimen_id' ";
    	
    	$query = $this->db_conn->prepare($sql);
    	$result = $query->execute();
    	
    	if($result) {
    		$result = $query->fetchAll();
    		return $result[0]['order_id'];
    	}
    	else return false;
     }
    
    public function addSpecimentHistory($specimen_id, $specimen_phase_id, $ip_address, $representative_id) {

    	$sql = "INSERT INTO specimen_history
    			SET    specimen_history_datetime = NOW(),
    				   specimen_history_ip_address = '$ip_address',
    				   specimen_history_latitude = '',
    				   specimen_history_longitude = '',
    				   specimen_id = '$specimen_id',
    				   specimen_phase_id = '$specimen_phase_id',
    				   representative_id = '$representative_id'";

    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return true;
    }
    
    public function linkSpecimenOrder($order_id, $specimen_id) 
    {

    	$sql = "INSERT INTO order_specimen_link
    			SET    specimen_id = '$specimen_id',
    				   order_id = '$order_id'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return true;
    	
    }
    
    /** ************************************************* TEST TEST TEST ************************************************* **/
    
    public function getTestListBySpecimenID($id)
    {
    	$sql = "SELECT    t.test_id, t.test_date_creation, t.test_name, t.test_kit_number, if(t.test_kit_registered=1, 'True','False') test_kit_registered,
					      tt.test_type_name,
					      p.test_phase_name,
					      pr.test_preliminar_result_name,
					      o.test_outcome_type_name,
					      pt.test_proccesing_type_name,
					      f.collector_forum_name,
					      s.status_name 
				FROM      test t
				LEFT JOIN test_type tt
				ON        tt.test_type_id = t.test_type_id
				LEFT JOIN test_phase p
				ON        p.test_phase_id = t.test_phase_id
				LEFT JOIN test_preliminar_result pr
				ON        pr.test_preliminar_result_id = t.test_preliminar_result_id
				LEFT JOIN test_outcome_type o
				ON        o.test_outcome_type_id = t.test_outcome_type_id
				LEFT JOIN test_proccesing_type pt
				ON        pt.test_proccesing_type_id = t.test_proccesing_type_id
				LEFT JOIN collector_forum f
				ON        f.collector_forum_id = t.collector_forum_id
				LEFT JOIN `status` s
				ON        s.status_id = t.status_id
				WHERE     t.test_id IN (SELECT test_id FROM specimen_test_link WHERE specimen_id = '$id')";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }
    
    public function getTestListByParticipantID($id)
    {
    	$sql = "SELECT    t.test_id, t.test_date_creation, t.test_name, t.test_kit_number, if(t.test_kit_registered=1, 'True','False') test_kit_registered,
					      tt.test_type_name,
					      p.test_phase_name,
					      pr.test_preliminar_result_name,
					      o.test_outcome_type_name,
					      pt.test_proccesing_type_name,
					      f.collector_forum_name,
					      s.status_name,
					      stl.specimen_id,
					      osl.order_id
				FROM      test t
				LEFT JOIN test_type tt
				ON        tt.test_type_id = t.test_type_id
				LEFT JOIN test_phase p
				ON        p.test_phase_id = t.test_phase_id
				LEFT JOIN test_preliminar_result pr
				ON        pr.test_preliminar_result_id = t.test_preliminar_result_id
				LEFT JOIN test_outcome_type o
				ON        o.test_outcome_type_id = t.test_outcome_type_id
				LEFT JOIN test_proccesing_type pt
				ON        pt.test_proccesing_type_id = t.test_proccesing_type_id
				LEFT JOIN collector_forum f
				ON        f.collector_forum_id = t.collector_forum_id
				LEFT JOIN `status` s
				ON        s.status_id = t.status_id
				LEFT JOIN specimen_test_link stl
				ON        stl.test_id = t.test_id
				LEFT JOIN order_specimen_link osl
				ON        osl.specimen_id = stl.specimen_id
				WHERE     t.test_id IN 
						  (SELECT test_id FROM specimen_test_link WHERE specimen_id IN
						  	(SELECT specimen_id FROM order_specimen_link WHERE  order_id IN
								(SELECT order_id FROM order_specimen_link WHERE order_id IN 
									(SELECT order_id FROM orders WHERE participant_id = '$id')
							    )
						    )
						  )";
    
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    
    	return $query->fetchAll();
    
    }
    
    public function getTestHistoryBySpecimen($id) {
    	 
    	$sql = "SELECT    h.test_history_id, h.test_history_datetime, h.test_history_ip_address,
				    	  p.test_phase_name,
				    	  CONCAT(r.representative_firstname, ' ', r.representative_lastname) as representative
				FROM      test_history h
				LEFT JOIN test_phase p
				ON        p.test_phase_id = h.test_phase_id
				LEFT JOIN representative r
				ON        r.representative_id = h.representative_id
				WHERE     h.test_id = '$id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return $query->fetchAll();
    }
    
    
    
    public function addTestHistory($test_id, $specimen_phase_id, $ip_address, $representative_id) {
    
    	$sql = "INSERT INTO test_history
    			SET    test_history_datetime = NOW(),
    				   test_history_ip_address = '$ip_address',
    				   test_id = '$test_id',
  				       test_phase_id = '$specimen_phase_id',
    				   representative_id = '$representative_id'";
    
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return true;
    
    }
    
    public function linkSpecimenTest($test_id, $specimen_id)
    {
    
    	$sql = "INSERT INTO specimen_test_link
		    	SET    specimen_id = '$specimen_id',
		    		   test_id = '$test_id'";
    	 
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	return true;
    	 
    }
    
    public function updateBULKOrder($orderId, $data, $address)
    {
    	//Extracting $data
    	/*
    	 *      [0] => 1
			    [1] => 1
			    [2] => 1
			    [3] => 2013-02-19 00:00:00
			    [4] => Michael
			    [5] => Barquero
			    [6] => 7979 NW 23st
			    [7] => Stree2222
			    [8] => Miami
			    [9] => Florida
			    [10] => 33122
			    [11] => ABX1213
			    [12] => 
			    [13] => HomeAccess
			    [14] => 2013-02-12 13:12:13
			    [15] => HomeAccess
			    [16] => 2013-02-15 13:12:13
			    [17] => UPS
			    [18] => 1Z177E0F1326741532
 			    [19] => 
			    [20] => Waiting for results
    	 * 
    	 * 
    	 */
    	
    	$specimen_id = $data[1];
    	$test_id = $data[2];
    	$orderDate = $data[3];
    	$firstName = $data[4];
    	$lastName = $data[5];
    	$street1 = $data[6];
    	$street2 = $data[7];
    	$city = $data[8];
    	$state = $data[9];
    	$zipcode = $data[10];
    	$KitID = $data[11];
    	$fulfilledDate = $data[12];
    	$fulfilledBy = "HomeAccess"; //13
    	$shippedDate = $data[14];
    	$shippedBy = "HomeAccess"; //15
    	$expectedDelivery = $data[16];
    	$sender = $data[17];
    	$trackingID = $data[18];
    	$specimen_kit_received_at_lab = $data[19];
    	$preliminar_result = $data[20];
    	 
    	//Getting ParticipantID base on orderId
    	$sql = "SELECT participant_id
    			FROM   orders 
    			WHERE  order_id = '$orderId'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	$result = $query->fetchAll();
    	
    	if($result) {
    		
    		$participant_id = $result[0]['participant_id'];
    		
    		//Updating Participant Information
    		$sql1 = "UPDATE participant
    				 SET    participant_firstname = '$firstName',
    					    participant_lastname = '$lastName',
    					    participant_address1 = '$street1',
    					    participant_address2 = '$street2',
    					    participant_zipcode = '$zipcode',
    				        country_id = '1',
    					    state_id = '{$address['state_id']}',
    					    city_id = '{$address['city_id']}'
    				 WHERE  participant_id = '$participant_id'";

    		#echo "<hr> $sql1";
    		
    		$query1 = $this->db_conn->prepare($sql1);
    		$query1->execute();
    			
    		//Updating the order
    		$sql2 = "UPDATE orders
		    		 SET    order_datetime = '$orderDate',
		    		        order_fulfilled_datetime = '$fulfilledDate',
				    	    order_tracking_number = '$trackingID',
				    	    order_shipped_datetime = '$shippedDate',
				    	    order_delivered_datetime = '$expectedDelivery'
		    	 	 WHERE  order_id = '$orderId'";
    		
    		#echo "<hr> $sql2";
    		$query2 = $this->db_conn->prepare($sql2);
    		$query2->execute();
    		
    		//Updating the speciment and order
    		$sql3 = "UPDATE specimen
		    		 SET    specimen_kit_number = '$KitID',
		    		        specimen_kit_received_at_lab = '$specimen_kit_received_at_lab'
		    		 WHERE  specimen_id = '$specimen_id'";
    		
    		#echo "<hr> $sql3";
    		$query3 = $this->db_conn->prepare($sql3);
    		$query3->execute();
    		
    		//Updating the speciment and order
    		$sql4 = "UPDATE test
		    		 SET    test_kit_number = '$KitID',
		    		        test_preliminar_result_id = '$preliminar_result'
		    		 WHERE  test_id = '$specimen_id'";
    		
    		#echo "<hr> $sql4";
    		$query4 = $this->db_conn->prepare($sql4);
    		$query4->execute();
    		
    		#exit;
    	}
    	
    	return true;
    }
    
    
    public function download()
    {
    	$sql = "SELECT    o.order_id, 
						  sp.specimen_id as sid,
						  t.test_id as tid,
						  CONCAT(\"\",DATE_FORMAT(o.order_datetime, '%Y-%m-%d %H:%i:%s')) as order_datetime, 
				    	  p.participant_firstname, p.participant_lastname, p.participant_address1, p.participant_address2,
						  ct.city_name,
						  s.state_name,
						  p.participant_zipcode,
						  sp.specimen_kit_number,
				    	  CONCAT(\"\",DATE_FORMAT(o.order_fulfilled_datetime, '%Y-%m-%d %H:%i:%s')) as order_fulfilled_datetime, 
						  'HomeAccess' as fulfillilled_by,
				    	  CONCAT(\"\",DATE_FORMAT(o.order_shipped_datetime, '%Y-%m-%d %H:%i:%s')) as order_shipped_datetime,
						  'HomeAccess' asShippedBy,
				    	  CONCAT(\"\",DATE_FORMAT(o.order_delivered_datetime, '%Y-%m-%d %H:%i:%s')) as order_delivered_datetime, 
						  c.courier_name,
						  o.order_tracking_number,
				    	  CONCAT(\"\",DATE_FORMAT(sp.specimen_kit_received_at_lab, '%Y-%m-%d %H:%i:%s')) as specimen_kit_received_at_lab,
				    	  t.test_preliminar_result_id
				FROM      orders o
				LEFT JOIN participant p
				ON        p.participant_id = o.participant_id
				LEFT JOIN city ct
				ON        ct.city_id = p.city_id
				LEFT JOIN state s
				ON        s.state_id = p.state_id
				LEFT JOIN order_specimen_link osl
				ON        osl.order_id = o.order_id
				LEFT JOIN specimen sp
				ON        sp.specimen_id = osl.specimen_id
				LEFT JOIN courier c
				ON        c.courier_id = o.courier_id
				LEFT JOIN specimen_test_link stl
				ON        stl.specimen_id = sp.specimen_id
				LEFT JOIN test t
				ON        t.test_id = stl.test_id";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public function getParticipantIDFromTestName($test_name) {
    	
    	$sql = "SELECT    o.participant_id
		    	FROM      test t
		    	LEFT JOIN specimen_test_link stl
		    	ON        stl.test_id = t.test_id
		    	LEFT JOIN order_specimen_link osl
		    	ON        osl.specimen_id = stl.specimen_id
		    	LEFT JOIN orders o
		    	ON        o.order_id = osl.order_id
		    	WHERE     t.test_name = '$test_name'";
    	
    	$query = $this->db_conn->prepare($sql);
    	$query->execute();
    	 
    	$result = $query->fetchAll();
    	if($result) return $result[0]['participant_id']; 
    	
    }
}