<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization, apitoken");
    header("HTTP/1.1 200 OK");
    die();
    }
	use Carbon\Carbon;


	function prepared_query($mysqli, $sql, $params, $types = ""){
	    $types = $types ?: str_repeat("s", count($params));
	    $stmt = $mysqli->prepare($sql);
	    $stmt->bind_param($types, ...$params);
	    $stmt->execute();
	    return $stmt;
	}

	function getFirmFromUserId($conn, $user_id){
		$user_detail_qry = "SELECT id,firm_id FROM me_users WHERE id = ? limit 1";
		$user_data_result = prepared_select($conn, $user_detail_qry, [$user_id]);
		if($user_data_result->num_rows){
			$user_data = $user_data_result->fetch_assoc();
			return $user_data['firm_id'];	
		}else{
			return false;
		}
	}

	function prepared_select($mysqli, $sql, $params = [], $types = "") {
	    return prepared_query($mysqli, $sql, $params, $types)->get_result();
	}

	function checkToken($conn, $api_token){
		$expired_at = Carbon::now();
		$user_detail_qry = "SELECT * FROM me_apitokens WHERE apitoken = ? AND expired_at >= ? limit 1";
		$user_data_result = prepared_select($conn, $user_detail_qry, [$api_token, $expired_at]);
		if($user_data_result->num_rows){
			$user_data = $user_data_result->fetch_assoc();
			return $user_data['user_id'];	
		}else{
			return false;
		}
	}

	
	function getDateFormatFromUserId($conn, $user_id){
		$user_detail_qry = "SELECT id,date_format FROM me_users WHERE id = ? limit 1";
		$user_data_result = prepared_select($conn, $user_detail_qry, [$user_id]);
		if($user_data_result->num_rows){
			$user_data = $user_data_result->fetch_assoc();
			return $user_data['date_format'];	
		}else{
			return false;
		}
	}

	function getFirmUserName($conn, $user_id){
		$user_detail_qry = "SELECT * FROM me_users WHERE id = ? limit 1";
		$user_data_result = prepared_select($conn, $user_detail_qry, [$user_id]);
		if($user_data_result->num_rows){
			$user_data = $user_data_result->fetch_assoc();
			return $user_data['name'];	
		}else{
			return "-";
		}
	}
	

	function getTableFieldName($conn, $table_name,$condition,$get_field="name"){
		$user_detail_qry = "SELECT * FROM $table_name WHERE $condition limit ?";
		$user_data_result = prepared_select($conn, $user_detail_qry, ['1']);
		if($user_data_result->num_rows){
			$user_data = $user_data_result->fetch_assoc();
			if(isset($user_data[$get_field]))
			{
				return $user_data[$get_field];	
			}else
			{
				return "";
			}
		}else{
			return "";
		}
	}

	function getCountTableField($conn, $table_name,$condition,$get_field="name"){
		$total=0;
		$table_detail_qry = "SELECT * FROM $table_name WHERE $condition limit ?";
		$table_data_result = prepared_select($conn, $table_detail_qry, ['1']);
		if($table_data_result->num_rows){
			
			while($table_data = $table_data_result->fetch_assoc())
			{
				if(isset($table_data[$get_field]))
				{
					$total+=$table_data[$get_field];
				}
					
			}
		}
		return $total;
	}
	

	function checkRole($conn, $api_token){
		$expired_at = Carbon::now();
		$user_detail_qry = "SELECT * FROM me_apitokens WHERE apitoken = ? AND expired_at >= ? limit 1";
		$user_data_result = prepared_select($conn, $user_detail_qry, [$api_token, $expired_at]);
		if($user_data_result->num_rows){
			$user_data = $user_data_result->fetch_assoc();
			return $user_data['user_id'];	
		}else{
			return false;
		}
	}

	function apiResponse($code="", $message="", $page_no="", $total_page="", $data=[], $status_code=200, $errors=[]){
		http_response_code($status_code);
		echo json_encode(
	        array(
	        	"code" => $code,
	        	"message" => $message,
	        	"errors" => $errors,
	        	"page_no" => strval($page_no),
	        	"total_page" => strval($total_page),
	        	"data" => $data
	        )
	    );
	}

	


	function forgotPasswordMail($email, $token){
		global $conn, $mail, $project_url, $front_url;
		$user_detail_qry = "SELECT * FROM me_users WHERE email=? limit 1";
		$user_data_result = prepared_query($conn, $user_detail_qry, [$email]);
		$user_data = $user_data_result->get_result()->fetch_assoc();
		
		try {
			

			$mail->addAddress($user_data['email']);
			$mail->isHTML(true); // Set email format to HTML

			$mail->Subject = 'Reset password Email | Guardian Capital';
			
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
													<div style='font-size:20px;font-family:arial;line-height:30px; color:#fff;'><img src='".$project_url."uploads/logo.jpeg' width='200' title='Logo'></div>
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
							<tbody><tr>
							<td style='padding:0px 12px 0px 12px'><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9'>
								<tbody><tr>
								<td style='padding:0px 14px'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tbody><tr>
									<td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
										<tbody><tr>
										<td valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tbody>
											<tr>
											<td style='padding-top:5px;color:#313131; font-size:15px;'>
											<br>
											<h2>Dear ".$user_data['name'].",</h2>
											<p>We recieved request for password reset. If you did not make this request, you may simply ignore this email.</p>
											<p>To complete the password reset process, please visit</p>
											
											<p><a target='_blank' class='btn btn-primary' style='border: 1px solid #080848!important;background-color: #080848!important;    text-decoration: unset!important;color: #fff!important;letter-spacing: 0.8px!important;border-radius: 5px!important;padding: 10px 20px!important;font-size: 14px!important;font-weight: 600!important;' href='".$front_url."reset_password?t=".$token."'>Confirm Reset Password</a></p>

											<br><br>
											<p>If you have trouble with the link above, copy and paste this link into your browser:</p>
											<p><a target='_blank' href='".$front_url."reset_password?t=".$token."'>".$front_url."reset_password?t=".$token."</a></p>
											
											<br>
											<p>If you have any difficulties resetting your password, please don't hesitate to contact us.</p>
											<br>
											<br>
											<p><strong>Administration Team,</strong></p>
											<p><strong>Guardian Capital</strong></p>
											<br>
											</td>                
											</tr>
											<tr>
											<td></td>
											</tr>
										</tbody></table></td>
										</tr>
									</tbody></table></td>
									</tr>
								</tbody></table></td>
								</tr>
							</tbody></table></td>
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
			// $subject='Reset password Email | Guardian Capital';
			// $to=$user_data['email'];
			// if($mail->send())
			// {

			// }else
			// {
			// 	$headers = "From: no-reply@guardiancapitalusa.com";	
			// 	$headers .= "\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			// 	mail ($to,$subject,$body, $headers);
			// }
		} catch (Exception $e) {
			// echo $e->getMessage(); //Boring error messages from anything else!
		  }	
	}

	function registerProviderMail($user_id)
	{
		global $conn, $mail, $project_url, $front_url;
		$user_detail_qry = "SELECT * FROM me_provider WHERE id=? limit 1";
		$user_data_result = prepared_query($conn, $user_detail_qry, [$user_id]);
		$user_data = $user_data_result->get_result()->fetch_assoc();
		try 
		{
			$mail->addAddress($user_data['provider_email']);
			// $mail->addCC('testcc@gmail.com');
			$mail->isHTML(true); // Set email format to HTML

			$mail->Subject = 'Confirm Provider Account | MedElite';

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
													<div style='font-size:20px;font-family:arial;line-height:30px; color:#fff;'><img src='".$front_url."assets/img/logo.png' width='200' title='Logo'></div>
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
							<tbody><tr>
							<td style='padding:0px 12px 0px 12px'><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9'>
								<tbody><tr>
								<td style='padding:0px 14px'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tbody><tr>
									<td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
										<tbody><tr>
										<td valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tbody>
											<tr>
												<td style='padding-top:5px;color:#313131; font-size:15px;'>
													<br>
													<h2>Welcome to MedElite, ".$user_data['provider_name']."!</h2>
													<p>Please activate your account.</p>
													<p>Activate Your Account by clicking given below button.</p>
													<p><a target='_blank' class='btn btn-primary' style='border: 1px solid #080848!important;background-color: #080848!important;    text-decoration: unset!important;color: #fff!important;letter-spacing: 0.8px!important;border-radius: 5px!important;padding: 10px 20px!important;font-size: 14px!important;font-weight: 600!important;' href='".$front_url."confirm_provider_account.php?t=".$user_data['email_verifiy_token']."'>Activate Your Account</a></p>
													<br>                                                 <br>
													<p>If you have trouble with the link above, copy and paste this link into your browser:</p>
													<p><a target='_blank' href='".$front_url."confirm_provider_account.php?t=".$user_data['email_verifiy_token']."'>".$front_url."confirm_provider_account.php?t=".$user_data['email_verifiy_token']."</a></p>
													<br>
												</td>                
											</tr>
											<tr>
												<td></td>
											</tr>
										</tbody></table></td>
										</tr>
									</tbody></table></td>
									</tr>
								</tbody></table></td>
								</tr>
							</tbody></table></td>
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
			// $mail->send();
			$subject='Confirm Provider Account | MedElite';
			$to=$user_data['provider_email'];
			return $mail->send();
			// if($mail->send())
			// {

			// }else
			// {
			// 	$headers = "From: no-reply@medelite.com";	
			// 	$headers .= "\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			// 	mail ($to,$subject,$body, $headers);
			// }
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
	}


	function convertTimeToSecond(string $time): int
	{
	    $d = explode(':', $time);
	    return ($d[0] * 3600) + ($d[1] * 60) + $d[2];
	}

	function convertSecondsToHMS($seconds)
	{
		$seconds = round($seconds);
  		$output = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
	    return $output;
	}
	function convertTimeToDecimal($time) {
	    $timeArr = explode(':', $time);
	    $decTime = ($timeArr[0]) + ($timeArr[1]/60) + ($timeArr[2]/3600);
	    return round($decTime, 2);
	}
	function CalculateSumOfTime($times) {
		$minutes = 0; //declare minutes either it gives Notice: Undefined variable
		// loop throught all the times
		for ($tic=0; $tic<count($times);$tic++ ) 
		{
			$time=$times[$tic];
			// foreach ($times as $time) {
			list($hour, $minute) = explode(':', $time);
			$minutes += $hour * 60;
			$minutes += $minute;
		}
	
		$hours = floor($minutes / 60);
		$minutes -= $hours * 60;
	
		// returns the time already formatted
		return sprintf('%02d:%02d', $hours, $minutes);
	}
	
	function convertDecimalToTime($decimal) {
	    $hours = floor($decimal / 60);
	    $minutes = floor($decimal % 60);
	    $seconds = $decimal - (int)$decimal;
	    $seconds = round($seconds * 60);
	    return str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
	}

	function saveLog($conn, $firm_id=0, $user_id=0, $user_action="", $ref_id=0, $ref_id_for="", $type="", $description=""){
		$insert_log_qry = "INSERT INTO me_log_feeds (firm_id, user_id, user_action, ref_id, ref_id_for, type, description) VALUES (?,?,?,?,?,?,?)";
		
		// $insert_log_id = prepared_query($conn, $insert_log_qry, [$firm_id, $user_id, $user_action, $ref_id, $ref_id_for, $type, $description]);
		// echo '<pre>'; print_r($insert_log_id);die((__FILE__).'-->'.(__FUNCTION__).'--Line-->'.(__LINE__));

		$insert_log_id = prepared_query($conn, $insert_log_qry, [$firm_id, $user_id, $user_action, $ref_id, $ref_id_for, $type, $description])->insert_id;
		return $insert_log_id;
	}


	function SendNotification($title,$body,$receipient_token)
	{
		global $conn, $mail, $project_url, $front_url;

		$post_data="";$post_data_arr=array();
		$post_data_arr['data']=array();
		$post_data_arr['data']['notification']=array();
		$icon=$project_url."uploads/logo.jpeg";
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
		$headers[] = 'Authorization: key=AAAALo7jR7Q:APA91bHSXkHmaqrwvtrEJ20BlYCy4wzmAhubPzhZxDe9h_VpLboHEemegUHrzabHH6oxhMdT1el1vHjQcDMs5jOPbbqAGN71XyW_QlrUuY3dCpGg_2Ev-ihP3kspv1SFE5tfAiZmbG6r';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
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
			$add_remarks=mysqli_query($conn,"UPDATE me_notification_details SET title='$title',id_recepient='$id_recepient',description='$description',type='$type',type_id='$type_id',is_read='$is_read',date='$date_added' WHERE id_notification='$id_notification'" )or die(mysqli_error($conn));	
			return "1";
		}else
		{
			$add_remarks=mysqli_query($conn,"INSERT INTO me_notification_details (id_notification,title,id_recepient,description,type,type_id,is_read,date) values(NULL,'$title','$id_recepient','$description','$type',$type_id,'$is_read','$date_added')")or die(mysqli_error($conn));
			if($add_remarks)
			{
				$id_notification=mysqli_insert_id($conn);
			}
			return "1";
		}
		//return $id_notification;
	}

	function SendContactEmail($contact_details)
	{
		global  $mail, $project_url, $front_url;
		
		try 
		{
			

			$mail->addAddress("support@guardiancapitalusa.com");
			// $mail->addCC('testcc@gmail.com');
			$mail->isHTML(true); // Set email format to HTML

			$mail->Subject = 'Contact Inquiry Email | Guardian Capital';

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
													<div style='font-size:20px;font-family:arial;line-height:30px; color:#fff;'><img src='".$project_url."uploads/logo.jpeg' width='200' title='Logo'></div>
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
							<tbody><tr>
							<td style='padding:0px 12px 0px 12px'><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9'>
								<tbody><tr>
								<td style='padding:0px 14px'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tbody><tr>
									<td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
										<tbody><tr>
										<td valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tbody>
											<tr>
												<td style='padding-top:5px;color:#313131; font-size:15px;'>
													<br>
													<h2>Hello, Support Admin!</h2>
													<p>You have a Contact inquiry.</p>
													<b style='font-size:16px;'>Contact Details</b>
													<br><br>
													<table style='text-align:left;'>
														<tr>
															<th style='text-align:left;'>Contact Name:</th>
															<td>".$contact_details['contact_name']."</td>
														</tr>
														<tr>
															<th style='text-align:left;'>Contact Email:</th>
															<td>".$contact_details['contact_email']."</td>
														</tr>
                                                        
                                                        <tr>
															<th style='text-align:left;'>Comments:</th>
															<td>".$contact_details['contact_comment']."</td>
														</tr>
														
														
														
													</table>
												</td>                
											</tr>
											<tr>
												<td></td>
											</tr>
										</tbody></table></td>
										</tr>
									</tbody></table></td>
									</tr>
								</tbody></table></td>
								</tr>
							</tbody></table></td>
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
			$subject='Contact Inquiry Email | Guardian Capital';
			// $to="yogeshnphp@gmail.com";
			$to="support@guardiancapitalusa.com";
			// if($mail->send())
			// {

			// }else
			// {
			// 	$headers = "From: no-reply@guardiancapitalusa.com";	
			// 	$headers .= "\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			// 	mail ($to,$subject,$body, $headers);
			// }
		} catch (Exception $e) {
			// echo $e->getMessage(); //Boring error messages from anything else!
		}	
	}

	
	function UpdateUserRoleAccess($conn, $firm_id, $data,$token){
		$user_type=$data['user_type'];
		$role_access=$data['role_access'];
		$role_access = json_decode($role_access);

		// $stmt = $conn->prepare("SELECT * FROM admin_menu  WHERE  is_deleted='0' ");
		$stmt = mysqli_query($conn,"SELECT * FROM me_admin_menu  WHERE  is_deleted='0' ");

		// $stmt->execute();
		$all_admin_access = array();
		while($fet_menu=mysqli_fetch_assoc($stmt))
		{
			$all_admin_access[]=$fet_menu;
		}
		prepared_query($conn, "DELETE FROM me_user_access WHERE firm_id=? AND utype=? ", [$firm_id, $user_type]);
		foreach($all_admin_access as $row)
		{
			$mid=$row['mid'];
			$mname=$row['mname'];
			$mtitle=$row['mtitle'];
			$is_access=0;
			if(in_array($mid,$role_access)){$is_access=1;}
			prepared_query($conn, " INSERT INTO me_user_access (mname,mtitle,mid,is_access,firm_id,utype) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$is_access,$firm_id,$user_type]);
		}
		// $role_access = json_decode($role_access);
		// foreach ($ids as $id) {
		// 	$remove_ac = "UPDATE user_type SET is_deleted=? WHERE id=? ";
		// 	$is_deleted = prepared_query($conn, $remove_ac, [1, $id])->affected_rows;
		// }
	}

	function UpdateAllAccessIfNotExist($conn, $firm_id, $utype,$token,$default_access="0",$is_reset="0")
	{
		
		$select_user=mysqli_query($conn,"SELECT * from me_users WHERE id='$token'");
		$fet_user=mysqli_fetch_assoc($select_user);

		if($is_reset==1)
		{
			
			mysqli_query($conn,"DELETE FROM me_user_access WHERE firm_id='$firm_id' AND utype='$utype' ");
		}

		
		// if(isset($fet_user['role']) && $fet_user['role']=="admin")
		// {
			$default_access="1";
		// }else
		// {
		// 	$default_access="0";
		// }

		$stmt = mysqli_query($conn,"SELECT * FROM me_admin_menu WHERE  is_deleted='0' ");
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
			$access_data_qry = $conn->prepare("SELECT * FROM me_user_access WHERE firm_id='$firm_id' AND mid='$mid' AND utype='$utype' ");
			$access_data_qry->execute();
			$access_data_result = $access_data_qry->get_result();

			$total_rows = $access_data_result->num_rows;
			if($total_rows<=0)
			{
				prepared_query($conn, " INSERT INTO me_user_access (mname,mtitle,mid,is_access,firm_id,utype) VALUES(?,?,?,?,?,?) ", [$mname,$mtitle,$mid,$is_access,$firm_id,$utype]);
			}
			
		}
		
	}

?>