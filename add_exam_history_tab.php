<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Exam History</h3>
                    </div>
                    <!-- <div class="col-sm-6 text-right">
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    </div>         -->

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/action_add_exam_history.php">
                  
                  
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
                            <label for="firstname" class="control-label">Exam Type </label>
                            <div class="form-group">
                                <select name="exam_type" class="form-control select2" id="exam_type">
                                    <option value="">Select Type</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Examination </label>
                            <div class="form-group">
                                <select name="examination" class="form-control" id="examination">
                                    <option value="">Select Level</option>
                                    <?php 
                                        for ($i=1; $i < 6; $i++) 
                                        {
                                            $sel_level="";
                                            if(isset($cur_detail['examination']) && $cur_detail['examination']==$i){ $sel_level= "selected";} 

                                            echo '<option value="'.$i.'" '.$sel_level.'>Level '.$i.'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label"># of Attempts<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="no_of_attempts" class="form-control" data-is_validate="1" id="no_of_attempts">
                                    <option value="">Select Attemps</option>
                                    <?php 
                                        for ($i=1; $i < 6; $i++) 
                                        {
                                            $sel_attemps="";
                                            if(isset($cur_detail['no_of_attempts']) && $cur_detail['no_of_attempts']==$i){ $sel_attemps= "selected";} 
                                            echo '<option '.$sel_attemps.'>'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Score<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="number" name="score" id="score" data-is_validate="1"  class="form-control " placeholder="Score" value="<?php if(isset($cur_detail['score'])){ echo $cur_detail['score'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">First try Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="first_try_date" data-is_validate="1" id="first_try_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['first_try_date'])){ echo $cur_detail['first_try_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Exam Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="exam_date" data-is_validate="1" id="exam_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['exam_date'])){ echo $cur_detail['exam_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Exam Passed?<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="is_passed" class="form-control" id="is_passed" data-is_validate="1">
                                    <option value="Yes" <?php if(isset($cur_detail['is_passed']) && $cur_detail['is_passed']=="Yes"){ echo "selected";} ?>>Yes</option>
                                    <option value="No" <?php if(isset($cur_detail['is_passed']) && $cur_detail['is_passed']=="No"){ echo "selected";} ?>>No</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <label for="firstname" class="control-label">Location</label>
                            <div class="form-group">
                                <input type="text" name="location" id="location"  class="form-control " placeholder="Location" value="<?php if(isset($cur_detail['location'])){ echo $cur_detail['location'];} ?>"  >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Notes</label>
                            <div class="form-group">
                                <input type="text" name="notes" id="notes"  class="form-control " placeholder="Notes" value="<?php if(isset($cur_detail['notes'])){ echo $cur_detail['notes'];} ?>"  >
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