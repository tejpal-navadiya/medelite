<?php
// print_r($_SESSION);
if(!isset($_SESSION['me_user_name']))
{
	header("location:login.php");
} else {

		if(!isset($_REQUEST['pid'])){ $pid = "home"; } else { $pid = $_REQUEST['pid']; }
	
		if($pid == "home"){ include("dashboard.php"); }
		
	
		if($pid == "navigation"){ include("navigation.php"); }
		if($pid == "user_role"){ include("user_role.php"); }
		
		
		if($pid == "add_provider"){ include("add_provider.php"); }
		if($pid == "provider_list"){ include("provider_list.php"); }			
		if($pid == "provider_details"){ include("provider_details.php"); }

		if($pid == "add_directory"){ include("add_directory.php"); }
		if($pid == "directory_list"){ include("directory_list.php"); }			
		if($pid == "directory_details"){ include("directory_details.php"); }
		
		if($pid == "add_boarding_form"){ include("add_boarding_form.php"); }
		if($pid == "boarding_form_list"){ include("boarding_form_list.php"); }			
		if($pid == "boarding_form_details"){ include("boarding_form_details.php"); }

		if($pid == "add_ce_tracking"){ include("add_ce_tracking_form.php"); }
		if($pid == "ce_tracking_list"){ include("ce_tracking_list.php"); }			
		if($pid == "ce_tracking_details"){ include("ce_tracking_details.php"); }


		if($pid == "add_license_state_list"){ include("add_license_state_list.php"); }
		if($pid == "license_state_list"){ include("license_state_list.php"); }			
		if($pid == "license_state_list_details"){ include("license_state_list_details.php"); }

		if($pid == "add_user_profile"){ include("user-profile.php"); }

		if($pid == "add_user_role"){ include("add_user_role.php"); }
		if($pid == "user_role"){ include("user_role_list.php"); }
		if($pid == "user_role_access"){ include("user-role-access.php"); }		

		if($pid == "add_boarding_app_form"){ include("add_boarding_app_form.php"); }
		if($pid == "admin_edit_boarding_app_form"){ include("admin_edit_boarding_app_form.php"); }			
		if($pid == "add_verification_request"){ include("add_verification_request.php"); }


		//
		if($pid == "provider_type_list"){ include("provider_type.php"); }
		if($pid == "add_provider_type_list"){ include("add_provider_type_list.php"); }

		if($pid == "provider_ethnicity"){ include("provider_ethnicity.php"); }
		if($pid == "add_provider_ethnicity"){ include("add_provider_ethnicity.php"); }

		if($pid == "institution_type"){ include("institution_type.php"); }
		if($pid == "add_institution_type"){ include("add_institution_type.php"); }

		if($pid == "degree"){ include("degree.php"); }
		if($pid == "add_degree"){ include("add_degree.php"); }

		if($pid == "exam_type"){ include("exam_type.php"); }
		if($pid == "add_exam_type"){ include("add_exam_type.php"); }

		if($pid == "speciality_subspeciality"){ include("speciality_subspeciality.php"); }
		if($pid == "add_speciality_subspeciality"){ include("add_speciality_subspeciality.php"); }

		if($pid == "focus"){ include("focus.php"); }
		if($pid == "add_focus"){ include("add_focus.php"); }
		
		if($pid == "cert_status"){ include("cert_status.php"); }
		if($pid == "add_cert_status"){ include("add_cert_status.php"); }

		if($pid == "moc_occ_status"){ include("moc_occ_status.php"); }
		if($pid == "add_moc_occ_status"){ include("add_moc_occ_status.php"); }

		if($pid == "practice_facility_type"){ include("practice_facility_type.php"); }
		if($pid == "add_practice_facility_type"){ include("add_practice_facility_type.php"); }

		if($pid == "license_type"){ include("license_type.php"); }
		if($pid == "add_license_type"){ include("add_license_type.php"); }

		if($pid == "website"){ include("website.php"); }
		if($pid == "add_website"){ include("add_website.php"); }

		if($pid == "request_type"){ include("request_type.php"); }
		if($pid == "add_request_type"){ include("add_request_type.php"); }

		if($pid == "method_of_request"){ include("method_of_request.php"); }
		if($pid == "add_method_of_request"){ include("add_method_of_request.php"); }



}
?>