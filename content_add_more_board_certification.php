<?php 
    $cnt=$cnt_i+1;
?>
<style>
    .fileuploader
    {
        margin: 0!important;
    }
</style>
<div class="row col-sm-12" id="content_item1">                          
    <?php 
    if($cnt==1)
    {
        ?>
        <div class="col-sm-12"><h5><u>Board Certification <?php echo $cnt; ?></u></h5></div>
        <?php
    }else
    {
    ?>
    <div class="col-sm-8 col-md-9"><h5><u>Board Certification <?php echo $cnt; ?></u></h5></div>
    <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
    <?php } ?> 
    
    <div class="col-sm-12">
        <label>American Medical Association(AMA)/American Osteopathic Association(AOA) Are you a Member? </label>
        <div class="form-group">
            <input type="radio" value="1" id="is_member_medical_board_yes<?php echo $cnt; ?>" name="is_member_medical_board[]" <?php if(isset($cur_detail['is_member_medical_board']) && $cur_detail['is_member_medical_board']=="1"){ echo "selected";} ?> />Yes
            <input type="radio" value="0" id="is_member_medical_board_no<?php echo $cnt; ?>" name="is_member_medical_board[]" <?php if(isset($cur_detail['is_member_medical_board']) && $cur_detail['is_member_medical_board']=="0"){ echo "selected";} ?> />No
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <label for="firstname" class="control-label">Primary?<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="radio" value="1" id="is_primary_yes<?php echo $cnt; ?>" name="is_primary[]" <?php if(isset($cur_detail['is_primary']) && $cur_detail['is_primary']=="1"){ echo "selected";} ?> />Yes
            <input type="radio" value="0" id="is_primary_no<?php echo $cnt; ?>" name="is_primary[]" <?php if(isset($cur_detail['is_primary']) && $cur_detail['is_primary']=="0"){ echo "selected";} ?> />No
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <label for="firstname" class="control-label">Board Eligible<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="radio" value="1" id="is_board_eligible_yes<?php echo $cnt; ?>" name="is_board_eligible[]" <?php if(isset($cur_detail['is_board_eligible']) && $cur_detail['is_board_eligible']=="1"){ echo "selected";} ?> />Yes
            <input type="radio" value="0" id="is_board_eligible_no<?php echo $cnt; ?>" name="is_board_eligible[]" <?php if(isset($cur_detail['is_board_eligible']) && $cur_detail['is_board_eligible']=="0"){ echo "selected";} ?> />No
        </div>
    </div>
    <div class="col-sm-6 col-md-3" >
        <label for="firstname" style="display:none;" class="control-label">Indefinite<span class="text-danger">*</span> </label>
        <div class="form-group" style="display:none;">
            <input type="radio" value="1" id="is_indefinite_yes<?php echo $cnt; ?>" name="is_indefinite[]" <?php if(isset($cur_detail['is_indefinite']) && $cur_detail['is_indefinite']=="1"){ echo "selected";} ?> />Yes
            <input type="radio" value="0" id="is_indefinite_no<?php echo $cnt; ?>" name="is_indefinite[]" <?php if(isset($cur_detail['is_indefinite']) && $cur_detail['is_indefinite']=="0"){ echo "selected";} ?> />No
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <label for="firstname" class="control-label" style="display:none;">Meeting MOC<span class="text-danger">*</span> </label>
        <div class="form-group" style="display:none;">
            <input type="radio" value="1" id="is_meeting_moc_yes<?php echo $cnt; ?>" name="is_meeting_moc[]" <?php if(isset($cur_detail['is_meeting_moc']) && $cur_detail['is_meeting_moc']=="1"){ echo "selected";} ?> />Yes
            <input type="radio" value="0" id="is_meeting_moc_no<?php echo $cnt; ?>" name="is_meeting_moc[]" <?php if(isset($cur_detail['is_meeting_moc']) && $cur_detail['is_meeting_moc']=="0"){ echo "selected";} ?> />No
        </div>
    </div>
    <div class="col-sm-12">
        <label for="firstname" class="control-label">Board Name<span class="text-danger">*</span> </label>
        <div class="form-group">
            <select name="board_name[]" class="form-control select2" id="board_name<?php echo $cnt; ?>"  data-is_validate="1">
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
            <select name="specialty[]" class="form-control select2" id="specialty<?php echo $cnt; ?>" data-is_validate="1">
                <option value="">Select Option</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Certificate #<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="text" name="certificate_no[]" id="certificate_no<?php echo $cnt; ?>"  class="form-control" data-is_validate="1" placeholder="Certificate #" value="<?php if(isset($cur_detail['certificate_no'])){ echo $cur_detail['certificate_no'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Focus </label>
        <div class="form-group">
            <select name="focus[]" class="form-control select2" id="focus<?php echo $cnt; ?>">
                <option value="">Select Option</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Cert Status </label>
        <div class="form-group">
            <select name="status[]" class="form-control select2" id="status<?php echo $cnt; ?>">
                <option value="">Select Option</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Exam Passed?</label>
        <div class="form-group">
            <select name="exam_passed[]" class="form-control select2" id="exam_passed<?php echo $cnt; ?>">
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
            <input type="text" name="board_link[]" id="board_link<?php echo $cnt; ?>"  class="form-control" placeholder="Board Link" value="<?php if(isset($cur_detail['board_link'])){ echo $cur_detail['board_link'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Upload Documents</label>
        <div class="form-group">
        <input type="file" name="documents[]" id="documents<?php echo $cnt; ?>"  class="form-control multi-upload-file" placeholder="" value=""  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <label for="firstname" class="control-label">Notes</label>
        <div class="form-group">
            <input type="text" name="notes[]" id="notes<?php echo $cnt; ?>"  class="form-control" placeholder="Notes" value="<?php if(isset($cur_detail['notes'])){ echo $cur_detail['notes'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-md-12">
        <h4>Certification Date</h4>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Certificate Duration</label>
        <div class="form-group">
            <input type="text" name="certificate_duration[]" id="certificate_duration<?php echo $cnt; ?>"  class="form-control" placeholder="Certificate Duration" value="<?php if(isset($cur_detail['certificate_duration'])){ echo $cur_detail['certificate_duration'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="issue_date[]" data-is_validate="1" id="issue_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['issue_date'])){ echo $cur_detail['issue_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Expiration Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="expiry_date[]" data-is_validate="1" id="expiry_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['expiry_date'])){ echo $cur_detail['expiry_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Recertification Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="recertification_date[]" data-is_validate="1" id="recertification_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['recertification_date'])){ echo $cur_detail['recertification_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-md-12">
        <h4>Maintenance of Certification</h4>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">MOC/OCC Status</label>
        <div class="form-group">
            <select name="moc_status[]" class="form-control select2" id="moc_status<?php echo $cnt; ?>">
                <option value="">Select Option</option>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Meeting MOC/OCC</label>
        <div class="form-group">
            <select name="meeting_moc[]" class="form-control select2" id="meeting_moc<?php echo $cnt; ?>">
                <option value="">Select Option</option>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-6">
        <label for="firstname" class="control-label">MOC/OCC Verification Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="moc_verification_date[]" data-is_validate="1" id="moc_verification_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['moc_verification_date'])){ echo $cur_detail['moc_verification_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Annual Reverification Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="annual_reverification_date[]" data-is_validate="1" id="annual_revertification_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['annual_reverification_date'])){ echo $cur_detail['recertification_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
</div>