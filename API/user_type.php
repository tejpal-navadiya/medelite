<?php
	function deleteFirmUsers($conn, $firm_id, $updated_by, $ids){
		$ids = json_decode($ids);
		$return_data=array();
		$id_arr=array();
		if(!is_array($ids))
		{
			$id_arr[]=$ids;
		}else
		{
			$id_arr=$ids;
		}
		foreach ($id_arr as $id) {
			$task_detail_qry = "SELECT id FROM users WHERE id=? AND firm_id=? limit 1";
			$task_data_result = prepared_query($conn, $task_detail_qry, [$id, $firm_id]);
			$task_data = $task_data_result->get_result()->fetch_assoc();
			if($task_data){
				$remove_task = "UPDATE users SET is_deleted=?, updated_by=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_task, [1, $updated_by, $id])->affected_rows;
				$return_data[]=$id;
				
			}
		}
		$return_data=$id_arr;
		return $return_data;
	}

	function deleteUserType($conn, $firm_id, $ids){
		$ids = json_decode($ids);
		foreach ($ids as $id) {
			$remove_ac = "UPDATE user_type SET is_deleted=? WHERE id=? ";
			$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		}
	}

	function UpdateUserRoleAccess($conn, $firm_id, $data,$token){
		$user_type=$data['user_type'];
		$role_access=$data['role_access'];
		$role_access = json_decode($role_access);

		// $stmt = $conn->prepare("SELECT * FROM admin_menu  WHERE  is_deleted='0' ");
		$stmt = mysqli_query($conn,"SELECT * FROM firm_admin_menu  WHERE firm_id='$firm_id' AND is_deleted='0' ");

		// $stmt->execute();
		$all_admin_access = array();
		while($fet_menu=mysqli_fetch_assoc($stmt))
		{
			$all_admin_access[]=$fet_menu;
		}
		prepared_query($conn, " DELETE FROM user_access WHERE firm_id=? AND utype=? ", [$firm_id, $user_type]);
		foreach($all_admin_access as $row)
		{
			$mid=$row['mid'];
			$mname=$row['mname'];
			$mtitle=$row['mtitle'];
			$is_access=0;
			if(in_array($mid,$role_access)){$is_access=1;}
			prepared_query($conn, " INSERT INTO user_access (mname,mtitle,mid,is_access,firm_id,utype) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$is_access,$firm_id,$user_type]);
		}
		// $role_access = json_decode($role_access);
		// foreach ($ids as $id) {
		// 	$remove_ac = "UPDATE user_type SET is_deleted=? WHERE id=? ";
		// 	$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		// }
	}

	function UpdateAllAccessIfNotExist($conn, $firm_id, $utype,$token,$default_access="0"){
		

		$stmt = mysqli_query($conn,"SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND  is_deleted='0' ");
		// $stmt = mysqli_query($conn,"SELECT * FROM admin_menu  WHERE  is_deleted='0' ");

		// 
		// $stmt->execute();
		$all_admin_access = array();
		while($fet_menu=mysqli_fetch_assoc($stmt))
		{
			$all_admin_access[]=$fet_menu;
		}
		// prepared_query($conn, " DELETE FROM user_access WHERE firm_id=? AND utype=? ", [$firm_id, $utype]);
		foreach($all_admin_access as $row)
		{
			$mid=$row['mid'];
			$mname=$row['mname'];
			$mtitle=$row['mtitle'];
			$is_access=0;
			$is_access=$default_access;
			$access_data_qry = $conn->prepare("SELECT * FROM user_access WHERE firm_id='$firm_id' AND mid='$mid' AND utype='$utype' ");
			$access_data_qry->execute();
			$access_data_result = $access_data_qry->get_result();

			$total_rows = $access_data_result->num_rows;
			if($total_rows<=0)
			{
				prepared_query($conn, " INSERT INTO user_access (mname,mtitle,mid,is_access,firm_id,utype) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$is_access,$firm_id,$utype]);
			}
			
		}
		// $role_access = json_decode($role_access);
		// foreach ($ids as $id) {
		// 	$remove_ac = "UPDATE user_type SET is_deleted=? WHERE id=? ";
		// 	$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		// }
	}
	function getFirmPlan($conn, $firm_id,$is_create_new="0")
	{
		$plan_id="0";

		$subscription_result = mysqli_query($conn, "SELECT * from  firm_subscription WHERE firm_id='$firm_id' AND is_deleted='0' ");
		if(mysqli_num_rows($subscription_result)>0)
		{
			$fet_subscription=mysqli_fetch_assoc($subscription_result);
			if(isset($fet_subscription['subscription_id']))
			{
				$plan_id=$fet_subscription['subscription_id'];
			}
		}else
		{
			if($is_create_new=="1")
			{
				$today_date=date('Y-m-d H:i:s');
				$expiry_date=date('Y-m-d H:i:s',strtotime("+1 Year"));
				$add_dummy_plan=mysqli_query($conn,"INSERT INTO firm_subscription (firm_id,subscription_id,expired_at,created_at,is_deleted) VALUES ('$firm_id','1','$expiry_date','$today_date','0') ");
				$plan_id="1";
			}
		}
		return $plan_id;
	}
	function UpdateAllPlanMenuIfNotExist($conn, $plan_id,$token)
	{
		

		$stmt = mysqli_query($conn,"SELECT * FROM admin_menu  WHERE  is_deleted='0' ");

		// $stmt->execute();
		$all_admin_menu = array();
		while($fet_menu=mysqli_fetch_assoc($stmt))
		{
			$all_admin_menu[]=$fet_menu;
		}
		$return_data=array();
		// prepared_query($conn, " DELETE FROM user_access WHERE firm_id=? AND utype=? ", [$firm_id, $utype]);
		foreach($all_admin_menu as $row)
		{
			$mid=$row['mid'];
			$mname=$row['mname'];
			$mtitle=$row['mtitle'];
			$pmenu=$row['pmenu'];
			$is_deleted=0;
			$access_data_qry = mysqli_query($conn,"SELECT * FROM plan_admin_menu WHERE plan_id='$plan_id' AND mid='$mid'  ");
			// $access_data_qry = $conn->prepare("SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND mid='$mid'  ");
			// $access_data_qry->execute();
			// $access_data_result = $access_data_qry->get_result();

			// $total_rows = $access_data_result->num_rows;
			$total_rows =mysqli_num_rows($access_data_qry);
			$return_data[$mid]="";
			if($total_rows<=0)
			{
				prepared_query($conn, " INSERT INTO plan_admin_menu (mname,mtitle,mid,pmenu,is_deleted,plan_id) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$pmenu,$is_deleted,$plan_id]);
			}
			
		}
		return $return_data;
	}

	function UpdateAllFirmMenuIfNotExist($conn, $firm_id,$token)
	{
		$return_data=array();
		$plan_id=getFirmPlan($conn, $firm_id,"1");
		if($plan_id!="0")
		{
			$stmt = mysqli_query($conn,"SELECT * FROM plan_admin_menu  WHERE  plan_id='$plan_id' AND is_deleted='0' ");

			// $stmt->execute();
			$all_admin_menu = array();
			while($fet_menu=mysqli_fetch_assoc($stmt))
			{
				$all_admin_menu[]=$fet_menu;
			}
			
			// prepared_query($conn, " DELETE FROM user_access WHERE firm_id=? AND utype=? ", [$firm_id, $utype]);
			foreach($all_admin_menu as $row)
			{
				$mid=$row['mid'];
				$mname=$row['mname'];
				$mtitle=$row['mtitle'];
				$pmenu=$row['pmenu'];
				$is_deleted=0;
				$access_data_qry = mysqli_query($conn,"SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND mid='$mid'  ");
				// $access_data_qry = $conn->prepare("SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND mid='$mid'  ");
				// $access_data_qry->execute();
				// $access_data_result = $access_data_qry->get_result();

				// $total_rows = $access_data_result->num_rows;
				$total_rows =mysqli_num_rows($access_data_qry);
				$return_data[$mid]="SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND mid='$mid'  ";
				if($total_rows<=0)
				{
					prepared_query($conn, " INSERT INTO firm_admin_menu (mname,mtitle,mid,pmenu,is_deleted,firm_id) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$pmenu,$is_deleted,$firm_id]);
				}
				
			}
		}

		
		return $return_data;
	}

	function UpdateAcessFirmMenu($conn, $firm_id,$menu_access)
	{
		
		$menu_access = json_decode($menu_access,true);
		$plan_id=getFirmPlan($conn, $firm_id);

		if($plan_id!="0")
		{
			$stmt = mysqli_query($conn,"SELECT * FROM plan_admin_menu  WHERE  plan_id='$plan_id' AND is_deleted='0' ");

			// $stmt->execute();
			$all_admin_menu = array();
			while($fet_menu=mysqli_fetch_assoc($stmt))
			{
				$all_admin_menu[]=$fet_menu;
			}
			prepared_query($conn, " DELETE FROM firm_admin_menu WHERE firm_id=? ", [$firm_id]);
			foreach($all_admin_menu as $row)
			{
				$mid=$row['mid'];
				$mname=$row['mname'];
				$mtitle=$row['mtitle'];
				$pmenu=$row['pmenu'];
				$is_deleted=0;
				$access_data_qry = $conn->prepare("SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND mid='$mid'  ");
				$access_data_qry->execute();
				$access_data_result = $access_data_qry->get_result();

				$total_rows = $access_data_result->num_rows;
				if($total_rows<=0)
				{
					if(!in_array($mid,$menu_access))
					{
						$is_deleted=1;
					}
					prepared_query($conn, " INSERT INTO firm_admin_menu (mname,mtitle,mid,pmenu,is_deleted,firm_id) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$pmenu,$is_deleted,$firm_id]);
				}
				
			}
		}
		
	}

	function UpdateAcessPlanMenu($conn, $plan_id,$menu_access)
	{
		
		$menu_access = json_decode($menu_access,true);
		
		$stmt = mysqli_query($conn,"SELECT * FROM admin_menu  WHERE  is_deleted='0' ");

		// $stmt->execute();
		$all_admin_menu = array();
		while($fet_menu=mysqli_fetch_assoc($stmt))
		{
			$all_admin_menu[]=$fet_menu;
		}
		prepared_query($conn, " DELETE FROM plan_admin_menu WHERE plan_id=? ", [$plan_id]);
		foreach($all_admin_menu as $row)
		{
			$mid=$row['mid'];
			$mname=$row['mname'];
			$mtitle=$row['mtitle'];
			$pmenu=$row['pmenu'];
			$is_deleted=0;
			$access_data_qry = $conn->prepare("SELECT * FROM plan_admin_menu WHERE plan_id='$plan_id' AND mid='$mid'  ");
			$access_data_qry->execute();
			$access_data_result = $access_data_qry->get_result();

			$total_rows = $access_data_result->num_rows;
			if($total_rows<=0)
			{
				if(!in_array($mid,$menu_access))
				{
					$is_deleted=1;
				}
				prepared_query($conn, " INSERT INTO plan_admin_menu (mname,mtitle,mid,pmenu,is_deleted,plan_id) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$pmenu,$is_deleted,$plan_id]);
			}
			
		}
		
		
	}

	function UpdateSubscriptionPlan($conn,$firm_id,$plan_id="1")
	{
		$select_plan_details=mysqli_query($conn,"SELECT * from admin_subscription WHERE id='$plan_id' ");
		if(mysqli_num_rows($select_plan_details)>0)
		{
			$fet_plan_details=mysqli_fetch_assoc($select_plan_details);
			// $check_if_plan_selected=mysqli_query($conn,"SELECT * FROM firm_subscription WHERE firm_id='$firm_id' AND is_deleted='' ")
			$update_old_plan=mysqli_query($conn,"UPDATE firm_subscription SET is_deleted='1' WHERE firm_id='$firm_id' ");

			$sel_firm_details=mysqli_query($conn,"SELECT * from firms WHERE id='$firm_id' ");
			$fet_firm_details=mysqli_fetch_assoc($sel_firm_details);

			$plan_start_date=$fet_firm_details['plan_start_date'];
			$plan_end_date=$fet_firm_details['plan_end_date'];
			$expired_at=$plan_end_date;
			$created_by=$fet_firm_details['created_by'];
			$created_at=date('Y-m-d H:i:s');

			$subscription_id=$plan_id;
			$is_deleted=0;

			$add_new_plan=mysqli_query($conn,"INSERT INTO firm_subscription (firm_id,subscription_id,expired_at,created_by,is_deleted) VALUES('$firm_id','$subscription_id','$expired_at','$created_by','$created_at')");

		}

	}

	function deleteNotifications($conn, $firm_id, $updated_by, $ids)
	{
		$ids = json_decode($ids);
		$return_data=array();
		$id_arr=array();
		if(!is_array($ids))
		{
			$id_arr[]=$ids;
		}else
		{
			$id_arr=$ids;
		}
		foreach ($id_arr as $id) {
			$task_detail_qry = "SELECT id FROM notification_details WHERE id=? limit 1";
			$task_data_result = prepared_query($conn, $task_detail_qry, [$id, $firm_id]);
			$task_data = $task_data_result->get_result()->fetch_assoc();
			if($task_data){
				$remove_task = "UPDATE notification_details SET is_deleted=? WHERE id=? ";
				$is_deleted = prepared_query($conn, $remove_task, [1, $id])->affected_rows;
				$return_data[]=$id;
				
			}
		}
		$return_data=$id_arr;
		return $return_data;
	}
	function CreateAssignDefaultAccessIfNotExist($conn, $firm_id,$utype="Default User")
	{
		// $utype="Default User";
		// $default_access="1";
		$disallow_access=array('settings','import_data','manage_firm_users','manage_usertype_roles','manage_practice_area');
		$check_is_role_added=mysqli_query($conn," SELECT *  from user_type WHERE firm_id='$firm_id' AND  name='$utype' ");    
		if(mysqli_num_rows($check_is_role_added)>0)
		{
			$user_type_details=mysqli_fetch_assoc($check_is_role_added);
			$user_type_id=$user_type_details['id'];
		}else
		{
			mysqli_query($conn,"INSERT INTO user_type (name,firm_id) VALUES('$utype','$firm_id') ");
			$user_type_id=mysqli_insert_id($conn);
		}

		$stmt = mysqli_query($conn,"SELECT * FROM firm_admin_menu WHERE firm_id='$firm_id' AND  is_deleted='0' ");
		$all_admin_access = array();
		while($fet_menu=mysqli_fetch_assoc($stmt))
		{
			$all_admin_access[]=$fet_menu;
		}
		
		foreach($all_admin_access as $row)
		{
			$mid=$row['mid'];
			$mname=$row['mname'];
			$mtitle=$row['mtitle'];
			$is_access=1;
			if(in_array($mname,$disallow_access))
			{
				$is_access=0;
			}
			// $is_access=$default_access;
			$access_data_qry = $conn->prepare("SELECT * FROM user_access WHERE firm_id='$firm_id' AND mid='$mid' AND utype='$user_type_id' ");
			$access_data_qry->execute();
			$access_data_result = $access_data_qry->get_result();

			$total_rows = $access_data_result->num_rows;
			if($total_rows<=0)
			{
				prepared_query($conn, " INSERT INTO user_access (mname,mtitle,mid,is_access,firm_id,utype) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$is_access,$firm_id,$user_type_id]);
			}
			
		}
		return $user_type_id;
	}
	function CreateAssignDefaultCategoyIfnotExist($conn, $firm_id)
	{
		$categories_list=array();
		$i=0;
		$categories_list[$i]['name']='Court Appearance';$categories_list[$i]['category_type']='time_entry';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='425';$categories_list[$i]['is_disbursement']='0';
		
		$i++;
		$categories_list[$i]['name']='Initial Consultation';$categories_list[$i]['category_type']='time_entry';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='350';$categories_list[$i]['is_disbursement']='0';
		
		$i++;
		$categories_list[$i]['name']='Court Submission';$categories_list[$i]['category_type']='time_entry';$categories_list[$i]['billing_method']='flat';$categories_list[$i]['rate']='350';$categories_list[$i]['is_disbursement']='0';
		
		$i++;
		$categories_list[$i]['name']='LEGAL NOTICE';$categories_list[$i]['category_type']='time_entry';$categories_list[$i]['billing_method']='flat';$categories_list[$i]['rate']='195';$categories_list[$i]['is_disbursement']='0';
		
		$i++;
		$categories_list[$i]['name']='Medical Records';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='0';
		
		$i++;
		$categories_list[$i]['name']='Filing Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Clerk Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Expert or Consultant Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Service of Process Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Court Reporter Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Witness Subpoena Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Travel Expenses';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Parking Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Copies and Faxes';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Postage';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Courier Fees';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';

		$i++;
		$categories_list[$i]['name']='AAA Filing Fee';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='4000';$categories_list[$i]['is_disbursement']='1';

		$i++;
		$categories_list[$i]['name']='Certified mail';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='7.20';$categories_list[$i]['is_disbursement']='1';
		
		$i++;
		$categories_list[$i]['name']='Registration fee';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';

		$i++;
		$categories_list[$i]['name']='Regular Mail';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';

		$i++;
		$categories_list[$i]['name']='Publication Fee';$categories_list[$i]['category_type']='expense';$categories_list[$i]['billing_method']='custom';$categories_list[$i]['rate']='0';$categories_list[$i]['is_disbursement']='1';

		for ($ci=0; $ci < count($categories_list); $ci++) 
		{ 
			$category_name=$categories_list[$ci]['name'];
			$category_type=$categories_list[$ci]['category_type'];
			$category_billing_method=$categories_list[$ci]['billing_method'];
			$category_rate=$categories_list[$ci]['rate'];
			$category_is_disbursement=$categories_list[$ci]['is_disbursement'];
			$is_deleted=0;

			$check_is_added=mysqli_query($conn,"SELECT * from activity_categories WHERE firm_id='$firm_id' AND category_type='$category_type' AND name='$category_name' AND is_deleted='$is_deleted' ");
			if(mysqli_num_rows($check_is_added)>0){}else{
				$add_category=mysqli_query($conn,"INSERT INTO activity_categories (firm_id,name,category_type,billing_method,rate,is_disbursement,is_deleted) VALUES('$firm_id','$category_name','$category_type','$category_billing_method','$category_rate','$category_is_disbursement','$is_deleted') ");
			}
		}
	}
 ?>