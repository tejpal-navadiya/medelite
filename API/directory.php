<?php
	

	function deleteDirectory($conn, $firm_id, $ids, $updated_by){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$task_detail_qry = "SELECT id FROM me_directories WHERE id=? AND firm_id=? limit 1";
			$task_data_result = prepared_query($conn, $task_detail_qry, [$id, $firm_id]);
			$task_data = $task_data_result->get_result()->fetch_assoc();
			if($task_data){
				// deleteTaskReminder($conn,$id);
				$remove_task = "UPDATE me_directories SET is_deleted=?, updated_by=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_task, [1, $updated_by, $id])->affected_rows;

				// $task_log_data_qry = "SELECT me_directories.*, m.name as matter_name, cb.name as cb_name
				// 							FROM me_directories
				// 							LEFT JOIN matters m on m.id = me_directories.matter_id 
				// 							LEFT JOIN users cb on cb.id = me_directories.created_by 
				// 							WHERE me_directories.id=? limit 1";
				// $task_log_data_result = prepared_select($conn, $task_log_data_qry, [$id]);
				// if($task_log_data_result->num_rows){
				// 	$task_log_data = $task_log_data_result->fetch_assoc();

				// 	$log_user_qry = "SELECT id, name FROM users WHERE id=?";
				// 	$log_user_result = prepared_select($conn, $log_user_qry, [$updated_by]);
				// 	$log_user_data = $log_user_result->fetch_assoc();
				// 	$log_user_name = $log_user_data['name'] ?:"";
				// 	$log_description = $log_user_name." removed a task, ".$task_log_data['name'];
				// 	if($task_log_data['matter_name']){
				// 		$log_description .= ", for the matter '".$task_log_data['matter_name']."'";						
				// 	}
				// 	saveLog($conn, $firm_id, $updated_by, "deleted", $id, "me_directories", "", $log_description);
				// }
			}
		}
	}

	
 ?>