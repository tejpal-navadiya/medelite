<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  $title="Update User Role Access";$active_menu="add_role";
  require_once("config.php");

  // include "header.php";  include "sidebar.php"; 
?>

  <main id="main" class="main">

    <div class="pagetitle align-items-center justify-content-between">
      <h1>User Role</h1>
      <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">User Role</li>
          <li class="breadcrumb-item active">Update User Role Access</li>
        </ol>
      </nav> -->
    </div><!-- End Page Title -->
    <style>
      .select2-container--bootstrap4 .select2-selection
      {
        height: 50px!important;
        border-radius: 20px!important;
        padding: 4px 10px;
      }
      </style>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body card-body1">
              <div class="add_title_box">Add User Role</div>

              <!-- Custom Styled Validation -->
              <form id="addFileTypeForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php" style="padding:15px;">
              <?php
                if(isset($_REQUEST['id']))
                {
                  $sel_file_details=mysqli_query($conn,"SELECT * from me_user_type WHERE id='".$_REQUEST['id']."' ");
                  $fetch=mysqli_fetch_assoc($sel_file_details);
                                    
                    echo '<input type="hidden" name="user_type" id="utype" value="'.$_REQUEST['id'].'">';
                } ?>
                  <input type="hidden" name="action" value="update_role_access"/>
                  <input type="hidden" name="redirect_url_error" value="../index.php?pid=user_role_access&id=<?php echo $_REQUEST['id'];?>"/>
                  <input type="hidden" name="redirect_url_success" value="../index.php?pid=user_role_access&id=<?php echo $_REQUEST['id'];?>"/>
                
                  <div class="row" id="checkbox-wrapp">
			                  	
								  
								
                  </div>
                  <div class="col-sm-12 text-center">
                      <a href="index.php?pid=user_role" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-secondary">Cancel</a>
                      <button type="submit" id="submit_user_role" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button>
                  </div>
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>
        </div>
      </div>
    </section>


  </main><!-- End #main -->

