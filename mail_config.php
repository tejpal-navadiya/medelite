<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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

$mail->setFrom('dev@yuglogix.com', 'Medelite');    // From



?>