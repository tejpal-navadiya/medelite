<?php
	function deleteActivityCategory($conn, $firm_id, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE activity_categories SET is_deleted=? WHERE id=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		}
	}
 ?>