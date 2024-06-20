<?php

if(!isset($_SESSION['me_user_id']))
{
	header("location:login.php");
} else 
{

		if(!isset($_REQUEST['pid'])){ $pid = "home"; } else { $pid = $_REQUEST['pid']; }
	
		if($pid == "home"){ $page_title="Dashboard";$active_sidebar_tab="";$active_menu="dashboard"; }
		
		


		if($pid == "provider_list"){ $page_title="Providers List";$active_sidebar_tab="provider";$active_menu="provider_list"; }			
		if($pid == "add_provider"){ $page_title="Add Provider";$active_sidebar_tab="provider";$active_menu="add_provider"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Provider";} }		
		if($pid == "provider_details"){ $page_title="Provider Details";$active_sidebar_tab="provider";$active_menu="manage_provider"; }

		if($pid == "directory_list"){ $page_title="Directories List";$active_sidebar_tab="directory";$active_menu="directory_list"; }			
		if($pid == "add_directory"){ $page_title="Add Directory";$active_sidebar_tab="directory";$active_menu="directory"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Directory";} }		
		if($pid == "directory_details"){ $page_title="Directory Details";$active_sidebar_tab="directory";$active_menu="manage_directory"; }


		if($pid == "boarding_form_list"){ $page_title="On Boarding Form List";$active_sidebar_tab="boarding_form";$active_menu="boarding_form"; }			
		if($pid == "add_boarding_form"){ $page_title="Add On Boarding Form";$active_sidebar_tab="boarding_form";$active_menu="add_boarding_form"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update On Boarding Form";} }		
		if($pid == "boarding_form_details"){ $page_title="On Boarding Form Details";$active_sidebar_tab="boarding_form";$active_menu="manage_boarding_form"; }

		if($pid == "navigation"){ $page_title="Manage Access Menu";$active_sidebar_tab="navigation";$active_menu="navigation"; }
		if($pid == "user_role"){ $page_title="Manage User Roles";$active_sidebar_tab="user_role";$active_menu="user_role"; }

		//new code

		if($pid == "method_of_request"){ $page_title="Method of request List";$active_sidebar_tab="method_of_request";$active_menu="method_of_request"; }			
		if($pid == "add_method_of_request"){ $page_title="Add Method of request List";$active_sidebar_tab="method_of_request";$active_menu="add_method_of_request"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Method of request List";} }
		
		if($pid == "request_type"){ $page_title="Request Type";$active_sidebar_tab="request_type";$active_menu="request_type"; }
		if($pid == "add_request_type"){ $page_title="Add Request Type";$active_sidebar_tab="request_type";$active_menu="add_request_type"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Request Type";} }

		if($pid == "website"){ $page_title="Website";$active_sidebar_tab="website";$active_menu="website"; }
		if($pid == "add_website"){ $page_title="Add Website";$active_sidebar_tab="website";$active_menu="add_website"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Website";} }

		if($pid == "license_type"){ $page_title="License Type";$active_sidebar_tab="license_type";$active_menu="license_type"; }
		if($pid == "add_license_type"){ $page_title="Add License Type";$active_sidebar_tab="license_type";$active_menu="add_license_type"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update License Type";} }

		if($pid == "practice_facility_type"){ $page_title="Practice Facility Type";$active_sidebar_tab="practice_facility_type";$active_menu="practice_facility_type"; }
		if($pid == "add_practice_facility_type"){ $page_title="Add Practice Facility Type";$active_sidebar_tab="practice_facility_type";$active_menu="add_practice_facility_type"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Practice Facility Type";} }

		if($pid == "moc_occ_status"){ $page_title="MOC/OCC Status";$active_sidebar_tab="moc_occ_status";$active_menu="moc_occ_status"; }
		if($pid == "add_moc_occ_status"){ $page_title="Add MOC/OCC Status";$active_sidebar_tab="moc_occ_status";$active_menu="add_moc_occ_status"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update MOC/OCC Status";} }

		if($pid == "cert_status"){ $page_title="Cert Status";$active_sidebar_tab="cert_status";$active_menu="cert_status"; }
		if($pid == "add_cert_status"){ $page_title="Add Cert Status";$active_sidebar_tab="cert_status";$active_menu="add_cert_status"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Cert Status";} }

		if($pid == "focus"){ $page_title="Focus";$active_sidebar_tab="focus";$active_menu="focus"; }
		if($pid == "add_focus"){ $page_title="Add Focus";$active_sidebar_tab="focus";$active_menu="add_focus"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Focus";} }

		if($pid == "speciality_subspeciality"){ $page_title="Speciality Subspeciality";$active_sidebar_tab="speciality_subspeciality";$active_menu="speciality_subspeciality"; }
		if($pid == "add_speciality_subspeciality"){ $page_title="Add Speciality Subspeciality";$active_sidebar_tab="speciality_subspeciality";$active_menu="add_speciality_subspeciality"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Speciality Subspeciality";} }

		if($pid == "exam_type"){ $page_title="Exam Type";$active_sidebar_tab="exam_type";$active_menu="exam_type"; }
		if($pid == "add_exam_type"){ $page_title="Add Exam Type";$active_sidebar_tab="exam_type";$active_menu="add_exam_type"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Exam Type";} }

		if($pid == "degree"){ $page_title="Degree";$active_sidebar_tab="degree";$active_menu="degree"; }
		if($pid == "add_degree"){ $page_title="Add Degree";$active_sidebar_tab="degree";$active_menu="add_degree"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Degree";} }

		if($pid == "institution_type"){ $page_title="Institution Type";$active_sidebar_tab="institution_type";$active_menu="institution_type"; }
		if($pid == "add_institution_type"){ $page_title="Add Institution Type";$active_sidebar_tab="institution_type";$active_menu="add_institution_type"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Institution Type";} }

		if($pid == "provider_ethnicity"){ $page_title="Provider Ethnicity";$active_sidebar_tab="provider_ethnicity";$active_menu="provider_ethnicity"; }
		if($pid == "add_provider_ethnicity"){ $page_title="Add Provider Ethnicity";$active_sidebar_tab="provider_ethnicity";$active_menu="add_provider_ethnicity"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Provider Ethnicity";} }

		if($pid == "provider_type_list"){ $page_title="Provider Type List";$active_sidebar_tab="provider_type_list";$active_menu="provider_type_list"; }
		if($pid == "add_provider_type_list"){ $page_title="Add Provider Type List";$active_sidebar_tab="provider_type_list";$active_menu="add_provider_type_list"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Provider Type List";} }

		if($pid == "license_state_list"){ $page_title="License State List";$active_sidebar_tab="license_state_list";$active_menu="license_state_list"; }
		if($pid == "add_license_state_list"){ $page_title="Add License State List";$active_sidebar_tab="license_state_list";$active_menu="add_license_state_list"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update License State List";} }

		if($pid == "add_verification_request"){ $page_title="Add Verification Requests";$active_sidebar_tab="verification_requests";$active_menu="verification_requests"; }
		
		if($pid == "ce_tracking_list"){ $page_title="Tracking List";$active_sidebar_tab="ce_tracking";$active_menu="ce_tracking"; }
		if($pid == "add_ce_tracking"){ $page_title="Add Tracking List";$active_sidebar_tab="ce_tracking";$active_menu="add_ce_tracking"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update Tracking List";} }

		if($pid == "user_role"){ $page_title="User Role";$active_sidebar_tab="userrole";$active_menu="userrole"; }
		if($pid == "add_user_role"){ $page_title="Add User Role";$active_sidebar_tab="userrole";$active_menu="add_user_role"; if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){$page_title="Update User Role";}  }
		if($pid == "user_role_access"){ $page_title="Add User Access";$active_sidebar_tab="userrole";$active_menu="user_role_access";  }
}
?>