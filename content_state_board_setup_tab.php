<!-- <div class="row">
    <div class="col-md-12"> -->
    <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> State Board Online Portal Setup Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                    <?php 
                        if($is_readonly)
                        {
                    ?>
                    <a href="index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
                    <?php }else{ ?>
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    <?php } ?>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
            <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                    
                    <?php
                    // update_board_certification
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
						include "message.php";
                        if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_state_board"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                          <input type="hidden" name="action" value="update_state_board"/>
                          <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=state-board-setup&id=<?php echo $_REQUEST['id']; ?>"/>
                          <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }
                    ?>
                    <!-- <input type="hidden" name="action" value="update_state_board"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=state-board-setup&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id']; ?>"/> -->

                    <?php 
                        $total_items=1;
                        if(isset($_REQUEST['id']) && isset($state_board_setup_detail) && is_array($state_board_setup_detail))
                        {
                            $total_items = count($state_board_setup_detail);
                        }
                    ?>
                    <h4>State Board Online Portal Setup</h4>
                    <p>State Board, Certifications, Memberships, Education Institution Login Information</p>
                    <input type="hidden" id="total_items" value="<?php echo $total_items; ?>"/>
                    
                    <div id="content_wrapper_more_items" class="" style="padding: 15px;">
                        <?php 
                            if(isset($_REQUEST['id']) && isset($state_board_setup_detail) && is_array($state_board_setup_detail))
                            {
                                for($cnt_i=0 ; $cnt_i<count($state_board_setup_detail); $cnt_i++)
                                {
                                    $cur_detail=$state_board_setup_detail[$cnt_i];
                                    include 'content_add_more_state_board_setup_tab.php';
                                }
                                $other_details=$state_board_setup_detail[0];
                            }else
                            {
                                $cnt_i=0;$cur_detail=array();  
                                include 'content_add_more_state_board_setup_tab.php';
                            }
                        ?>
                    </div>
                    <div class="row">    
                    <?php if(!$is_readonly)
                        { ?> 
                        <div class="col-sm-12 text-center">
                            
                            <button type="button"  id="add_more_item" onclick="AddMoreItem('state-board');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Item</button>
                        </div>
                        <?php } ?>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Favourite Color?</label>
                            <div class="form-group">
                                <input type="text" name="favorite_color" <?php echo $readonly;?> id="favorite_color"  class="form-control" placeholder="Favourite Color" value="<?php if(isset($other_details['favorite_color'])){echo $other_details['favorite_color'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Favourite Pet Name?</label>
                            <div class="form-group">
                                <input type="text" name="favorite_pet_name" <?php echo $readonly;?> id="favorite_pet_name"  class="form-control" placeholder="Favourite Pet Name" value="<?php if(isset($other_details['favorite_pet_name'])){echo $other_details['favorite_pet_name'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Where did you & your significant other meet?</label>
                            <div class="form-group">
                                <input type="text" name="significant_meet" <?php echo $readonly;?> id="significant_meet"  class="form-control" placeholder="" value="<?php if(isset($other_details['significant_meet'])){echo $other_details['significant_meet'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Favourite Vacation/dream destination?</label>
                            <div class="form-group">
                                <input type="text" name="vacation_destination" <?php echo $readonly;?> id="vacation_destination"  class="form-control" placeholder="" value="<?php if(isset($other_details['vacation_destination'])){echo $other_details['vacation_destination'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Favourite Teacher?</label>
                            <div class="form-group">
                                <input type="text" name="favorite_teacher" <?php echo $readonly;?> id="favorite_teacher"  class="form-control" placeholder="" value="<?php if(isset($other_details['favorite_teacher'])){echo $other_details['favorite_teacher'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Father's Middle Name?</label>
                            <div class="form-group">
                                <input type="text" name="father_middle_name" <?php echo $readonly;?> id="father_middle_name"  class="form-control" placeholder="" value="<?php if(isset($other_details['father_middle_name'])){echo $other_details['father_middle_name'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Mother's Middle Name?</label>
                            <div class="form-group">
                                <input type="text" name="mother_middle_name" <?php echo $readonly;?> id="mother_middle_name"  class="form-control" placeholder="" value="<?php if(isset($other_details['mother_middle_name'])){echo $other_details['mother_middle_name'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">What is the name of hospital you were born?</label>
                            <div class="form-group">
                                <input type="text" name="born_hospital"  <?php echo $readonly;?> id="born_hospital"  class="form-control" placeholder="" value="<?php if(isset($other_details['born_hospital'])){echo $other_details['born_hospital'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">What is the name of city your mother were born?</label>
                            <div class="form-group">
                                <input type="text" name="mother_born_city" <?php echo $readonly;?> id="mother_born_city"  class="form-control" placeholder="" value="<?php if(isset($other_details['mother_born_city'])){echo $other_details['mother_born_city'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Last name of your Girlfriend/Boyfriend?</label>
                            <div class="form-group">
                                <input type="text" name="last_name_bf_gf" <?php echo $readonly;?> id="last_name_bf_gf"  class="form-control" placeholder="" value="<?php if(isset($other_details['last_name_bf_gf'])){echo $other_details['last_name_bf_gf'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">In What City was your first job?</label>
                            <div class="form-group">
                                <input type="text" name="city_first_job" <?php echo $readonly;?> id="city_first_job"  class="form-control" placeholder="" value="<?php if(isset($other_details['city_first_job'])){echo $other_details['city_first_job'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Name of the street you grew up on?</label>
                            <div class="form-group">
                                <input type="text" name="street_name_grew_up" <?php echo $readonly;?> id="street_name_grew_up"  class="form-control" placeholder="" value="<?php if(isset($other_details['street_name_grew_up'])){echo $other_details['street_name_grew_up'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Highschool Mascot?</label>
                            <div class="form-group">
                                <input type="text" name="highschool_mascot" <?php echo $readonly;?> id="highschool_mascot"  class="form-control" placeholder="" value="<?php if(isset($other_details['highschool_mascot'])){echo $other_details['highschool_mascot'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Make & Model of first car?</label>
                            <div class="form-group">
                                <input type="text" name="make_model_first_car" <?php echo $readonly;?> id="make_model_first_car"  class="form-control" placeholder="" value="<?php if(isset($other_details['make_model_first_car'])){echo $other_details['make_model_first_car'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">What was the name of the company where you had your first job?</label>
                            <div class="form-group">
                                <input type="text" name="company_name_first_job" <?php echo $readonly;?> id="company_name_first_job"  class="form-control" placeholder="" value="<?php if(isset($other_details['company_name_first_job'])){echo $other_details['company_name_first_job'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 text-center" style="margin-top:15px;">
                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                        <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=licensure" id="" class="btn btn-default">back</a>
                        <?php
                            }
                            ?>
                             <?php 
                                if($is_readonly)
                                {
                                    ?>
                                    <a href="index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
                                    <?php
                                }else
                                {
                                    ?>
                                        <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                                    <?php
                                }
                             ?>
                            <!-- <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button> -->
                        </div>


                    </div>
                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->