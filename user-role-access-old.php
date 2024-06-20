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
              <form id="addFileTypeForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="process/action_role_access.php" style="padding:15px;">
              <?php
                if(isset($_REQUEST['id']))
                {
                  $sel_file_details=mysqli_query($conn,"SELECT * from me_user_type WHERE id='".$_REQUEST['id']."' ");
                  $fetch=mysqli_fetch_assoc($sel_file_details);
                                    
                    echo '<input type="hidden" name="utype" value="'.$_REQUEST['id'].'">';
                } ?>
                <table>
                <thead>
                  <tr>
                    <th>Permission</th>
                    <th class="text-center">Create</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Update</th>
                    <th class="text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sel_pmenu = "SELECT * from me_admin_menu where pmenu='0' AND is_deleted='0' ";
                    $que_pmenu = mysqli_query($conn,$sel_pmenu);
                    while($fet_pmenu = mysqli_fetch_array($que_pmenu))
                    {
                        $mname=$fet_pmenu['mname'];
                        // $is_access=check_is_access($mname,$_REQUEST['id']);
                        ?>
                          <tr>
                            <td><input type="checkbox"   name="<?php echo $fet_pmenu['mname'];?>" id="chk_<?php echo $fet_pmenu['mname'];?>" value="1"> <label for="chk_<?php echo $fet_pmenu['mname'];?>"><?php echo $fet_pmenu['mtitle'];?></label></td>
                            <?php
                              $sel_smenu = "SELECT * from me_admin_menu where pmenu='".$fet_pmenu['mid']."' AND is_deleted='0' LIMIT 4";
                              $que_smenu = mysqli_query($conn,$sel_smenu);
                              if(mysqli_num_rows($que_smenu)>0)
                              {
                                // while($fet_smenu = mysqli_fetch_array($que_smenu))
                                // {
                                  $mname="add_".$fet_pmenu['mname'];
                                  // $is_access_add=check_is_access($mname,$_REQUEST['id']);

                                  $mname="update_".$fet_pmenu['mname'];
                                  // $is_access_update=check_is_access($mname,$_REQUEST['id']);

                                  $mname="view_".$fet_pmenu['mname'];
                                  // $is_access_view=check_is_access($mname,$_REQUEST['id']);

                                  $mname="delete_".$fet_pmenu['mname'];
                                  // $is_access_delete=check_is_access($mname,$_REQUEST['id']);
                                ?>
                                  <td class="text-center"><input  type="checkbox" name="add_<?php echo $fet_pmenu['mname'];?>" id="chk_add_<?php echo $fet_pmenu['mname'];?>" value="1"></td>
                                  <td class="text-center"><input  type="checkbox" name="update_<?php echo $fet_pmenu['mname'];?>" id="chk_update_<?php echo $fet_pmenu['mname'];?>" value="1"></td>
                                  <td class="text-center"><input  type="checkbox" name="view_<?php echo $fet_pmenu['mname'];?>" id="chk_view_<?php echo $fet_pmenu['mname'];?>" value="1"></td>
                                  <td class="text-center"><input  type="checkbox" name="delete_<?php echo $fet_pmenu['mname'];?>" id="chk_delete_<?php echo $fet_pmenu['mname'];?>" value="1"></td>
                                <?php
                                // }
                              }else
                              {
                                ?>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                <?php
                              }
                              
                            ?>
                            
                          </tr>
                        <?php
                    }
                  ?>
                  
                </tbody>
              </table>
               
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

  <!-- <?php include "footer.php"; ?> -->
  <!-- <script src="assets/js/admin_org/admin_org_add.js?v=<?php echo $php_version;?>"></script> -->