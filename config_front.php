<?php
ob_start();
if (session_status() == PHP_SESSION_ACTIVE) 
{
	// echo 'Session is active';
}
else
{
	session_start();
}
$api_url = "http://localhost/khushboo/medelite_new/API/";
    

define("ADMIN_CRM_TITLE","MedElite");
define("ADMIN_DIR","admin");
define("ENCODE_KEY", "@#$");


date_default_timezone_set("Asia/Kolkata");


// session_start();
// print_r($conn);

?>