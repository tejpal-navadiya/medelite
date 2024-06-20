
  <aside class="control-sidebar control-sidebar-dark">

  </aside>


  <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php echo ADMIN_CRM_TITLE; ?></a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
          
      </div>
  </footer>
  </div>



  <script src="plugins/jquery/jquery.min.js?v=<?php echo $uniq_version; ?>"></script>

  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js?v=<?php echo $uniq_version; ?>"></script>

  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js?v=<?php echo $uniq_version; ?>"></script>

  <script src="assets/js/adminlte2167.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/bootbox/bootbox.min.js?v=<?php echo $uniq_version; ?>"></script>


  <!-- <script src="plugins/jquery-mousewheel/jquery.mousewheel.js?v=<?php echo $uniq_version; ?>"></script> -->

  
  <!-- <script src="assets/js/demo.js"></script> -->

  <!-- <script src="assets/js/pages/dashboard2.js?v=<?php echo $uniq_version; ?>"></script> -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="plugins/datatables/jquery.dataTables.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js?v=<?php echo $uniq_version; ?>"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      // $('#example2').DataTable({
      //   "paging": true,
      //   "lengthChange": false,
      //   "searching": false,
      //   "ordering": true,
      //   "info": true,
      //   "autoWidth": false,
      //   "responsive": true,
      // });
    });
  </script>

  
  
  <script src="plugins/select2/js/select2.full.min.js?v=<?php echo $uniq_version; ?>"></script>
  <!-- <script src="plugins/daterangepicker/daterangepicker.js?v=<?php echo $uniq_version; ?>"></script> -->

  <script src="plugins/jquery.filer/src/jquery.fileuploader.min.js?v=<?php echo $uniq_version; ?>"></script>
  <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

  <script type="text/javascript">
		$('.multi-upload-file').fileuploader({
        addMore: true,
        limit: 5,
        maxSize: 5,
        extensions: ['jpg', 'jpeg', 'png', 'gif','pdf','doc','txt','docx'] // allowed extensions or types {Array}

      });

		$('.single-upload-file').fileuploader({
        addMore: false,
        maxSize: 1,
        extensions: ['jpg', 'jpeg', 'png','pdf','doc','docx'] // allowed extensions or types {Array}
    });

    $('.multi-upload-image').fileuploader({
        addMore: true,
        extensions: ['jpg', 'jpeg', 'png', 'gif'] // allowed extensions or types {Array}
    });

		$('.single-upload-image').fileuploader({
        addMore: false,
        extensions: ['jpg', 'jpeg', 'png', 'gif'] // allowed extensions or types {Array}
    });

    $('.datepicker').datepicker({
			 format: 'mm/dd/yyyy',
			 autoclose:!0,
			 showOtherMonths: true,
			 selectOtherMonths: true
	    });
      $('.timepicker').timepicker();
	</script>  
  <script>
    $(function () {
      // $('.datepicker').datetimepicker({
      //     format: 'L'
      // });
      $('.select2').select2({
        theme: 'bootstrap4',
        allowClear: false});

    });
  </script>
  <!-- Date Picker-->
	
  <!-- <script src="assets/js/custom_jquery_functions.js?v=<?php echo $uniq_version; ?>"></script>  -->
  <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation/additional-methods.min.js"></script>
  <?php 
    if(isset($_REQUEST['pid']))
    {
      if($_REQUEST['pid']=="home")
      {
        echo '<script src="assets/js/dashboard_providers/index.js?v='.$uniq_version.'"></script>';
        echo '<script src="assets/js/dashboard_providers/license_index.js?v='.$uniq_version.'"></script>';
      }
      

      if($_REQUEST['pid']=="add_provider")
      {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
        {
          echo '<script src="assets/js/providers/update.js?v='.$uniq_version.'"></script>';
        }else
        {
          echo '<script src="assets/js/providers/add.js?v='.$uniq_version.'"></script>';
        }
      }
      if($_REQUEST['pid']=="provider_list")
      {
        echo '<script src="assets/js/providers/index.js?v='.$uniq_version.'"></script>';
      }
      if($_REQUEST['pid']=="add_directory")
      {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
        {
          echo '<script src="assets/js/directories/update.js?v='.$uniq_version.'"></script>';
        }else
        {
          echo '<script src="assets/js/directories/add.js?v='.$uniq_version.'"></script>';
        }
      }
      if($_REQUEST['pid']=="directory_list")
      {
        echo '<script src="assets/js/directories/index.js?v='.$uniq_version.'"></script>';
      }
      if($_REQUEST['pid']=="add_ce_tracking")
      {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
        {
          echo '<script src="assets/js/cetracking/update.js?v='.$uniq_version.'"></script>';
        }else
        {
          echo '<script src="assets/js/cetracking/add.js?v='.$uniq_version.'"></script>';
        }
      }
      if($_REQUEST['pid']=="ce_tracking_list")
      {
        echo '<script src="assets/js/cetracking/index.js?v='.$uniq_version.'"></script>';
      }


      // add by me
      if($_REQUEST['pid']=="add_license_state_list")
      {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
        {
          echo '<script src="assets/js/statelicenses/update.js?v='.$uniq_version.'"></script>';
        }else
        {
          echo '<script src="assets/js/statelicenses/add.js?v='.$uniq_version.'"></script>';
        }
      }
      if($_REQUEST['pid']=="license_state_list")
      {
        echo '<script src="assets/js/statelicenses/index.js?v='.$uniq_version.'"></script>';
      } 
      // end by me
      if($_REQUEST['pid']=="add_boarding_form")
      {
        echo '<script src="assets/js/add_more_items.js?v='.$uniq_version.'"></script>';
        echo '<script src="assets/js/ajax_dropdown_onboarding.js?v='.$uniq_version.'"></script>';
      }
      if($_REQUEST['pid']=="admin_edit_boarding_app_form")
      {
        // echo '<script src="assets/js/edit_boarding_app_form/add.js?v='.$uniq_version.'"></script>';
        echo '<script src="assets/js/add_more_items.js?v='.$uniq_version.'"></script>';
        echo '<script src="assets/js/ajax_dropdown_onboarding.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="add_user_profile")
      {
        echo '<script src="assets/js/org-profile.js?v='.$uniq_version.'"></script>';
        echo '<script src="assets/js/profile_picture.js?v='.$uniq_version.'"></script>';
      }

// add by me
if($_REQUEST['pid']=="add_boarding_app_form")
{
  echo '<script src="assets/js/onboarding_app_form/update.js?v='.$uniq_version.'"></script>';
  // echo '<script src="assets/js/onboarding_app_form/add.js?v='.$uniq_version.'"></script>';
 
  // echo '<script src="assets/js/ajax_dropdown_onboarding.js?v='.$uniq_version.'"></script>';
}

if($_REQUEST['pid']=="boarding_form_list")
{
  // echo '<script src="assets/js/onboarding_app_form/index.js?v='.$uniq_version.'"></script>';
?>
<script>
  function FormLimitExhaust() {
      alert("Your Form Limit Exhausted, Kindly contact admin");
}
</script>
<?php
} 
// end by me
// if($_REQUEST['pid']=="ce_tracking_list")
// {
//   echo '<script src="assets/js/cetracking/index.js?v='.$uniq_version.'"></script>';
// }

      if($_REQUEST['pid']=="add_user_role")
      {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
        {
          echo '<script src="assets/js/user_role/update.js?v='.$uniq_version.'"></script>';
        }else
        {
          echo '<script src="assets/js/user_role/add.js?v='.$uniq_version.'"></script>';
        }
      }

      if($_REQUEST['pid']=="user_role")
      {
        
        echo '<script src="assets/js/user_role/index.js?v='.$uniq_version.'"></script>';
      }
      if($_REQUEST['pid']=="user_role_access")
      {
        
        echo '<script src="assets/js/user_role_access/index.js?v='.$uniq_version.'"></script>';
      }

      // new code
        if($_REQUEST['pid']=="user_role_access")
      {
        
        echo '<script src="assets/js/user_role_access/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="provider_type_list")
      {
        
        echo '<script src="assets/js/provider_type_list/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="provider_ethnicity")
      {
        
        echo '<script src="assets/js/provider_ethnicity/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="institution_type")
      {
        
        echo '<script src="assets/js/institution_type/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="degree")
      {
        
        echo '<script src="assets/js/degree/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="exam_type")
      {
        
        echo '<script src="assets/js/exam_type/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="speciality_subspeciality")
      {
        
        echo '<script src="assets/js/speciality_subspeciality/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="focus")
      {
        
        echo '<script src="assets/js/focus/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="cert_status")
      {
        
        echo '<script src="assets/js/cert_status/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="moc_occ_status")
      {
        
        echo '<script src="assets/js/moc_occ_status/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="practice_facility_type")
      {
        
        echo '<script src="assets/js/practice_facility_type/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="license_type")
      {
        
        echo '<script src="assets/js/license_type/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="website")
      {
        
        echo '<script src="assets/js/website/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="request_type")
      {
        
        echo '<script src="assets/js/request_type/index.js?v='.$uniq_version.'"></script>';
      }

      if($_REQUEST['pid']=="method_of_request")
      {
        
        echo '<script src="assets/js/method_of_request/index.js?v='.$uniq_version.'"></script>';
      }
      
    }
  ?>
</body>

</html>