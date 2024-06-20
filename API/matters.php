<?php 
	function generateMatterName($conn, $firm_id, $client_id){
		$matter_data_qry = "SELECT * FROM matters WHERE firm_id=? ";
		$matter_data_result = prepared_select($conn, $matter_data_qry, [$firm_id]);
		$matter_count = ($matter_data_result->num_rows ?: 0) + 1;

		$name = str_pad($matter_count,5,"0",STR_PAD_LEFT);
		// $matter_data = $matter_data_result->fetch_assoc();
		// $name.="-".$matter_data['description'];
		/*
		$contact_data_qry = "SELECT id, firm_id, name, last_name FROM contacts WHERE id=? AND firm_id=? limit 1";
		$contact_data_result = prepared_select($conn, $contact_data_qry, [$client_id, $firm_id]);
		if($contact_data_result->num_rows){
			$data = $contact_data_result->fetch_assoc();
			// $name .= $data['name'] ? " - ".$data['name'] : "";
			// $name .= $data['last_name'] ? " ".$data['last_name'] : "";			
		}*/
		return $name;
	}

	function addRelatedContacts($conn, $firm_id, $matter_id, $created_by, $related_contact_list){
		deleteRelatedContact($conn,$matter_id);
		$related_contacts = json_decode($related_contact_list);
		foreach ($related_contacts as $related_contact) {
			$contact_id = (int) $related_contact->contact_id;
			$relation = $related_contact->relation ?: "";
			$is_bill_reciepient = $related_contact->is_bill_reciepient;

			$add_rc = $conn->prepare("INSERT INTO matter_related_contacts (firm_id, matter_id, contact_id, relation, is_bill_reciepient, created_by) VALUES (?, ?, ?, ?, ?, ?)");
			$add_rc->bind_param("iiisii", $firm_id, $matter_id, $contact_id, $relation, $is_bill_reciepient, $created_by);
			$add_rc->execute();
		}
	}

	function deleteMatters($conn, $firm_id, $updated_by, $ids)
	{
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$matter_detail_qry = "SELECT id,name FROM matters WHERE id=? AND firm_id=? limit 1";
			$matter_data_result = prepared_query($conn, $matter_detail_qry, [$id, $firm_id]);
			$matter_data = $matter_data_result->get_result()->fetch_assoc();
			if($matter_data){
				deleteRelatedContact($conn,$id);
				$remove_matter = "UPDATE matters SET is_deleted=?, updated_by=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_matter, [1, $updated_by, $id])->affected_rows;

				mysqli_query($conn,"UPDATE activities SET is_deleted='1' WHERE matter_id='$id' ");
				mysqli_query($conn,"UPDATE tasks SET is_deleted='1' WHERE matter_id='$id' ");
				mysqli_query($conn,"UPDATE funds SET is_deleted='1' WHERE matter_id='$id' ");
				mysqli_query($conn,"DELETE FROM mattter_closing_statement WHERE matter_id='$id' ");

				$log_user_qry = "SELECT id, name FROM users WHERE id=?";
				$log_user_result = prepared_select($conn, $log_user_qry, [$updated_by]);
				$log_user_data = $log_user_result->fetch_assoc();
				$log_user_name = $log_user_data['name'] ?:"";
				$log_description = $log_user_name." deleted the Matter ".$matter_data['name'];
				saveLog($conn, $firm_id, $updated_by, "deleted", $id, "matters", "matter", $log_description);
			}
		}
	}

	function deleteRelatedContact($conn, $id){
		$remove_rc = "UPDATE matter_related_contacts SET is_deleted=? WHERE matter_id=? ";
		$is_deleted = prepared_query($conn, $remove_rc, [1, $id])->affected_rows;
		return $is_deleted;
	}

	function GetMatterTypeCondition($user_type="user",$condition_type="single", $created_by)
	{
		$additional_condition="";
		if($condition_type=="single")
		{
			if($user_type=="user")
			{
				$additional_condition=" AND ((permission_type='everyone') OR (permission_type='me' AND created_by='$created_by'))";
			}
		}else
		{
			if($user_type=="user")
			{
				$additional_condition=" AND ((matters.permission_type='everyone') OR (matters.permission_type='me' AND matters.created_by='$created_by'))";
			}
		}
		return $additional_condition;
	}

	
 ?>