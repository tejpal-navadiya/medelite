<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// session_start();
// error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "od_medelite";

$project_url = "http://localhost/khushboo/medelite_new/API/";
$front_url = "http://localhost/khushboo/medelite_new/";
$main_url = "http://localhost/khushboo/medelite_new/";

$default_country = 1;
$default_date_format = "Y-m-d";
$default_time_format = "H:i:s";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn -> set_charset("utf8");

global $mail;
$mail = new PHPMailer(true);

//Server settings

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output

$mail->isSMTP();                                            // Send using SMTP

$mail->Host       = 'mail.yuglogix.com';                       // Set the SMTP server to send through

$mail->SMTPAuth   = true;                                   // Enable SMTP authentication

$mail->Username   = 'dev@yuglogix.com';                            // SMTP username

$mail->Password   = 'NelX*SQwPUW%';                         // SMTP password

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

$mail->setFrom('dev@yuglogix.com', 'MedElite');    // From

function test_input($data) {
    global $conn;
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
    $data = $conn->real_escape_string($data);
	return $data;

}
$MAX_ADD_FORM_LIMIT=5;
?>
