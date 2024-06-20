<?php
ob_start();
if (session_status() == PHP_SESSION_ACTIVE) {
	// echo 'Session is active';
  }else
  {
	session_start();
  }
define("ADMIN_CRM_TITLE","MedElite");



?>