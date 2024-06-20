<style>
    .custom-state-option-wrapper
    {
        border: 1px solid;
        border-radius: 5px;
        padding: 6px 10px 0px 10px;
        max-width: 31%!important;
        margin: 5px;
    }
    .custom-state-option-wrapper input
    {
        float: right;
        margin-top: 5px;
    }
    @media (max-width:767px) 
    {
        .custom-state-option-wrapper
        {
            max-width: 47%!important;
        }
    }
</style>
<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> State Seletion</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
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
                            <input type="hidden" name="action" value="update_state_selection"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                          <input type="hidden" name="action" value="update_state_selection"/>
                          <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=state-selection&id=<?php echo $_REQUEST['id']; ?>"/>
                          <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=licensure&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }

                        // print_r($states_detail);
                    ?>
                    <!-- <input type="hidden" name="action" value="update_state_selection"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=state-selection&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=licensure&id=<?php echo $_REQUEST['id']; ?>"/> -->
                    
                    <h4>State Selection</h4>
                    <p>Check off all the state(s) requesting for licensure</p>
                    <div  class="row col-sm-12" >
                    
                        <?php 
                            for ($i=0; $i < count($StateList); $i++) 
                            { 
                                $cid= $StateList[$i]['id'];
                                $cname= $StateList[$i]['text'];
                                ?>
                                   <div class="col-md-4 col-sm-6 custom-state-option-wrapper">
                                    <label for="state_id<?php echo $cid; ?>"><?php echo $cname; ?></label>
                                    <input type="checkbox" name="state_id[]" <?php if(isset($states_detail) &&is_array($states_detail) && in_array($cid,$states_detail)){echo "checked";} ?> value="<?php echo $cid; ?>" id="state_id<?php echo $cid; ?>" />
                                   </div> 
                                <?php
                            }
                        ?>
                    </div>    
                    <div class="row">
                        
                        
                        <div class="col-sm-12 text-center" style="margin-top:15px;">
                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                            <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=professional-references" id="" class="btn btn-default">back</a>
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