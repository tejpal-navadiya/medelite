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
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/action_add_education_training.php">
                  
                  
                  <?php
                        if(isset($_REQUEST['id']))
                        {
                            // echo' <input type="hidden" id="form_id" name="form_id" value="'.$_REQUEST['form_id'].'">'
                            // echo' <input type="hidden" id="firm_id" name="firm_id" value="'.$_REQUEST['firm_id'].'">'
                            // echo' <input type="hidden" id="record_id" name="id" value="">'
                            // echo '<input type="hidden" name="firm_id" value="'.$_REQUEST['id'].'">';
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
						include "message.php";
                    ?>
                  <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Institution Type<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="institute_type" class="form-control" id="institute_type<?php echo $cnt; ?>">
                                    <option value="">Select Type</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="start_date" id="start_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['start_date'])){ echo $cur_detail['start_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="end_date" id="end_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['end_date'])){ echo $cur_detail['end_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Institution Name<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="institute_name" id="institute_name<?php echo $cnt; ?>"  class="form-control" placeholder="Institution Name" value="<?php if(isset($cur_detail['institute_name'])){ echo $cur_detail['institute_name'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-sm-12"><label for="firstname" class="control-label">Institute Address <span class="text-danger">*</span></label></div>
                        
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <input type="text" maxlength="150" name="address_line_1" id="address_line_1-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 1" value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="address_line_2" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="address_city" id="address_city<?php echo $cnt; ?>"  class="form-control" placeholder="City" value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                    
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <select data-placeholder="Select State" name="address_state" id="address_state<?php echo $cnt; ?>"  class="form-control state_dropdown" placeholder="State"  data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>"></select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="address_zipcode" id="address_zipcode<?php echo $cnt; ?>"  class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                            <div class="form-group">
                                <select name="address_country" class="form-control  country_dropdown" id="address_country<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                                    <option value="">Select Country</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>

                        
                        
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Degree<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="degree" class="form-control" id="degree<?php echo $cnt; ?>">
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Major </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="major" id="major<?php echo $cnt; ?>"  class="form-control" placeholder="major" value="<?php if(isset($cur_detail['major'])){ echo $cur_detail['major'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Program Completed?<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="program_completed" class="form-control" id="program_completed<?php echo $cnt; ?>">
                                    <option value="">Completed</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Grad Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="graduation_date" id="graduation_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['graduation_date'])){ echo $cur_detail['graduation_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                           
                            <!-- <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=provider-demographic" id="" class="btn btn-default">back</a> -->
                         
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                        </div>

                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->