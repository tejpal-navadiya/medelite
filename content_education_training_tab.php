<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Education & Training Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
						include "message.php";
                        if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_education_training"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                           <input type="hidden" name="action" value="update_education_training"/>
                           <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id']; ?>"/>
                           <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=exam-history&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }


                    ?>
                    <!-- <input type="hidden" name="action" value="update_education_training"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=exam-history&id=<?php echo $_REQUEST['id']; ?>"/> -->
                    <?php 
                        $total_items=1;
                        if(isset($_REQUEST['id']) && isset($education_training_detail) && is_array($education_training_detail))
                        {
                            $total_items = count($education_training_detail);
                        }
                    ?>
                    <input type="hidden" id="total_items" value="<?php echo $total_items; ?>"/>
                    <h4>Education & Training</h4>
                    <p>List all education from high school onward. Include the following: Name of school, degree awarded, and dates of attendance. Please list ALL medical schools / PGY training programs even if the program was not completed.</p>
                    <div id="content_wrapper_more_items" class="" style="padding: 15px;">
                        <?php 
                            if(isset($_REQUEST['id']) && isset($education_training_detail) && is_array($education_training_detail))
                            {
                                for($cnt_i=0 ; $cnt_i<count($education_training_detail); $cnt_i++)
                                {
                                    $cur_detail=$education_training_detail[$cnt_i];
                                    include 'content_add_more_education_training.php';
                                }
                            }else
                            {
                                $cnt_i=0;$cur_detail=array();  
                                include 'content_add_more_education_training.php';
                            }
                        ?>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            
                            <button type="button"  id="add_more_item" onclick="AddMoreItem('education-training');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Institute</button>
                        </div>
                        <div class="col-sm-12">
                            <label>Did You have a time gap more than 30 days medical school - graduate  training & post </label>
                            <input type="checkbox" value="1" id="is_time_gap_yes" name="is_time_gap" />Yes
                            <input type="checkbox" value="0" id="is_time_gap_no" name="is_time_gap" />No
                        </div>
                        <div class="col-sm-12 text-center">
                            <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                            <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=provider-demographic" id="" class="btn btn-default">back</a>
                            <?php
                            }
                            ?>
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                        </div>


                    </div>
                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->