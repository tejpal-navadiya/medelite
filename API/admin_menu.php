<?php
	function deleteAdminMenu($conn, $firm_id, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE admin_menu SET is_deleted=? WHERE mid=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		}
	}

	function deleteSubscriptionPlan($conn, $firm_id, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE admin_subscription SET is_deleted=? WHERE mid=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		}
	}

	function updateAdminFirmStatus($conn, $firm_id, $ids,$status){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE firms SET status=? WHERE id=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [$status, $id])->affected_rows;

			$remove_ac_us = "UPDATE users SET status=? WHERE firm_id=? ";
			$is_deleted_us = prepared_query($conn, $remove_ac_us, [$status, $id])->affected_rows;
		}
	}

	function updateAdminFirmUserStatus($conn, $firm_id, $ids,$status){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			// $remove_ac = "UPDATE firms SET status=? WHERE id=? ";
			// $is_deleted = prepared_query($conn, $remove_ac, [$status, $id])->affected_rows;

			$remove_ac_us = "UPDATE users SET status=? WHERE id=? ";
			$is_deleted_us = prepared_query($conn, $remove_ac_us, [$status, $id])->affected_rows;
		}
	}
 ?>