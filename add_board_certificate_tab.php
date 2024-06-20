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
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/action_board_certificate_list.php">
                  
                  
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
                  <div class="col-sm-12">
                        <label>American Medical Association(AMA)/American Osteopathic Association(AOA) Are you a Member? </label>
                        <div class="form-group">
                            <input type="radio" value="1" id="is_member_medical_board_yes" name="is_member_medical_board" <?php if(isset($cur_detail['is_member_medical_board']) && $cur_detail['is_member_medical_board']=="1"){ echo "selected";} ?> />Yes
                            <input type="radio" value="0" id="is_member_medical_board_no" name="is_member_medical_board" <?php if(isset($cur_detail['is_member_medical_board']) && $cur_detail['is_member_medical_board']=="0"){ echo "selected";} ?> />No
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label for="firstname" class="control-label">Primary?<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="radio" value="1" id="is_primary_yes" name="is_primary" <?php if(isset($cur_detail['is_primary']) && $cur_detail['is_primary']=="1"){ echo "selected";} ?> />Yes
                            <input type="radio" value="0" id="is_primary_no" name="is_primary" <?php if(isset($cur_detail['is_primary']) && $cur_detail['is_primary']=="0"){ echo "selected";} ?> />No
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label for="firstname" class="control-label">Board Eligible<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="radio" value="1" id="is_board_eligible_yes" name="is_board_eligible" <?php if(isset($cur_detail['is_board_eligible']) && $cur_detail['is_board_eligible']=="1"){ echo "selected";} ?> />Yes
                            <input type="radio" value="0" id="is_board_eligible_no" name="is_board_eligible" <?php if(isset($cur_detail['is_board_eligible']) && $cur_detail['is_board_eligible']=="0"){ echo "selected";} ?> />No
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3" >
                        <label for="firstname" style="display:none;" class="control-label">Indefinite<span class="text-danger">*</span> </label>
                        <div class="form-group" style="display:none;">
                            <input type="radio" value="1" id="is_indefinite_yes" name="is_indefinite" <?php if(isset($cur_detail['is_indefinite']) && $cur_detail['is_indefinite']=="1"){ echo "selected";} ?> />Yes
                            <input type="radio" value="0" id="is_indefinite_no" name="is_indefinite" <?php if(isset($cur_detail['is_indefinite']) && $cur_detail['is_indefinite']=="0"){ echo "selected";} ?> />No
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label for="firstname" class="control-label" style="display:none;">Meeting MOC<span class="text-danger">*</span> </label>
                        <div class="form-group" style="display:none;">
                            <input type="radio" value="1" id="is_meeting_moc_yes" name="is_meeting_moc" <?php if(isset($cur_detail['is_meeting_moc']) && $cur_detail['is_meeting_moc']=="1"){ echo "selected";} ?> />Yes
                            <input type="radio" value="0" id="is_meeting_moc_no" name="is_meeting_moc" <?php if(isset($cur_detail['is_meeting_moc']) && $cur_detail['is_meeting_moc']=="0"){ echo "selected";} ?> />No
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="firstname" class="control-label">Board Name<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <select name="board_name" class="form-control select2" id="board_name"  data-is_validate="1">
                                <option value="">Select Board Name</option>
                                <?php 
                                    for ($i=0; $i < count($medical_board_list); $i++) 
                                    { 
                                        echo "<option value='".($i+1)."'>".$medical_board_list[$i]."</option>";
                                    }
                                ?>
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Speciality/Subspeciality<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <select name="specialty" class="form-control select2" id="specialty" data-is_validate="1">
                                <option value="">Select Option</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Certificate #<span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input type="text" name="certificate_no" id="certificate_no"  class="form-control" data-is_validate="1" placeholder="Certificate #" value="<?php if(isset($cur_detail['certificate_no'])){ echo $cur_detail['certificate_no'];} ?>"  >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Focus </label>
                        <div class="form-group">
                            <select name="focus" class="form-control select2" id="focus">
                                <option value="">Select Option</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Cert Status </label>
                        <div class="form-group">
                            <select name="certificate_status" class="form-control select2" id="certificate_status">
                                <option value="">Select Option</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Exam Passed?</label>
                        <div class="form-group">
                            <select name="exam_passed" class="form-control select2" id="exam_passed">
                                <option value="">Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Board Link</label>
                        <div class="form-group">
                            <input type="text" name="board_link" id="board_link"  class="form-control" placeholder="Board Link" value="<?php if(isset($cur_detail['board_link'])){ echo $cur_detail['board_link'];} ?>"  >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Upload Documents</label>
                        <div class="form-group">
                        <input type="file" name="documents" id="documents"  class="form-control multi-upload-file" placeholder="" value=""  >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="firstname" class="control-label">Notes</label>
                        <div class="form-group">
                            <input type="text" name="notes" id="notes"  class="form-control" placeholder="Notes" value="<?php if(isset($cur_detail['notes'])){ echo $cur_detail['notes'];} ?>"  >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4>Certification Date</h4>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Certificate Duration</label>
                        <div class="form-group">
                            <input type="text" name="certificate_duration" id="certificate_duration"  class="form-control" placeholder="Certificate Duration" value="<?php if(isset($cur_detail['certificate_duration'])){ echo $cur_detail['certificate_duration'];} ?>"  >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="issue_date" data-is_validate="1" id="issue_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['issue_date'])){ echo $cur_detail['issue_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Expiration Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="expiry_date" data-is_validate="1" id="expiry_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['expiry_date'])){ echo $cur_detail['expiry_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Recertification Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="recertification_date" data-is_validate="1" id="recertification_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['recertification_date'])){ echo $cur_detail['recertification_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4>Maintenance of Certification</h4>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">MOC/OCC Status</label>
                        <div class="form-group">
                            <select name="moc_occ_status " class="form-control select2" id="moc_occ_status">
                                <option value="">Select Option</option>
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Meeting MOC/OCC</label>
                        <div class="form-group">
                            <select name="meeting_moc_occ " class="form-control select2" id="meeting_moc_occ">
                                <option value="">Select Option</option>
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">MOC/OCC Verification Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="moc_occ_verifiaction_date " data-is_validate="1" id="moc_occ_verifiaction_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['moc_verification_date'])){ echo $cur_detail['moc_verification_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Annual Reverification Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="annual_reverifiaction_date" data-is_validate="1" id="annual_revertification_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['annual_reverifiaction_date'])){ echo $cur_detail['recertification_date'];} ?>">
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