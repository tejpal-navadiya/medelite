<style>
    .fileuploader
    {
        padding: 0!important;
        border: 1px solid #333!important;
    }
    .fileuploader-input-caption
    {
        margin-right: 0!important;
        padding: 8px 15px!important;
        border: 0!important;
    }
    
</style>
<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Board Certification Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                    <?php 
                        if($is_readonly)
                        {
                    ?>
                    <a href="index.php?pid=add_boarding_form&tab=practice-employer&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
                    <?php }else{ ?>
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    <?php } ?>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                <input type="hidden" id="medical_board_list" value="<?php echo base64_encode(json_encode($medical_board_list)); ?>"/>
                    <?php
                    // medical_board_list
                    // update_board_certification
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
						include "message.php";
                        if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_board_certification"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                            <input type="hidden" name="action" value="update_board_certification"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=board-certification&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=practice-employer&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }
                    ?>
                    <!-- <input type="hidden" name="action" value="update_board_certification"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=board-certification&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=practice-employer&id=<?php echo $_REQUEST['id']; ?>"/> -->

                    <?php 
                        $total_items=1;
                        if(isset($_REQUEST['id']) && isset($board_certification_detail) && is_array($board_certification_detail))
                        {
                            $total_items = count($board_certification_detail);
                        }
                    ?>
                    <input type="hidden" id="total_items" value="<?php echo $total_items; ?>"/>
                    <h4>Board Certification</h4>
                    <p>List all professional boards and/or associations you are certified with / belong to. Complete Board name, issue date, recertification date, expiration date and MOC status if applicable. Upload a copy of your Board Certification (ABFM, ABIM, AOBFM, AOBIM).</p>
                    <div id="content_wrapper_more_items" class="" style="padding: 15px;">
                        <?php 
                            if(isset($_REQUEST['id']) && isset($board_certification_detail) && is_array($board_certification_detail))
                            {
                                for($cnt_i=0 ; $cnt_i<count($board_certification_detail); $cnt_i++)
                                {
                                    $cur_detail=$board_certification_detail[$cnt_i];
                                    include 'content_add_more_board_certification.php';
                                }
                            }else
                            {
                                $cnt_i=0;$cur_detail=array();  
                                include 'content_add_more_board_certification.php';
                            }
                        ?>
                        
                    </div>
                        
                    <div class="row">    
                        <?php if(!$is_readonly)
                        { ?>
                        <div class="col-sm-12 text-center">
                            
                            <button type="button"  id="add_more_item" onclick="AddMoreItem('board-certification');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Board Certification</button>
                        </div>
                        <?php } ?>
                        <div class="col-sm-12 text-center" style="margin-top:15px;">
                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                        <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=exam-history" id="" class="btn btn-default">back</a>
                        <?php
                            }
                            ?> 
                            <!-- <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button> -->
                            <?php 
                                if($is_readonly)
                                {
                                    ?>
                                    <a href="index.php?pid=add_boarding_form&tab=practice-employer&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
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