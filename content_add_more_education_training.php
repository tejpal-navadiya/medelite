<?php 
    $cnt = $cnt_i + 1;
?>
<div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">
    <?php if ($cnt == 1) { ?>
        <div class="col-sm-12"><h5><u>Institution <?php echo $cnt; ?></u></h5></div>
    <?php } else { ?>
        <div class="col-sm-8 col-md-9"><h5><u>Institution <?php echo $cnt; ?></u></h5></div>
        <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
    <?php } ?>    
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Institution Type<span class="text-danger">*</span> </label>
        <div class="form-group">
            <select name="institute_type[]" <?php echo $readonly;?> class="form-control" id="institute_type<?php echo $cnt; ?>" <?php echo $readonly; ?>>
                <option value="">Select Type</option>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="start_date[]" id="start_date<?php echo $cnt; ?>" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if (isset($cur_detail['start_date'])) { echo $cur_detail['start_date']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="end_date[]" id="end_date<?php echo $cnt; ?>" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if (isset($cur_detail['end_date'])) { echo $cur_detail['end_date']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <label for="firstname" class="control-label">Institution Name<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="text" name="institute_name[]" <?php echo $readonly;?> id="institute_name<?php echo $cnt; ?>" class="form-control" placeholder="Institution Name" value="<?php if (isset($cur_detail['institute_name'])) { echo $cur_detail['institute_name']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-12"><label for="firstname" <?php echo $readonly;?> class="control-label">Institute Address <span class="text-danger">*</span></label></div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" maxlength="150" <?php echo $readonly;?> name="address_line_1[]" id="address_line_1-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 1" value="<?php if (isset($cur_detail['address_line_1'])) { echo $cur_detail['address_line_1']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 2" value="<?php if (isset($cur_detail['address_line_2'])) { echo $cur_detail['address_line_2']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="address_city[]" id="address_city<?php echo $cnt; ?>" class="form-control" placeholder="City" value="<?php if (isset($cur_detail['address_city'])) { echo $cur_detail['address_city']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <select data-placeholder="Select State" <?php echo $readonly;?> name="address_state[]" id="address_state<?php echo $cnt; ?>" class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if (isset($cur_detail['address_state_name_sel'])) { echo base64_encode($cur_detail['address_state_name_sel']); } ?>" <?php echo $readonly; ?>></select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="address_zipcode[]" id="address_zipcode<?php echo $cnt; ?>" class="form-control" placeholder="Zip Code" value="<?php if (isset($cur_detail['address_zipcode'])) { echo $cur_detail['address_zipcode']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <select name="address_country[]" <?php echo $readonly;?> class="form-control country_dropdown" id="address_country<?php echo $cnt; ?>" data-val_sel="<?php if (isset($cur_detail['address_country_name_sel'])) { echo base64_encode($cur_detail['address_country_name_sel']); } ?>" <?php echo $readonly; ?>>
                <option value="">Select Country</option>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Degree<span class="text-danger">*</span> </label>
        <div class="form-group">
            <select name="degree[]" <?php echo $readonly;?> class="form-control" id="degree<?php echo $cnt; ?>" <?php echo $readonly; ?>>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Major</label>
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="major[]" id="major<?php echo $cnt; ?>" class="form-control" placeholder="Major" value="<?php if (isset($cur_detail['major'])) { echo $cur_detail['major']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Program Completed?<span class="text-danger">*</span> </label>
        <div class="form-group">
            <select name="program_completed[]" <?php echo $readonly;?> class="form-control" id="program_completed<?php echo $cnt; ?>" <?php echo $readonly; ?>>
                <option value="">Completed</option>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Grad Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" <?php echo $readonly;?> name="graduation_date[]" id="graduation_date<?php echo $cnt; ?>" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if (isset($cur_detail['graduation_date'])) { echo $cur_detail['graduation_date']; } ?>" <?php echo $readonly; ?>>
            <span class="help" id="msg2"></span>
        </div>
    </div>
</div>
