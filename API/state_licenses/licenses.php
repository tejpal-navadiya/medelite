<?php
	

	function deleteStatelicenses($conn,$ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$task_detail_qry = "SELECT * FROM me_licenses_list WHERE id='$id' limit 1";
			$task_data_result = mysqli_query($conn, $task_detail_qry)or die(mysqli_error($conn));
			// $task_data = $task_data_result->get_result()->fetch_assoc();
			if($task_data_result)
			{
				// deleteTaskReminder($conn,$id);
				$remove_task = "UPDATE me_licenses_list SET is_deleted='1' WHERE id='$id' ";
				$is_deleted = mysqli_query($conn, $remove_task)or die(mysqli_error($conn));

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