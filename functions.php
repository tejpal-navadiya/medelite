<?php
	function get_parent_menu($mid)
	{
		global $conn;
		$sel = "select mname from dwc_menu where mid='".$mid."'";
		$qry = mysqli_query($conn,$sel);
		if(mysqli_num_rows($qry)>0)
		{
			$fet = mysqli_fetch_array($qry);
			return $fet['mname'];
		} else {
			return "Root";
		}
	}
	function get_role($uname)
	{
		global $conn;
		$sel = "select rid from dwc_role where uname='".$uname."'";
		$qry = mysqli_query($conn,$sel);
		if(mysqli_num_rows($qry)>0)
		{
			return "Yes";
		} else {
			return "No";
		}
	}
	function get_access($mtitle)
	{
		global $conn;
		$uname = $_SESSION['dwc_utype'];
		//$sel = "select rstatus from dwc_role where uname='".$uname."' and rname='".$mtitle."'";
		$sel = mysqli_query($conn,"select rstatus from dwc_role where uname='".$uname."' and rname='".$mtitle."'")or die(mysqli_error($conn));
		if(mysqli_num_rows($sel)>0)
		{
			$fet = mysqli_fetch_array($sel);
			return $fet['rstatus'];
		}else
		{
			return "";
		}
	}
	
	function get_exname_photo($uid)
	{
		global $conn;
		if($uid == "")
		{
			return "";
		} else {
			$sel = mysqli_query($conn,"select photo from dwc_login where email='$uid'");
			if(mysqli_num_rows($sel)>0)
			{
				$fet = mysqli_fetch_array($sel);
				return $fet['photo'];
			}else
			{
				return "";
			}
		}
	}
	function get_exname($uid)
	{
		global $conn;
		if($uid == "")
		{
			return "";
		} else {
			$sel = mysqli_query($conn,"select fname,lname from dwc_login where id='$uid'");
			if(mysqli_num_rows($sel)>0)
			{
				$fet = mysqli_fetch_array($sel);
				return $fet['fname']." ".$fet['lname'];
			}else
			{
				return "";
			}
		}
	}
	function get_company_name()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='cname'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_company_logo()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='clogo'");
		$row = mysqli_fetch_array($result) or die(mysqli_error($conn));
		return $row['svalue'];
	}
	function get_company_address()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='caddress'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_company_emailid()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='cemailid'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_company_fee()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='ADMIN_FEE'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_company_gst()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='GST'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_company_mobile()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='cmobile'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_company_phone()
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_settings where sname='cphone'");
		$row = mysqli_fetch_array($result);
		return $row['svalue'];
	}
	function get_user_login_name()
	{
		global $conn;
		$result = mysqli_query($conn,"select fname,lname from dwc_login where id='".$_SESSION['dwc_admin_login_id']."'");
		$num = mysqli_num_rows($result);
		if($num > 0)
		{
			$row = mysqli_fetch_array($result);
			return $row['fname']." ".$row['lname'];
		}
	}
	function fetch_assoc($select,$return_type = ''){
		global $conn;
		$result = mysqli_query($conn,$select) or die(mysqli_error($conn));
		if($return_type == 'array'){
			$return_data = array();
			while($data = mysqli_fetch_assoc($result)){
				$return_data[] = $data;
			}
		}else{
			$return_data = mysqli_fetch_assoc($result);
		}
		return $return_data;
	}
	function get_user_login_photo()
	{
		global $conn;
		$result = mysqli_query($conn,"select photo from dwc_login where id='".$_SESSION['dwc_admin_login_id']."'");
		$num = mysqli_num_rows($result);
		if($num > 0)
		{
			$row = mysqli_fetch_array($result);
			if($row['photo'] != "")
			{
				return $row['photo'];
			} else {
				return "user.png";
			}
		} else {
			return "user.png";
		}
	}
	function money($amount)
	{
		return "Rs. ".IND_money_format($amount,0, '.', ',');
	}
	function IND_money_format($money)
	{
			$len = strlen($money);
			$m = '';
			$money = strrev($money);
			for($i=0;$i<$len;$i++)
			{
				if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len)
				{
					$m .='';
				}
				$m .=$money[$i];
			}
			return strrev($m);
	}
	
	
	
	
	
	
	
	
	function convert_number_to_words_postfix($number)
 	{
       return "Indian Rupees ".convert_number_to_words($number)." Only";
 	}
	function convert_number_to_words($number) 
	{

		$hyphen      = '-';
		$postfix      = ' Rupees Only';
		$conjunction = ' and ';
		//$separator   = ', ';
		$separator   = ' ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			100000             => 'lakh',
			10000000          => 'crore'
		);
		if (!is_numeric($number)) {
			return false;
		}
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative .convert_number_to_words(abs($number));
		}
	
		$string = $fraction = null;
	
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
    	switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . convert_number_to_words($remainder);
				}
				break;
			case $number < 100000:
				$thousands   = ((int) ($number / 1000));
				$remainder = $number % 1000;
	
				$thousands = convert_number_to_words($thousands);
	
				$string .= $thousands . ' ' . $dictionary[1000];
				if ($remainder) {
					$string .= $separator . convert_number_to_words($remainder);
				}
				break;
			case $number < 10000000:
				$lakhs   = ((int) ($number / 100000));
				$remainder = $number % 100000;
	
				$lakhs = convert_number_to_words($lakhs);
	
				$string = $lakhs . ' ' . $dictionary[100000];
				if ($remainder) {
					$string .= $separator . convert_number_to_words($remainder);
				}
				break;
			case $number < 1000000000:
				$crores   = ((int) ($number / 10000000));
				$remainder = $number % 10000000;
	
				$crores = convert_number_to_words($crores);
	
				$string = $crores . ' ' . $dictionary[10000000];
				if ($remainder) {
					$string .= $separator . convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= convert_number_to_words($remainder);
				}
				break;
    	}
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		
    	return ucwords($string);
	}
		
	function GetConditionalDetailsFromTable($table_name,$condition,$is_multiple="0",$is_stat_chk="0",$select_fields="",$order_by="",$order_type="DESC",$file_field="",$page="1",$limit="0",$is_strip_tag="1")
	{
		global $conn;
		if($table_name == "")
		{
			return "";
		} 
		else 
		{
			//select fields condition check
			if($select_fields=="" || $select_fields=="all")
			{
				$select_fields="*";
			}else
			{
				if(is_array($select_fields))
				{
					$select_fields=implode(", ", $select_fields);
				}
			}
			//Check for ordering condition
			$order_statement="";
			if($order_by!="")
			{
				$order_statement=" ORDER BY ".$order_by." ".$order_type;
			}

			//Check for Limit condition
			$limit_statement="";
			if($limit!="" && $limit!="0" && $page!="" && $page!="0" && $is_multiple!="0")
			{
				$start = ($page-1) * $limit;
				$limit_statement=" LIMIT ".$start.", ".$limit;
			}
			//limit to single record
			if($is_multiple!="1")
			{
				$limit_statement=" LIMIT 1";
			}
			//add where to condition if not avail
			if($condition!="")
			{
				if (strpos($condition, 'where') === false) 
				{
				    $condition=" WHERE ".$condition;
				}
			}

			//status check condition
			if($is_stat_chk=="1")
			{
				if($condition!="")
				{
					$condition.=" AND status='0' ";
				}else
				{
					$condition=" WHERE status='0'";
				}
			}

			$sel = mysqli_query($conn,"SELECT ".$select_fields." FROM ".$table_name." ".$condition." ".$order_statement." ".$limit_statement) or die(mysqli_error($conn));
			if(mysqli_num_rows($sel)>0)
			{
				$return_data=array();
				if($is_multiple=="1")
				{	
					while ($fet = mysqli_fetch_assoc($sel)) 
					{
						if(is_array($file_field) && $file_field!="" && isset($file_field['file_field_col']) && isset($file_field['default_file']) && isset($file_field['file_path']))
						{
							if($fet[($file_field['file_field_col'])] !="" && file_exists($file_field['chk_file_path'].$fet[($file_field['file_field_col'])]))
							{
								$fet[($file_field['file_field_col'])]=$file_field['file_path'].$fet[($file_field['file_field_col'])];
							}else
							{
								$fet[($file_field['file_field_col'])]=$file_field['default_file'];	
							}
						}
						$return_data[]=$fet;
					}
					//$return_data['sql_que']="SELECT ".$select_fields." FROM ".$table_name." ".$condition." ".$order_statement." ".$limit_statement;
					for ($afc=0; $afc < count($return_data); $afc++)
					{ 
						if($is_strip_tag=="1")
						{
							foreach ($return_data[$afc] as $key => $value)
							{
								$return_data[$afc][$key]=strip_tags($value);
							}
						}
						foreach ($return_data[$afc] as $key => $value)
						{
							$return_data[$afc][$key]=trim($value);
						}
						foreach ($return_data[$afc] as $key => $value)
						{
							$return_data[$afc][$key]=str_replace("&nbsp;", " ", $value);
						}
						foreach ($return_data[$afc] as $key => $value)
						{
							$return_data[$afc][$key]=str_replace("&amp;", "&", $value);
						}
					}
				}else
				{
					$fet = mysqli_fetch_assoc($sel);
					if(is_array($file_field) && $file_field!="" && isset($file_field['file_field_col']) && isset($file_field['default_file']) && isset($file_field['file_path']))
					{
						if($fet[($file_field['file_field_col'])] !="" && file_exists($file_field['chk_file_path'].$fet[($file_field['file_field_col'])]))
						{
							$fet[($file_field['file_field_col'])]=$file_field['file_path'].$fet[($file_field['file_field_col'])];
						}else
						{
							$fet[($file_field['file_field_col'])]=$file_field['default_file'];
						}
					}
					if($is_strip_tag=="1")
					{
						foreach ($fet as $key => $value)
						{
							$fet[$key]=strip_tags($value);
							
						}
					}
					foreach ($fet as $key => $value)
					{
						$fet[$key]=trim($value);
					}
					foreach ($fet as $key => $value)
					{
						$fet[$key]=str_replace("&nbsp;", " ", $value);
					}
					foreach ($fet as $key => $value)
					{
						$fet[$key]=str_replace("&amp;", "&", $value);
					}
					$return_data=$fet;
				}
				return $return_data;
			}else
			{
				//return ""."SELECT ".$select_fields." FROM ".$table_name." ".$condition." ".$order_statement." ".$limit_statement;
				return "";
			}
			//return "SELECT ".$select_fields." FROM ".$table_name." ".$order_statement." ".$limit_statement;
						
		}
	}
	function GetTotalAvailFromTable($table_name,$is_stat_chk="1",$condition="")
	{
		global $conn;
		if($table_name == "")
		{
			return "0";
		} 
		else 
		{

			//add where to condition if not avail
			if($condition!="")
			{
				if (strpos($condition, 'where') === false) 
				{
				    $condition=" WHERE ".$condition;
				}
			}

			//status check condition
			if($is_stat_chk=="1")
			{
				if($condition!="")
				{
					$condition.=" AND status='0' ";
				}else
				{
					$condition=" WHERE status='0'";
				}
			}

			$sel = mysqli_query($conn,"SELECT * FROM ".$table_name." ".$condition) or die(mysqli_error($conn));
			if(mysqli_num_rows($sel)>0)
			{
				return mysqli_num_rows($sel);
			}else
			{
				return "0";
			}
						
		}
	}

	

	
	function GetSingleFieldDataFromTable($table_name,$field,$condition="",$is_stat_chk="0")
	{
		global $conn;
		if($table_name == "")
		{
			return "0";
		} 
		else 
		{
			if($field!="*" && strpos($field, ",")!==true)
			{
				$table_data=GetConditionalDetailsFromTable($table_name,$condition,$is_multiple="0",$is_stat_chk,$field);
				//$sel = mysqli_query($conn,"SELECT * FROM ".$table_name." ".$condition) or die(mysqli_error($conn));
				if($table_data!="" && is_array($table_data) && isset($table_data[$field]))
				{
					return $table_data[$field];
				}else
				{
					return "0";
				}
			}else
			{
				return "0";
			}
						
		}
	}
	function GenrateUploadFileName($file,$pre_tag="",$is_pretag_use="1",$index="-1",$is_encoded="0")
	{
		if($index!="-1")
		{
			$path_parts = pathinfo($_FILES[$file]["name"][$index]);
			$extension = $path_parts['extension'];
			//return $file_name=base64_encode(uniqid()."_".date('H:i:s')).".".$extension;
			
		}else
		{
			$path_parts = pathinfo($_FILES[$file]["name"]);
			$extension = $path_parts['extension'];
			//return $file_name=base64_encode(uniqid()."_".date('H:i:s')).".".$extension;
			

		}	
		if($pre_tag=="")
		{
			$pre_tag=strtoupper(substr($file, 0,3));
		}

		if($is_encoded=="1")
		{
			$file_name=base64_encode(uniqid()).".".$extension;
			
		}else
		{
			$file_name=uniqid().".".$extension;
		}
		if($is_pretag_use=="1")
		{
			$file_name=$pre_tag.$file_name;
		}
		return $file_name;
	}	
	function UploadFile($file,$folder_name,$file_name="",$index="-1")
	{
		$target_dir_profile = $folder_name;
		if($index=="-1")
		{
			if($file_name=="")
			{
				$path_parts = pathinfo($_FILES[$file]["name"]);
				$extension = $path_parts['extension'];
				$file_name=uniqid().".".$extension;	
			}
			$target_file = $target_dir_profile . basename($file_name);
			chmod($target_dir_profile,0777);
			if(move_uploaded_file($_FILES[$file]['tmp_name'], $target_file))
			{
				return $file_name;
			}else
			{
				return 0;
			}
			chmod($target_dir_profile,0555);
		}else
		{
			if($file_name=="")
			{
				$path_parts = pathinfo($_FILES[$file]["name"][$index]);
				$extension = $path_parts['extension'];
				$file_name=uniqid().".".$extension;	
			}
			$target_file = $target_dir_profile . basename($file_name);
			chmod($target_dir_profile,0777);
			if(move_uploaded_file($_FILES[$file]['tmp_name'][$index], $target_file))
			{
				return $file_name;
				// return 1;
			}else
			{
				return 0;
			}
			chmod($target_dir_profile,0555);
		}
	}
	//unlink file from directory
	function UnlinkFile($path,$file)
	{
		if($file!="")
		{
			if(file_exists($path.$file))
			{
				chmod($path,0777);
				unlink($path.$file);
				chmod($path,0555);
			}
		}
	}
	
	
	
	/*API function*/

	function SendAPIResponse($returnCode,$message,$data,$is_nodata="0")
	{
		$response['returnCode']	= $returnCode;
		$response['message'] = $message;
		if($is_nodata!="1")
		{
			$response['data'] = $data;	
		}
		
		$json_encode = json_encode($response);
		echo $json_encode;
	}
	function get_AllDetailsFromTable($table_name,$is_stat_chk="1",$file_field="",$select_fields="",$page="1",$limit="5",$order_by="",$order_type="DESC")
	{
		global $conn;
		if($table_name == "")
		{
			return "";
		} 
		else 
		{
			//select fields condition check
			if($select_fields=="" || $select_fields=="all")
			{
				$select_fields="*";
			}else
			{
				if(is_array($select_fields))
				{
					$select_fields=implode(", ", $select_fields);
				}
			}
			//Check for ordering condition
			$order_statement="";
			if($order_by!="")
			{
				$order_statement=" ORDER BY ".$order_by." ".$order_type;
			}

			//Check for Limit condition
			$limit_statement="";
			if($limit!="" && $limit!="0" && $page!="" && $page!="0")
			{
				$start = ($page-1) * $limit;
				$limit_statement=" LIMIT ".$start.", ".$limit;
			}

			//status check condition
			$condition="";
			if($is_stat_chk=="1")
			{
				if($condition!="")
				{
					$condition.=" AND status='0' ";
				}else
				{
					$condition=" WHERE status='0'";
				}
			}
			

			$sel = mysqli_query($conn,"SELECT ".$select_fields." FROM ".$table_name." ".$condition." ".$order_statement." ".$limit_statement) or die(mysqli_error($conn));
			if(mysqli_num_rows($sel)>0)
			{
				$return_data=array();
				while ($fet = mysqli_fetch_assoc($sel)) 
				{
					if(is_array($file_field) && $file_field!="" && isset($file_field['file_field_col']) && isset($file_field['default_file']) && isset($file_field['file_path']))
					{
						if($fet[($file_field['file_field_col'])] !="" && file_exists($file_field['chk_file_path'].$fet[($file_field['file_field_col'])]))
						{
							$fet[($file_field['file_field_col'])]=$file_field['file_path'].$fet[($file_field['file_field_col'])];
						}else
						{
							$fet[($file_field['file_field_col'])]=$file_field['default_file'];
						}
					}
					$return_data[]=$fet;
				}
				return $return_data;
			}else
			{
				return "";
			}
			//return "SELECT ".$select_fields." FROM ".$table_name." ".$order_statement." ".$limit_statement;
						
		}
	}

	function get_TotalAvailFromTable($table_name,$is_stat_chk="1",$condition="")
	{
		global $conn;
		if($table_name == "")
		{
			return "0";
		} 
		else 
		{

			//add where to condition if not avail
			if($condition!="")
			{
				if (strpos($condition, 'where') === false) 
				{
				    $condition=" WHERE ".$condition;
				}
			}

			//status check condition
			if($is_stat_chk=="1")
			{
				if($condition!="")
				{
					$condition.=" AND status='0' ";
				}else
				{
					$condition=" WHERE status='0'";
				}
			}

			$sel = mysqli_query($conn,"SELECT * FROM ".$table_name." ".$condition) or die(mysqli_error($conn));
			if(mysqli_num_rows($sel)>0)
			{
				return mysqli_num_rows($sel);
			}else
			{
				return "0";
			}
						
		}
	}
	function get_ConditionalDetailsFromTable($table_name,$is_stat_chk="1",$file_field="",$condition,$is_multiple="0",$select_fields="",$page="1",$limit="0",$order_by="",$order_type="DESC",$is_strip_tag="1",$group_by="")
	{
		global $conn;
		if($table_name == "")
		{
			return "";
		} 
		else 
		{
			//select fields condition check
			if($select_fields=="" || $select_fields=="all")
			{
				$select_fields="*";
			}else
			{
				if(is_array($select_fields))
				{
					$select_fields=implode(", ", $select_fields);
				}
			}
			//Check for grouping condition
			$group_statement="";
			if($group_by!="")
			{
				$group_statement=" GROUP BY ".$group_by;
			}
			//Check for ordering condition
			$order_statement="";
			if($order_by!="")
			{
				$order_statement=" ORDER BY ".$order_by." ".$order_type;
			}

			//Check for Limit condition
			$limit_statement="";
			if($limit!="" && $limit!="0" && $page!="" && $page!="0" && $is_multiple!="0")
			{
				$start = ($page-1) * $limit;
				$limit_statement=" LIMIT ".$start.", ".$limit;
			}
			//limit to single record
			if($is_multiple!="1")
			{
				$limit_statement=" LIMIT 1";
			}
			//add where to condition if not avail
			if($condition!="")
			{
				if (strpos($condition, 'where') === false) 
				{
				    $condition=" WHERE ".$condition;
				}
			}

			//status check condition
			if($is_stat_chk=="1")
			{
				if($condition!="")
				{
					$condition.=" AND status='0' ";
				}else
				{
					$condition=" WHERE status='0'";
				}
			}

			$sel = mysqli_query($conn,"SELECT ".$select_fields." FROM ".$table_name." ".$condition." ".$group_statement." ".$order_statement." ".$limit_statement) or die(mysqli_error($conn));
			if(mysqli_num_rows($sel)>0)
			{
				$return_data=array();
				if($is_multiple=="1")
				{	
					while ($fet = mysqli_fetch_assoc($sel)) 
					{
						if(is_array($file_field) && $file_field!="" && isset($file_field['file_field_col']) && isset($file_field['default_file']) && isset($file_field['file_path']))
						{
							if($fet[($file_field['file_field_col'])] !="" && file_exists($file_field['chk_file_path'].$fet[($file_field['file_field_col'])]))
							{
								$fet[($file_field['file_field_col'])]=$file_field['file_path'].$fet[($file_field['file_field_col'])];
							}else
							{
								$fet[($file_field['file_field_col'])]=$file_field['default_file'];	
							}
						}
						$return_data[]=$fet;
					}
					for ($afc=0; $afc < count($return_data); $afc++)
					{ 
						if($is_strip_tag=="1")
						{
							foreach ($return_data[$afc] as $key => $value)
							{
								$return_data[$afc][$key]=strip_tags($value);
								
								$return_data[$afc][$key]=str_replace(PHP_EOL, ' ', $return_data[$afc][$key])	;
								$return_data[$afc][$key]=str_replace("\r", '', $return_data[$afc][$key])	;
								
							}
						}
						foreach ($return_data[$afc] as $key => $value)
						{
							$return_data[$afc][$key]=trim($value);
						}
						foreach ($return_data[$afc] as $key => $value)
						{
							$return_data[$afc][$key]=str_replace("&nbsp;", " ", $value);
						}
						foreach ($return_data[$afc] as $key => $value)
						{
							$return_data[$afc][$key]=str_replace("&amp;", "&", $value);
						}
					}
				}else
				{
					$fet = mysqli_fetch_assoc($sel);
					if(is_array($file_field) && $file_field!="" && isset($file_field['file_field_col']) && isset($file_field['default_file']) && isset($file_field['file_path']))
					{
						if($fet[($file_field['file_field_col'])] !="" && file_exists($file_field['chk_file_path'].$fet[($file_field['file_field_col'])]))
						{
							$fet[($file_field['file_field_col'])]=$file_field['file_path'].$fet[($file_field['file_field_col'])];
						}else
						{
							$fet[($file_field['file_field_col'])]=$file_field['default_file'];
						}
					}
					if($is_strip_tag=="1")
					{
						foreach ($fet as $key => $value)
						{
							$fet[$key]=strip_tags($value);
							$fet[$key]=str_replace(PHP_EOL, ' ', $fet[$key])	;
							$fet[$key]=str_replace("\r", '', $fet[$key])	;
						}
					}
					foreach ($fet as $key => $value)
					{
						$fet[$key]=trim($value);
					}
					foreach ($fet as $key => $value)
					{
						$fet[$key]=str_replace("&nbsp;", " ", $value);
					}
					foreach ($fet as $key => $value)
					{
						$fet[$key]=str_replace("&amp;", "&", $value);
					}
					$return_data=$fet;
				}
				return $return_data;
			}else
			{
				return "";
			}
			//return "SELECT ".$select_fields." FROM ".$table_name." ".$order_statement." ".$limit_statement;
						
		}
	}
	function CheckUniqueDetails($table_name,$check_val,$check_field,$old_val="")
	{
		global $conn;
		if($table_name == "" || $check_val=="" || $check_field=="")
		{
			return "";
		} 
		else 
		{
			$condition='';			
			if($old_val!="")
			{
				$condition=" AND ".$check_field."!='".$old_val."'";
			}

			$sel = mysqli_query($conn,"SELECT * from ".$table_name." WHERE ".$check_field."='".$check_val."'".$condition) or die(mysqli_error($conn));
			if(mysqli_num_rows($sel)>0)
			{
				
				return "0";
			}else
			{
				return "1";
			}
			//return "SELECT ".$select_fields." FROM ".$table_name." ".$order_statement." ".$limit_statement;
						
		}
	}

	

	
	function get_customer_tokens($id)
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_customers where cid='".$id."'");
		while($row = mysqli_fetch_array($result))
		{
			$token[]=$row['reg_token_ids'];
		}
	
		return $token;
	}
	function get_executive_tokens($id)
	{
		global $conn;
		$result = mysqli_query($conn,"select * from dwc_driver where cid='".$id."'");
		while($row = mysqli_fetch_array($result))
		{
			$token[]=$row['reg_token_ids'];
		}
	
		return $token;
	}
	function SendNotification($title,$body,$receipient_token)
	{
		global $conn;
		 $project_url=ROOT;

		$post_data="";$post_data_arr=array();
		$post_data_arr['data']=array();
		$post_data_arr['data']['notification']=array();
		$icon=$project_url."/assets/img/brand/logo.png";
		$post_data_arr['data']['notification']['title']=$title;
		$post_data_arr['data']['notification']['body']=$body;
		$post_data_arr['data']['notification']['icon']=$icon;
		$post_data_arr['to']=$receipient_token;
		$post_data=json_encode($post_data_arr);
		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

		$headers = array();
		$headers[] = 'Authorization: key='.NOTIFICATION_SERVER_KEY;
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		return $result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}

	function SendIOSNotification($title,$body,$receipient_token)
	{
		global $conn;
		 $project_url=ROOT;

		$post_data="";$post_data_arr=array();
		$post_data_arr['data']=array();
		$post_data_arr['data']['notification']=array();
		$icon=$project_url."/assets/img/brand/logo.png";
		$post_data_arr['data']['notification']['title']=$title;
		$post_data_arr['data']['notification']['body']=$body;
		$post_data_arr['data']['notification']['icon']=$icon;
		$post_data_arr['data']['notification']['vibrate']=1;
		$post_data_arr['data']['notification']['sound']=1;
		// $post_data_arr['data']['icon']=$icon;
		$post_data_arr['registration_ids']=array($receipient_token);
		$post_data=json_encode($post_data_arr);
		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

		$headers = array();
		$headers[] = 'Authorization: key='.NOTIFICATION_SERVER_KEY;
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		return $result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}

	function AddNotification($title,$description,$type,$type_id,$id_recepient,$is_read="1",$id_notification="0")
	{
		global $conn, $mail, $project_url, $front_url;
		$date_added=date('Y-m-d H:i:s');
		if($id_notification!="" && $id_notification>"0")
		{
			$add_remarks=mysqli_query($conn,"UPDATE dwc_notification_details SET title='$title',id_recepient='$id_recepient',description='$description',type='$type',type_id='$type_id',is_read='$is_read',date='$date_added' WHERE id_notification='$id_notification'" )or die(mysqli_error($conn));	
			return "1";
		}else
		{
			$add_remarks=mysqli_query($conn,"INSERT INTO dwc_notification_details (id_notification,title,id_recepient,description,type,type_id,is_read,date) values(NULL,'$title','$id_recepient','$description','$type',$type_id,'$is_read','$date_added')")or die(mysqli_error($conn));
			if($add_remarks)
			{
				$id_notification=mysqli_insert_id($conn);
			}
			return "1";
		}
		//return $id_notification;
	}
	
	function GenerateOTP($n="4") 
	{ 
	    $generator = "1357902468"; 
	    $result = ""; 
	  
	    for ($i = 1; $i <= $n; $i++) 
	    { 
	        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
	    } 
	  
	    // Return result 
	    return $result; 
	}
	function GenerateAuthCode($n="4") 
	{ 
	    $uniqid=uniqid();
	    $generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	    $generator.= "abcdefghijklmnopqrstuvwxyz"; 
	    $generator.= "0123456789"; 
	    $result = ""; 
	    $max = strlen($generator);
	  
	    for ($i = 1; $i <= $n; $i++) 
	    { 
	        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
	        //$result .= $generator[random_int(0, $max-1)];
	    } 
	  
	    // Return result 
	    return $result; 
	}
	
	function SendSMS2($mobile,$message)
	{
		
	}
	function SendSMS($mobile,$message,$type="0",$title="Pack N Send Notification",$redirect_url="")
	{
		
		
	}
	function sum_time() 
	{
	    $i = 0;
	    foreach (func_get_args() as $time) {
	        sscanf($time, '%d:%d', $hour, $min);
	        $i += $hour * 60 + $min;
	    }
	    if ($h = floor($i / 60)) {
	        $i %= 60;
	    }
	    return sprintf('%02d:%02d', $h, $i);
	}
	function CalculateTimeDifference($start_time,$end_time, $is_actual_time="0",$is_return_str="0")
	{
		$time1 = strtotime($start_time);
		$time2 = strtotime($end_time);
		$diff = $time2 - $time1;
		if($is_actual_time=="0")
		{
			return date('H:i:s', $diff);
		}else
		{
			$hours = floor($diff / 3600);
			$minutes = floor(($diff / 60) % 60);
			$seconds = $diff % 60;
			if($is_return_str=="0")
			{
				return "$hours:$minutes:$seconds";
			}else
			{
				$return_str="";
				if($hours!="0")
				{
					$return_str.=" $hours Hours";
				}
				if($minutes!="0")
				{
					$return_str.=" $minutes Minutes";
				}
				if($seconds!="0")
				{
					$return_str.=" $seconds Seconds";
				}
				return	$return_str;
			}
		}
	}
	function CalculateTimeSum($start_time,$end_time)
	{
		$time1 = strtotime($start_time);
		$time2 = strtotime($end_time);
		$diff = $time2 + $time1;
		return date('H:i:s', $diff);
	}

	

	
	
	
	function CountTotalFromTable($table_name,$condition="")
	{
		global $conn;
		if($condition!="")
		{
			if(strpos($condition, "WHERE")==false && strpos($condition, "where")==false)
			{
				$condition=" WHERE ".$condition;	
			}
		}
		$total=0;
		$ss = "SELECT COUNT(*) as total from ".$table_name.$condition;
		$qq = mysqli_query($conn,$ss);
		if($qq && mysqli_num_rows($qq)>0)
		{
			$ff = mysqli_fetch_array($qq);	
			if(isset($ff['total']))
			{
				$total=$ff['total'];
			}	
		}
		
		
		return $total;		
	}
	function CountFieldTotalFromTable($table_name,$field,$condition="")
	{
		global $conn;
		if($condition!="")
		{
			if(strpos($condition, "WHERE")==false && strpos($condition, "where")==false)
			{
				$condition=" WHERE ".$condition;	
			}
		}
		$total=0;
		$ss = "SELECT $field as total from ".$table_name.$condition;
		$qq = mysqli_query($conn,$ss)or die(mysqli_error($conn));
		if($qq && mysqli_num_rows($qq)>0)
		{
			while($ff = mysqli_fetch_array($qq))
			{
				if(isset($ff['total']))
				{
					$total+=$ff['total'];
				}	
			}
		}		
		return $total;		
	}	

	
	function SetDisableCrimeOpenUpdate($id_crime)
	{
		global $conn;
		$sel_crime_details=mysqli_query($conn,"SELECT * from dwc_crime_details WHERE id='$id_crime' ");
		if(mysqli_num_rows($sel_crime_details)>0)
		{
			$fet_crime_details=mysqli_fetch_assoc($sel_crime_details);
			if($fet_crime_details['is_requested_update']=="0" && $fet_crime_details['is_open_update']!="0")
			{
				$crime_date=$fet_crime_details['crime_date'];
				$today_date=date('Y-m-d H:i:s');
				$time_diffrence=differenceInHours($crime_date,$today_date);
				if($time_diffrence>24)
				{
					mysqli_query($conn,"UPDATE dwc_crime_details SET is_open_update='0',is_requested_update='0',update_request_status='0',update_request_date='' WHERE id='$id_crime' ");
				}
			}else
			{
				if($fet_crime_details['is_requested_update']!="0" && $fet_crime_details['is_open_update']!="0" && $fet_crime_details['update_request_status']=="1")
				{
					if($fet_crime_details['update_request_date']=="")
					{
						mysqli_query($conn,"UPDATE dwc_crime_details SET is_open_update='0',is_requested_update='0',update_request_status='0',update_request_date='' WHERE id='$id_crime' ");
					}else
					{
						$update_request_date=$fet_crime_details['update_request_date'];
						$today_date=date('Y-m-d H:i:s');
						$time_diffrence=differenceInHours($update_request_date,$today_date);
						if($time_diffrence>24)
						{
							mysqli_query($conn,"UPDATE dwc_crime_details SET is_open_update='0',is_requested_update='0',update_request_status='0',update_request_date='' WHERE id='$id_crime' ");
						}
					}
				}

			}
			
		}
	}
	
	
	
	
	
	/*Wallet Functions*/
	//execute mysql query 
	/*
	function CheckIfWalletCreated($id_user,$utype="0")
	{
		global $conn;
		$res_check=mysqli_query($conn,"SELECT * FROM dwc_user_wallet where id_user='$id_user' AND utype='$utype' ")or die(mysqli_error($conn));
		if($res_check && mysqli_num_rows($res_check)>0)
		{
			return "1";
		}else
		{
			return "0";
		}	
	}

	function CreateWalletIfNotExist($id_user,$utype="0")
	{
		global $conn;
		if(CheckIfWalletCreated($id_user,$utype)!="1")
		{
			$res_check=mysqli_query($conn,"INSERT INTO dwc_user_wallet (id_user,date_updated,utype) VALUES('".$id_user."','".date('Y-m-d H:i:s')."','$utype')")or die(mysqli_error($conn));
			if($res_check)
			{
				
				return "1";
			}else
			{
				return "0";
			}
		}	
	}
	function GetWalletBalance($id_user,$utype="0")
	{
		global $conn;
		CreateWalletIfNotExist($id_user,$utype);
		$res_check=mysqli_query($conn,"SELECT * FROM  dwc_user_wallet WHERE id_user='".$id_user."' AND utype='".$utype."' ")or die(mysqli_error($conn));
		//return $res_check;
		if($res_check && mysqli_num_rows($res_check)>0)
		{
			$fetch=mysqli_fetch_array($res_check);
			return $fetch['balance'];
		}else
		{
			return "0";
		}
	}
	function AddWalletBalance($id_user,$add_amount,$utype="0")
	{
		global $conn;
		CreateWalletIfNotExist($id_user,$utype);
		$wallet_balance=GetWalletBalance($id_user,$utype);	
		$balance=$wallet_balance+$add_amount;
		$res_check=mysqli_query($conn,"UPDATE dwc_user_wallet SET balance='".$balance."',date_updated='".date('Y-m-d H:i:s')."' WHERE id_user='".$id_user."' AND utype='".$utype."' ")or die(mysqli_error($conn));
		if($res_check)
		{
			$add_summary=mysqli_query($conn,"INSERT INTO dwc_user_wallet_summary (id_user,utype,amount,Transaction_type) VALUES('$id_user','$utype','$add_amount','Credit') ");
			return "1";
		}else
		{
			return "0";
		}
			
	}
	function SubtractWalletBalance($id_user,$subtract_amount,$utype="0")
	{
		global $conn;
		CreateWalletIfNotExist($id_user,$utype);
		$wallet_balance=GetWalletBalance($id_user,$utype);	
		$balance=$wallet_balance-$subtract_amount;
		$res_check=mysqli_query($conn,"UPDATE dwc_user_wallet SET balance='".$balance."',date_updated='".date('Y-m-d H:i:s')."' WHERE id_user='".$id_user."' AND utype='".$utype."' ") or die (mysqli_error($conn));
		if($res_check)
		{
			return "1";
			$add_summary=mysqli_query($conn,"INSERT INTO dwc_user_wallet_summary (id_user,utype,amount,Transaction_type) VALUES('$id_user','$utype','$subtract_amount','Debit') ");
		}else
		{
			return "0";
		}
			
	}
	
	function UpdateWalletBalance($id_user,$balance,$utype="0")
	{
		global $conn;
		CreateWalletIfNotExist($id_user,$utype);
		$res_check=mysqli_query($conn,"UPDATE dwc_user_wallet SET balance='".$balance."',date_updated='".date('Y-m-d H:i:s')."' WHERE id_user='".$id_user."' AND utype='".$utype."' ");
		if(mysqli_num_rows($res_check)>0)
		{
			return "1";
		}else
		{
			return "0";
		}
	}*/
	function CreateInsertQuery($field_list,$table_name)
	{
		$que_fields=array();$que_field_val=array();
		$que_fields_list="";$que_field_val_list="";$query="";
		foreach ($field_list as $key => $value) 
		{
			array_push($que_fields, $key);
			array_push($que_field_val, $value);
			
		}
		if(count($que_fields)>0)
		{
			$que_fields_list=implode($que_fields, ",");
		}
		for ($fli=0; $fli < count($que_field_val); $fli++) 
		{ 
			if($fli==0)
			{
				$que_field_val_list.="'".$que_field_val[$fli]."'";
			}else
			{
				$que_field_val_list.=", '".$que_field_val[$fli]."'";
			}
		}
		
		if(count($que_fields)==count($que_field_val) && $que_fields_list!="" && $que_field_val_list!="")
		{
			$query="INSERT INTO ".$table_name." (".$que_fields_list.") VALUES(".$que_field_val_list.") ";	
		}
		return $query;
	}
	
	/*
	function CreateTransaction($transaction_arr)
	{
		global $conn;
		// $sample_transaction_arr=array("id_category" => "RIDE ID","tansaction_type" => "Credit/Debit","transaction_category" => "Ride Payment/Payment Refund/Add Money wallet","transaction_for" => "User id ","transaction_by" => "Not Required","wallet_amount" => "Wallet Amount","other_amount" => "Other AMount","transaction_amount" => "Amount","transaction_currancy" => "INR","tax_amount" => "tax amount if any","gateway_fees" => "payment gateway fees if any","transaction_fees" => " transaction fees","payement_gateway" => "payment gateway name","transaction_ref_id" => "pg returned transaction id","transaction_date" => "default today date","transaction_status" => "0/1","payment_status" => "0/1");
		$Insert_query=CreateInsertQuery($transaction_arr,"dwc_transaction");	
		// $balance=$wallet_balance+$add_amount;
		$res_check=mysqli_query($conn,$Insert_query)or die(mysqli_error($conn));
		if($res_check)
		{
			return mysqli_insert_id($conn);
		}else
		{
			return "0";
		}
			
	}*/

	/*Wallet Functions*/
