<?php
	function addTaskReminders($conn, $firm_id, $task_id, $created_by, $task_reminders_list){
		deleteTaskReminder($conn,$task_id);
		$task_reminders = json_decode($task_reminders_list);
		foreach ($task_reminders as $task_reminder) {
			$type = $task_reminder->type;
			$remind_time = $task_reminder->remind_time;
			$remind_type = $task_reminder->remind_type;

			$add_tr = $conn->prepare("INSERT INTO task_reminders (task_id, type, remind_time, remind_type, created_by) VALUES (?, ?, ?, ?, ?)");
			$add_tr->bind_param("isssi", $task_id, $type, $remind_time, $remind_type, $created_by);
			$add_tr->execute();
		}
	}

	function deleteTasks($conn, $firm_id, $updated_by, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$task_detail_qry = "SELECT id FROM tasks WHERE id=? AND firm_id=? limit 1";
			$task_data_result = prepared_query($conn, $task_detail_qry, [$id, $firm_id]);
			$task_data = $task_data_result->get_result()->fetch_assoc();
			if($task_data){
				deleteTaskReminder($conn,$id);
				$remove_task = "UPDATE tasks SET is_deleted=?, updated_by=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_task, [1, $updated_by, $id])->affected_rows;

				$task_log_data_qry = "SELECT tasks.*, m.name as matter_name, cb.name as cb_name
											FROM tasks
											LEFT JOIN matters m on m.id = tasks.matter_id 
											LEFT JOIN users cb on cb.id = tasks.created_by 
											WHERE tasks.id=? limit 1";
				$task_log_data_result = prepared_select($conn, $task_log_data_qry, [$id]);
				if($task_log_data_result->num_rows){
					$task_log_data = $task_log_data_result->fetch_assoc();

					$log_user_qry = "SELECT id, name FROM users WHERE id=?";
					$log_user_result = prepared_select($conn, $log_user_qry, [$updated_by]);
					$log_user_data = $log_user_result->fetch_assoc();
					$log_user_name = $log_user_data['name'] ?:"";
					$log_description = $log_user_name." removed a task, ".$task_log_data['name'];
					if($task_log_data['matter_name']){
						$log_description .= ", for the matter '".$task_log_data['matter_name']."'";						
					}
					saveLog($conn, $firm_id, $updated_by, "deleted", $id, "tasks", "", $log_description);
				}
			}
		}
	}

	function deleteTaskReminder($conn, $id){
		$remove_tr = "UPDATE task_reminders SET is_deleted=? WHERE task_id=? ";
		$is_deleted = prepared_query($conn, $remove_tr, [1, $id])->affected_rows;
		return $is_deleted;
	}

	function deleteReminders($conn, $firm_id, $updated_by, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$task_detail_qry = "SELECT id FROM task_reminders WHERE id=?  limit 1";
			$task_data_result = prepared_query($conn, $task_detail_qry, [$id]);
			$task_data = $task_data_result->get_result()->fetch_assoc();
			if($task_data){
				$remove_task = "UPDATE task_reminders SET is_deleted=?, updated_by=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_task, [1, $updated_by, $id])->affected_rows;

				
			}
		}
	}
 ?>