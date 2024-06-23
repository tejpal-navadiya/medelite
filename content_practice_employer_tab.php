<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Practice & Employer History Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                    <?php 
                        if($is_readonly)
                        {
                    ?>
                        <a href="index.php?pid=add_boarding_form&tab=hospital-facility&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
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
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
						include "message.php";

                        if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_practice_employer"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                            <input type="hidden" name="action" value="update_practice_employer"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=practice-employer&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=hospital-facility&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }
                    ?>
                    <!-- <input type="hidden" name="action" value="update_practice_employer"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=practice-employer&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=hospital-facility&id=<?php echo $_REQUEST['id']; ?>"/> -->
                    <?php 
                        $total_items=1;
                        if(isset($_REQUEST['id']) && isset($practice_employer_detail) && is_array($practice_employer_detail))
                        {
                            $total_items = count($practice_employer_detail);
                        }
                    ?>
                    <input type="hidden" id="total_items" value="<?php echo $total_items; ?>"/>
                    <h4>Practice & Employer</h4>
                    <p>Complete all fields and include previous supervisor and/ or HR contact information: address, direct phone number and email. Please list the address(es) of each practice listed past 10 years.</p>
                    <div id="content_wrapper_more_items" class="" style="padding: 15px;">
                        <?php 
                            if(isset($_REQUEST['id']) && isset($practice_employer_detail) && is_array($practice_employer_detail))
                            {
                                for($cnt_i=0 ; $cnt_i<count($practice_employer_detail); $cnt_i++)
                                {
                                    // print_r($practice_employer_detail[$cnt_i]);
                                    $cur_detail=$practice_employer_detail[$cnt_i];
                                    include 'content_add_more_practice_employer.php';
                                }
                            }else
                            {
                                $cnt_i=0;$cur_detail=array();  
                                include 'content_add_more_practice_employer.php';
                            }
                        ?>
                        
                    </div>
                    <div class="row">    

                        <div class="col-sm-12 text-center">
                             <?php if(!$is_readonly)
                             { ?>
                            <button type="button"  id="add_more_item" onclick="AddMoreItem('practice_employer');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Employer</button>
                            <?php } ?>
                        </div>
                        
                        <div class="col-sm-12 text-center" style="margin-top:15px;">
                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                        <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=board-certification" id="" class="btn btn-default">back</a>
                        <?php
                            }
                            ?>
                            <!-- <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button> -->
                            <?php 
                                if($is_readonly)
                                {
                                    ?>
                                    <a href="index.php?pid=add_boarding_form&tab=hospital-facility&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
                                    <?php
                                }else
                                {
                                    ?>
                                        <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                                    <?php
                                }
                             ?>
                        </div>


                    </div>
                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->