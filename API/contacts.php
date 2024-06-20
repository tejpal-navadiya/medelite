<?php 
	function addContactAddresses($conn, $contact_id, $created_by, $addressList){
		deleteContactAddress($conn,$contact_id);
		$addresses = json_decode($addressList);
		foreach ($addresses as $address) {
			$contact_id = (int) $contact_id;
			$street = $address->street ?: "";
			$city = $address->city ?: "";
			$state = $address->state ?: "";
			$zip = $address->zip ?: "";
			$country_id = (int) $address->country_id;
			$state_id = (int) $address->state_id;
			$type = $address->type ?: "other";
			$created_by = (int) $created_by;

			$addAddress = $conn->prepare("INSERT INTO contact_addresses (contact_id, street, city, state, zip, country_id, type, created_by, state_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$addAddress->bind_param("issssisii", $contact_id, $street, $city, $state, $zip, $country_id, $type, $created_by,$state_id);
			$addAddress->execute();
		}
	}

	function addContactEmails($conn, $contact_id, $created_by, $emailList){
		deleteContactEmails($conn,$contact_id);
		$emails = json_decode($emailList);
		foreach ($emails as $emaildata) {
			$contact_id = (int) $contact_id;
			$email = $emaildata->email ?: "";
			$type = $emaildata->type ?: "other";
			$is_primary = (int) $emaildata->is_primary;			
			$created_by = (int) $created_by;

			$addEmail = $conn->prepare("INSERT INTO contact_emails (contact_id, email, type, is_primary, created_by) VALUES (?, ?, ?, ?, ?)");
			$addEmail->bind_param("issii", $contact_id, $email, $type, $is_primary, $created_by);
			$addEmail->execute();
		}
	}

	function addContactPhones($conn, $contact_id, $created_by, $phoneList){
		deleteContactPhones($conn,$contact_id);
		$phones = json_decode($phoneList);
		foreach ($phones as $phonedata) {
			$contact_id = (int) $contact_id;
			$phone = $phonedata->phone ?: "";
			$type = $phonedata->type ?: "other";
			$is_primary = (int) $phonedata->is_primary;
			$created_by = (int) $created_by;

			$addPhone = $conn->prepare("INSERT INTO contact_phones (contact_id, phone, type, is_primary, created_by) VALUES (?, ?, ?, ?, ?)");
			$addPhone->bind_param("issii", $contact_id, $phone, $type, $is_primary, $created_by);
			$addPhone->execute();
		}
	}

	function addContactWebs($conn, $contact_id, $created_by, $webList){
		deleteContactWebsites($conn,$contact_id);
		$webs = json_decode($webList);
		foreach ($webs as $webdata) {
			$contact_id = (int) $contact_id;
			$website = $webdata->website ?: "";
			$type = $webdata->type ?: "other";
			$is_primary = (int) $webdata->is_primary;
			$created_by = (int) $created_by;

			$addWeb = $conn->prepare("INSERT INTO contact_websites (contact_id, website, type, is_primary, created_by) VALUES (?, ?, ?, ?, ?)");
			$addWeb->bind_param("issii", $contact_id, $website, $type, $is_primary, $created_by);
			$addWeb->execute();
		}
	}

	function deleteContact($conn, $firm_id, $updated_by, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$cont_detail_qry = "SELECT photo,name FROM contacts WHERE id=? AND firm_id=? limit 1";
			$cont_data_result = prepared_query($conn, $cont_detail_qry, [$id, $firm_id]);
			$con_data = $cont_data_result->get_result()->fetch_assoc();
			if($con_data){
				
				if($con_data['photo']){
					unlink( "../../uploads/contact/profile/".$con_data['photo'] );	
				}
				deleteContactAddress($conn,$id);
				deleteContactEmails($conn,$id);
				deleteContactPhones($conn,$id);
				deleteContactWebsites($conn,$id);

				$remove_contact_notes = "UPDATE notes SET is_deleted=?, updated_by=? WHERE type='contact' AND contact_id=? ";
				$is_deleted_notes = prepared_query($conn, $remove_contact_notes, [1, $updated_by, $id])->affected_rows;


				$remove_contact = "UPDATE contacts SET is_deleted=?, updated_by=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_contact, [1, $updated_by, $id])->affected_rows;

				$log_user_qry = "SELECT id, name FROM users WHERE id=?";
				$log_user_result = prepared_select($conn, $log_user_qry, [$updated_by]);
				$log_user_data = $log_user_result->fetch_assoc();
				$log_user_name = $log_user_data['name'] ?:"";
				$log_description = $log_user_name." deleted the Contact ".$con_data['name'];
				saveLog($conn, $firm_id, $updated_by, "deleted", $id, "contacts", "person", $log_description);

				// $remove_contact = $conn->prepare("DELETE FROM contacts WHERE id = ? AND firm_id = ?");
				// $remove_contact->bind_param("ii", $id, $firm_id);
				// $remove_contact->execute();
			}
		}
	}

	function deleteContactAddress($conn, $id){
		$remove_address = "UPDATE contact_addresses SET is_deleted=? WHERE contact_id=? ";
		$is_deleted = prepared_query($conn, $remove_address, [1, $id])->affected_rows;
		return $is_deleted;

	}

	function deleteContactEmails($conn, $id){
		$remove_emails = "UPDATE contact_emails SET is_deleted=? WHERE contact_id=? ";
		$is_deleted = prepared_query($conn, $remove_emails, [1, $id])->affected_rows;
		return $is_deleted;
	}

	function deleteContactPhones($conn, $id){
		$remove_phones = "UPDATE contact_phones SET is_deleted=? WHERE contact_id=? ";
		$is_deleted = prepared_query($conn, $remove_phones, [1, $id])->affected_rows;
		return $is_deleted;
	}

	function deleteContactWebsites($conn, $id){
		$remove_webs = "UPDATE contact_websites SET is_deleted=? WHERE contact_id=? ";
		$is_deleted = prepared_query($conn, $remove_webs, [1, $id])->affected_rows;
		return $is_deleted;
	}
 ?>