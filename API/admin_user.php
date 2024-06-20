<?php
	function deleteAdminUser($conn, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE admin_users SET is_deleted=? WHERE id=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		}
	}

	
 ?>