function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
/*
	function CheckIsAvailCouponCode($id_user,$coupon_code,$date="")	
	{
		global $conn;
		$avail_time_slot=array();
		if($date=="")
		{
			$date=date('Y-m-d H:i:s');
		}else
		{
			$date=date('Y-m-d H:i:s',strtotime($date));
		}
		$is_avail="0";
		$condition=" coupon_code='".$coupon_code."' AND status='1' AND avail_from>='".$date."' AND avail_to<='".$date."' ";
		$coupon_code_details=GetConditionalDetailsFromTable($table_name="dwc_coupon_details",$condition,$is_multiple="0","0");
		if($coupon_code_details!="" && is_array($coupon_code_details) && isset($coupon_code_details[0]['id']))
		{
			if($coupon_code_details['coupon_type']=="1")
			{
				if($coupon_code_details['user_id']==$id_user)
				{
					$is_avail="1";			
				}
			}else
			{
				$is_avail="1";	
			}
			
		}
		return $is_avail;
	}
	function CheckIsValidCouponCode($id_user,$coupon_code,$amount,$date="")	
	{
		global $conn;
		$avail_time_slot=array();
		if($date=="")
		{
			$date=date('Y-m-d H:i:s');
		}else
		{
			$date=date('Y-m-d H:i:s',strtotime($date));
		}
		$is_avail="0";
		$condition=" coupon_code='".$coupon_code."' AND status='1' AND DATE(avail_from) <='".$date."' AND DATE(avail_to)>='".$date."' AND  min_transaction_amount<='".$amount."'";
		$coupon_code_details=GetConditionalDetailsFromTable($table_name="dwc_coupon_details",$condition,$is_multiple="0","0");
		if($coupon_code_details!="" && is_array($coupon_code_details) && isset($coupon_code_details[0]['id']))
		{
			if($coupon_code_details['coupon_type']=="1")
			{
				if($coupon_code_details['user_id']==$id_user)
				{
					$is_avail="1";			
				}
			}else
			{
				$is_avail="1";	
			}
			
		}
		return $is_avail;
	}
	function CheckIsCouponCodeAvailUser($id_user,$coupon_code,$amount,$date="")	
	{
		global $conn;
		$avail_time_slot=array();
		if($date=="")
		{
			$date=date('Y-m-d H:i:s');
		}else
		{
			$date=date('Y-m-d H:i:s',strtotime($date));
		}
		$is_avail="0";
		$condition=" coupon_code='".$coupon_code."' AND status='1' AND DATE(avail_from) <='".$date."' AND DATE(avail_to) >='".$date."' ";
		// $condition=" coupon_code='".$coupon_code."' AND status='1' AND DATE(avail_from) >='".$date."' AND DATE(avail_to) <='".$date."' AND min_transaction_amount<='".$amount."'";
		$coupon_code_details=GetConditionalDetailsFromTable($table_name="dwc_coupon_details",$condition,$is_multiple="0","0");
		// echo json_encode($coupon_code_details);
		if($coupon_code_details!="" &&  isset($coupon_code_details['id']))
		{
			$sel_check_coupon_used=mysqli_query($conn," SELECT *  from dwc_coupon_details where user_id='".$user_id."' ");
			if($coupon_code_details['coupon_use']=="0")
			{
				if(mysqli_num_rows($sel_check_coupon_used)=="0")	
				{
					$is_avail="1";
				}
			}else
			{
				if(mysqli_num_rows($sel_check_coupon_used) < $coupon_code_details['coupon_use'])	
				{
					$is_avail="1";
				}
			}
			
		}else
		{
			$is_avail="-1";
		}
		if($is_avail=="1")
		{
			if($coupon_code_details['total_coupon_use'] && $coupon_code_details['total_coupon_use']>0)	
			{
				$total_used_coupon=GetTotalAvailFromTable("dwc_coupon_apply_details",$is_stat_chk="0"," coupon_code='".$coupon_code."' ");
				if($total_used_coupon>$coupon_code_details['total_coupon_use'])
				{
					$is_avail="0";
				}
			}
		}
		return $is_avail;
	}
	
	function ApplyCoupon($id_user,$coupon_code,$transaction_amount,$date="",$id_ride="",$id_transaction="")	
	{
		global $conn;
		$avail_time_slot=array();
		if($date=="")
		{
			$date=date('Y-m-d H:i:s');
		}else
		{
			$date=date('Y-m-d H:i:s',strtotime($date));
		}
		$is_applied="0";
		$is_valid_coupon=CheckIsCouponCodeAvailUser($id_user,$coupon_code,$transaction_amount,$date);
		if($is_valid_coupon=="1")
		{
			$condition=" coupon_code='".$coupon_code."' ";
			$discount_amount="0";$id_coupon="0";
			$coupon_code_details=GetConditionalDetailsFromTable($table_name="dwc_coupon_details",$condition,$is_multiple="0","0");	
			if(isset($coupon_code_details['reward_rate']))
			{
				if($coupon_code_details['reward_rate']!="" && $coupon_code_details['reward_rate']>0)
				{
					$discount_amount=($transaction_amount*($coupon_code_details['reward_rate']/100));
				}else
				{
					$discount_amount=$coupon_code_details['reward_amount'];
				}
				$id_coupon=$coupon_code_details['id'];
			}
			$discount_amount=round($discount_amount,2);
			$apply_coupon_code=mysqli_query($conn," INSERT INTO dwc_coupon_apply_details (id_coupon,coupon_code,user_id,transaction_amount,discount_amount,id_transaction,id_ride,date_added) VALUES('".$id_coupon."','".$coupon_code."','".$id_user."','".$transaction_amount."','".$discount_amount."','".$id_transaction."','".$id_ride."','".$date."')");

			// apply to ride
			mysqli_query($conn,"UPDATE dwc_ride_offers_details set coupon_discount='".$discount_amount."',coupon_code='".$coupon_code."' WHERE id='$id_ride' ");
			if($apply_coupon_code)
			{
				$is_applied="1";
			}
		}
		return $is_applied;
	}
	
	function GetApplyCouponDetails($id_user,$coupon_code,$transaction_amount,$date="",$id_ride="",$id_transaction="")	
	{
		global $conn;
		$avail_time_slot=array();
		if($date=="")
		{
			$date=date('Y-m-d H:i:s');
		}else
		{
			$date=date('Y-m-d H:i:s',strtotime($date));
		}
		$is_applied="0";$discount_amount="0";
		$is_valid_coupon=CheckIsCouponCodeAvailUser($id_user,$coupon_code,$transaction_amount,$date);
		if($is_valid_coupon=="1")
		{
			$condition=" coupon_code='".$coupon_code."' ";
			$discount_amount="0";$id_coupon="0";
			$coupon_code_details=GetConditionalDetailsFromTable($table_name="dwc_coupon_details",$condition,$is_multiple="0","0");	
			$max_discount_amount=$coupon_code_details['max_discount_amount'];
			if(isset($coupon_code_details['reward_rate']))
			{
				if($coupon_code_details['reward_rate']!="" && $coupon_code_details['reward_rate']>0)
				{
					$discount_amount=($transaction_amount*($coupon_code_details['reward_rate']/100));
				}else
				{
					$discount_amount=$coupon_code_details['reward_amount'];
				}
				$id_coupon=$coupon_code_details['id'];
			}
			$discount_amount=round($discount_amount,2);
			if($max_discount_amount!="0" && $discount_amount>$max_discount_amount)
			{
				$discount_amount=$max_discount_amount;
			}
			
		}
		return $discount_amount;
	}*/	
		
	function get_admin_settings($field="")
	{
		global $conn;
		$return_val="";
		$result = mysqli_query($conn,"select * from dwc_settings where sname='".$field."'");
		if($field!="" && mysqli_num_rows($result)>0)
		{
			$row = mysqli_fetch_array($result);
			$return_val=$row['svalue'];
		}
		
		return $return_val;
	}

	/*
	function ProcessReferralBonus($refer_by,$referral_code,$utype="0")
	{
		global $conn;
		// referral
		if($utype=="0")
		{
			$table_name="dwc_customers";
		}else
		{
			$table_name="dwc_driver";
		}
		$refer_for_bonus=get_admin_settings("refer_for_bonus");
		$refer_by_bonus=get_admin_settings("refer_by_bonus");

		$res_check=mysqli_query($conn,"SELECT * FROM $table_name where referral='$referral_code' ")or die(mysqli_error($conn));
		if(mysqli_num_rows($res_check)>0)
		{
			$fet_user=mysqli_fetch_assoc($res_check);
			$refer_by_user=$refer_by;
			$refer_for_user=$fet_user['cid'];
			// print_r($fet_user);
			mysqli_query($conn,"INSERT INTO dwc_user_wallet (id_user,date_updated,utype) VALUES('".$refer_by_user."','".date('Y-m-d H:i:s')."','$utype')")or die(mysqli_error($conn));

			AddWalletBalance($refer_by_user,$refer_by_bonus,$utype);
			AddWalletBalance($refer_for_user,$refer_for_bonus,$utype);
			return "1";
			// if()
		}else
		{
			return "0";
		}	
	}*/
	
	
	
	
	function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    // takes two dates formatted as YYYY-MM-DD and creates an
	    // inclusive array of the dates between the from and to dates.

	    // could test validity of dates here but I'm already doing
	    // that in the main script

	    $aryRange=array();

	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}
	
	function CalcLatLngDistance($lat1, $lon1, $lat2, $lon2, $unit="") 
	{
        if($lat1==""){$lat1=0.00;}
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	      return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	  } else {
	      return $miles;
	  }
	}	
	

	function TimeDifferenceInMinutes($st_time,$en_time)
	{
		$datetime1 = strtotime($st_time);
		$datetime2 = strtotime($en_time);
		$interval  = abs($datetime2 - $datetime1);
		$minutes   = round($interval / 60);

		return $minutes;
	}
	function differenceInHours($startdate,$enddate){
		$starttimestamp = strtotime($startdate);
		$endtimestamp = strtotime($enddate);
		$difference = abs($endtimestamp - $starttimestamp)/3600;
		return $difference;
	}
	function CalcTotalNumBetweenRange($st,$en)
	{
		$cnt=0;
		for ($i=$st; $i <= $en; $i++) 
		{ 
			$cnt++;
		}
		return $cnt;
	}
	
	
	function get_formating_date($date,$format = 'd-m-Y')
	{
		// echo date($format,strtotime($date))."<br>";
		return date($format,strtotime($date));
	};


	
	

	function GetLatLngFromPlaceId($PlaceId)
	{
		global $conn;
		$return_latlng="";
		$api_data=array();
        $google_key=get_admin_settings('google_api_key');
		if($google_key=="")
		{
			$google_key="AIzaSyDAntxhTbvCD2-mumHgkY2LYEiBN78d6zk";
		}
		$api_url="https://maps.googleapis.com/maps/api/place/details/json?place_id=".$PlaceId."&key=".$google_key;
		$API_resp=CallAPI($method="POST", $api_url, $api_data);
		$geocode_source_address=json_decode($API_resp,true);
		if(isset($geocode_source_address['result']['geometry']['location']))
		{
			
			$address_comp=$geocode_source_address['result']['geometry']['location'];
			
			if(isset($address_comp['lat']) && isset($address_comp['lng']))
			{
				$return_latlng=json_encode($address_comp);
				// $return_latlng=$address_comp['lat'].",".$address_comp['lng'];	
					
			}
			
		}
		return $return_latlng;
	}

	function GetPlaceIdFromLatLng($LatLng,$google_key="")
	{
		global $conn;
		$return_latlng="";
		$api_data=array();
        
		$api_url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$LatLng."&key=".$google_key;
		$API_resp=CallAPI($method="POST", $api_url, $api_data);
		$geocode_source_address=json_decode($API_resp,true);
		// if(isset($geocode_source_address['result']['geometry']['location']))
		// {
			
		// 	$address_comp=$geocode_source_address['result']['geometry']['location'];
			
		// 	if(isset($address_comp['lat']) && isset($address_comp['lng']))
		// 	{
		// 		$return_latlng=json_encode($address_comp);
		// 		// $return_latlng=$address_comp['lat'].",".$address_comp['lng'];	
					
		// 	}
			
		// }
		return $API_resp;
	}

	function SendCrimeAlertNotification($crime_id,$logged_in_user)
	{
		global $conn;$alerted_users=array();
		$crime_details= GetConditionalDetailsFromTable("dwc_crime_details"," id='$crime_id' ","0","0");
		if($crime_details!="")
		{
			$crime_full_address=$crime_details['crime_full_address'];
			$crime_short_address=$crime_details['short_address'];
			$crime_type=$crime_details['crime_type'];
			$crime_type_name=GetSingleFieldDataFromTable("dwc_crime_type","name"," id='".$crime_type."' ","0");

			$crime_short_address=str_replace("(","",$crime_short_address);
			$crime_short_address=str_replace(")","",$crime_short_address);

			$crime_location_arr=array();
			$crime_location_arr=explode(",",$crime_short_address);
			$crime_lattitude=$crime_location_arr[0];
			$crime_longitude=$crime_location_arr[1];

			$notification_title=$crime_type_name." Crime Reported.";
			$notification_body=$crime_type_name." Reported at ".$crime_full_address;
			
			$alert_range_details=GetConditionalDetailsFromTable("dwc_user_alert"," status='1' ","1","0");
			if($alert_range_details!="")
			{
				// $alert_user_id=
				for ($ardc=0; $ardc < count($alert_range_details); $ardc++) 
				{ 
					$alert_user_id=$alert_range_details[$ardc]['user_id'];
					$alert_range=$alert_range_details[$ardc]['min_range'];
					$alert_location=$alert_range_details[$ardc]['lat_lng'];
					$alert_location=str_replace("(","",$alert_location);
					$alert_location=str_replace(")","",$alert_location);
					if($alert_user_id!=$logged_in_user)
					{
						$alert_user_device_token=GetSingleFieldDataFromTable("dwc_users","reg_token_ids"," cid='".$alert_user_id."' ","0");

						$alert_location_arr=array();
						$alert_location_arr=explode(",",$alert_location);
						if(!isset($alert_location_arr[1])){$alert_location_arr[1]="";}
						$alert_lattitude=$alert_location_arr[0];
						$alert_longitude=$alert_location_arr[1];
						
						

						$alert_lattitude=(float) $alert_lattitude;
						$alert_longitude=(float) $alert_longitude;

						$total_distance=CalcLatLngDistance($alert_lattitude, $alert_longitude, $crime_lattitude, $crime_longitude, "");
						$notification_resp="";$notification_resp_ios="";
						if($total_distance<=$alert_range)
						{
							
							$notification_resp=SendNotification($notification_title,$notification_body,$alert_user_device_token);
							$notification_resp_ios=SendIOSNotification($notification_title,$notification_body,$alert_user_device_token);
							AddNotification($notification_title,$notification_body,"crime_alert",$crime_id,$alert_user_id,"0","0");

							$current_user=array();
							$current_user['user_id']=$alert_user_id;
							$current_user['device_token']=$alert_user_device_token;
							$current_user['alert_location']=$alert_location;
							$current_user['notification_response']=$notification_resp;
							$current_user['notification_response_ios']=$notification_resp_ios;
							$alerted_users[]=$current_user;
						}
					}

				}
			}
			
			
		}
		return $alerted_users;
	}
	function GetUploadedSingleFileLayout($file_name,$id_file="")
	{
		$html_layout="";
		// if(file_exists($file_name))
		// {
            $file_name_arr=explode("/",$file_name);
            $display_file_name=end($file_name_arr);
			
			$ext = pathinfo($display_file_name, PATHINFO_EXTENSION);
			// $img_preview="<img src='".$file_name."' height='36' width='36'/>";
			// if($ext=="pdf" || $ext=="doc" || $ext=="docx" || $ext=="ppt" || $ext=="pptx")
			// {

				$img_preview='<div class="fileuploader-item-image fileupload-no-thumbnail"><div style="background-color: #f23c0f" class="fileuploader-item-icon"><i>'.$ext.'</i></div></div>';

			// }

			$html_layout='
			<div class="fileuploader fileuploader-theme-default" style="margin-top:-10px!important;padding-top: 0;">
				<div class="fileuploader-items">
					<ul class="fileuploader-items-list">
						<li class="fileuploader-item file-type-image file-ext-jpg proli_'.$id_file.'">
							<div class="columns">
								<div class="column-thumbnail" style="top:-8px;">
									<div class="fileuploader-item-image"> '.$img_preview.' </div>
								</div>

								<div class="column-title">
									<div title="'.$display_file_name.'" class="ptm pbm">'.$display_file_name.'</div>
								</div>

								<div class="column-actions"><!--<a class="fileuploader-action fileuploader-action-remove" title="Remove" onclick="RemoveFilerFiles();"><i></i></a>--></div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			';
		// }
		return $html_layout;
	}

	function SendMail($email, $subject, $mail_content)
	{
		global $conn, $mail, $project_url, $front_url;
		$return_code="0";$return_msg="";
		
		try {
			

			$mail->addAddress($email);
			$mail->isHTML(true); // Set email format to HTML

			$mail->Subject = $subject.' | Primus Care Group';
			
			$body = "<div>
						<table width='620' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#eff2f3' style='border-top:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000'>
							<tbody><tr>
							<td style='padding:13px 12px 0px 12px'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border-top:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;background:#FFFFFF;border-bottom: 1px solid #D5D8D9;'>
								<tbody><tr>
								<td style='padding:7px'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tbody><tr>
									<td style='color:#000;padding-bottom:5px'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
										<tbody><tr>
										<td style='line-height:33px'>&nbsp;</td>
											<td>
												<div style='width:100%'>
													<br>
													<div style='font-size:20px;font-family:arial;line-height:30px; color:#fff;'><img src='".$project_url."/assets/img/logo.png' width='200' title='Logo'></div>
												</div>
											</td>
											</tr>
										</tbody></table></td>
										</tr>
									</tbody></table></td>
									</tr>
								</tbody></table></td>
								</tr>
							</tbody></table>
							<table width='620' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#eff2f3' style='border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000'>
							<tbody>
								<tr>
									<td style='padding:0px 12px 0px 12px'><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9'>
										<tbody>
										<tr>
											<td style='padding:0px 14px'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
											".$mail_content."
											</td>
										</tr>
										</tbody>
									</table>
									</td>
								</tr>
							</tbody></table>
						<table width='620' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#eff2f3' style='border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;border-bottom:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000'>
							<tbody>
							<tr>
								<td style='padding:0px 12px 0px 12px'><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF'>
									<tbody><tr>
									<td style='padding:0px 14px 0px;border-bottom:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9'>&nbsp;</td>
									</tr>
									<tr>
									<td bgcolor='#eff2f3' style='font-size:11px;color:#727272;'>
										&nbsp;
									</tr>
								</tbody></table></td>
								</tr>
							</tbody>
						</table>
						<div class='yj6qo'></div>
						<div class='adL'>
						</div>
					</div>";
			$mail->Body = $body;
			$mail->send();
			// $subject='Reset password Email | Appointment Note';
			// $to=$user_data['email'];
			if($mail->send())
			{
				$return_code=1;
				$return_msg="Mail Sent.";
			}else
			{
				$return_code=0;
				$return_msg="Unable to send mail.";
				// $headers = "From: no-reply@appointmentnotes.com";	
				// $headers .= "\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
				// mail ($to,$subject,$body, $headers);
			}
		} catch (Exception $e) 
		{
			$return_code=0;
			$return_msg=$e->getMessage();
			// echo $e->getMessage(); //Boring error messages from anything else!
		}
		$return_data=array();
		$return_data['code']=$return_code;
		$return_data['msg']=$return_msg;
		return json_encode($return_data);
	}
	function GetUploadedSingleFileVericalLayout($file_path="uploads/",$file_name,$id_file="",$file_title="",$created_date="",$expiry_date="")
	{
		$html_layout="";
		if(file_exists($file_path.$file_name))
		{
			$date_container="";
			if($created_date!="" && $created_date!="01-01-1970")
			{
				$date_container.="<div style='font-size:13px;'><b>Upload Date : </b>$created_date</div>";		
			}
			if($expiry_date!="" && $expiry_date!="01-01-1970")
			{
				$date_container.="<div style='font-size:13px;'><b>Expiry Date : </b>$expiry_date</div>";		
			}
		
			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$img_preview="<img src='".$file_path.$file_name."' height='100' width='100'/>";
			if($ext=="pdf" || $ext=="doc" || $ext=="docx" || $ext=="ppt" || $ext=="pptx")
			{

				$img_preview='<div class=" fileupload-no-thumbnail"><div  class="fileuploader-item-icon"><b>'.strtoupper($ext).'</b></div></div>';

			}
			if($file_name=="")
			{
				$html_layout='';
			}else
			{
				$html_layout='
				
				<div class="col-md-2 col-sm-4 custom-display-items">
					<a class="custom-items-list " href="'.$file_path.$file_name.'" download>
						<div class="custom-column-heading">
							<div>'.$file_title.'</div>
						</div>
						<div class="custom-column-thumbnail">
							<div class="fileuploader-item-image"> '.$img_preview.' </div>
						</div>

						<div class="custom-column-title">
							<div title="'.$file_name.'" class="ptm pbm">'.$file_name.'</div>
							'.$date_container.'
						</div>
					</a>
				</div>
				';
			}
		}
		return $html_layout;
	}	

	
?>