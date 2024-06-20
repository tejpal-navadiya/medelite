<?php
	function deleteActivity($conn, $firm_id, $ids, $updated_by){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE activities SET is_deleted=? WHERE id=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;

			$ac_log_data_qry = "SELECT activities.*, m.name as matter_name, u.name as user_name, ac.name as ac_name
									FROM activities
									LEFT JOIN matters m on m.id = activities.matter_id 
									LEFT JOIN users u on u.id = activities.user_id
									LEFT JOIN activity_categories ac on ac.id = activities.activity_category_id 
									WHERE activities.id=? limit 1";
			$ac_log_data_result = prepared_select($conn, $ac_log_data_qry, [$id]);
			if($ac_log_data_result->num_rows){
				$ac_log_data = $ac_log_data_result->fetch_assoc();
				
				$log_user_qry = "SELECT id, name FROM users WHERE id=?";
				$log_user_result = prepared_select($conn, $log_user_qry, [$updated_by]);
				$log_user_data = $log_user_result->fetch_assoc();
				$log_user_name = $log_user_data['name'] ?:"";
				$log_description = $log_user_name." removed the ".ucwords(str_replace("_"," ",$ac_log_data['type']));
				if($ac_log_data['matter_name']){
					$log_description .= ", for the matter '".$ac_log_data['matter_name']."'";						
				}
				saveLog($conn, $firm_id, $updated_by, "deleted", $id, "activities", $ac_log_data['type'], $log_description);
			}
		}
	}
	
 ?>