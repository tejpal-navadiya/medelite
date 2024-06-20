<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include('config.php');

?>
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Provider Type</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                            </div>        

                        </div>
                    </div>

                    <div class="card-body">
                    <form class="form-horizontal" id="provider_type_form"  action ='process/action_provider_type_list.php' method="post" >

                        <!-- <form  class="row g-3 validate-form" data-err_msg_ele="help"  id="user_role_form"  method="post" action="process/action_user_role.php" > -->
                        <?php
                                    if(isset($_REQUEST['id']))
                                    {
                                    $sel_file_details=mysqli_query($conn,"SELECT * from me_provider_type WHERE id='".$_REQUEST['id']."' ");
                                    $fetch=mysqli_fetch_assoc($sel_file_details);
                                                        
                                        echo '<input type="hidden" name="id" id="id" value="'.$_REQUEST['id'].'">';
                                       
                                        // print_r($fetch);
                                    }
                                    ?>
                                    <!-- <div class="col-md-6">
                                    <label for="name" class="form-label"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" data-is_validate="1" id="name" name="name" placeholder="Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['name'])){ echo $fetch['name']; } ?>">
                                    <span class="help text-danger" id="msg2"></span>
                                    </div> -->
                                    <div class="col-sm-6">
                                    <label class="control-label">Name<span>*</span></label>
                                    <div class="form-group">
                                        <input type="text"  name="name" id="name"  class="form-control" placeholder="Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['name'])){ echo $fetch['name']; } ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                    <div class="col-sm-12 text-center">
                                    <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary" type="submit" id="add_task_submit">Save</button>
                                    <a class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary" href="index.php?pid=provider_type_list" >Back</a>
                                    <!-- <button type="submit" id="provider_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                          
        </div>        

    </div>
</section>