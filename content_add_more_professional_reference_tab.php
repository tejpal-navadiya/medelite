<?php 
    $cnt=$cnt_i+1;
?>
<div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">
    <?php 
    if($cnt==1)
    {
        ?>
        <div class="col-sm-12"><h5><u>Reference <?php echo $cnt; ?></u></h5></div>
        <?php
    }else
    {
    ?>
    <div class="col-sm-8 col-md-9"><h5><u>Reference <?php echo $cnt; ?></u></h5></div>
    <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
    <?php } ?>    
    
    <div class="col-sm-12"><label for="firstname" class="control-label">Name <span class="text-danger">*</span></label></div>
    <div class="col-sm-6 col-md-4">
        
        <div class="form-group">
            <input type="text" maxlength="150" name="title[]" id="title<?php echo $cnt; ?>" class="form-control" placeholder="Title" <?php echo $readonly;?> value="<?php if(isset($cur_detail['title'])){ echo $cur_detail['title'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <input type="text" maxlength="100" name="first_name[]" id="first_name<?php echo $cnt; ?>"  class="form-control" <?php echo $readonly;?> <?php echo $readonly;?> placeholder="First Name" value="<?php if(isset($cur_detail['first_name'])){ echo $cur_detail['first_name'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <input type="text" maxlength="100" name="last_name[]" id="last_name<?php echo $cnt; ?>"  class="form-control" <?php echo $readonly;?> placeholder="Last Name" value="<?php if(isset($cur_detail['last_name'])){ echo $cur_detail['last_name'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Company<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="text" name="company_name[]" id="company_name<?php echo $cnt; ?>"  class="form-control" <?php echo $readonly;?> placeholder="Company" value="<?php if(isset($cur_detail['company_name'])){ echo $cur_detail['company_name'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Email<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="email" maxlength="100" name="email[]" id="email<?php echo $cnt; ?>"  class="form-control" <?php echo $readonly;?> placeholder="Email" value="<?php if(isset($cur_detail['email'])){ echo $cur_detail['email'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Phone<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="tel" maxlength="100" name="phone[]" id="phone<?php echo $cnt; ?>"  class="form-control" <?php echo $readonly;?> placeholder="Phone" value="<?php if(isset($cur_detail['phone'])){ echo $cur_detail['phone'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    
    <div class="col-sm-12"><label for="firstname" class="control-label">Home Address <span class="text-danger">*</span></label></div>
    <div class="col-sm-6">
        
        <div class="form-group">
            <input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-<?php echo $cnt; ?>" <?php echo $readonly;?> class="form-control" placeholder="Address Line 1" value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  <?php echo $readonly;?> class="form-control" placeholder="Address Line 2" value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_city[]" id="address_city<?php echo $cnt; ?>"  <?php echo $readonly;?> class="form-control" placeholder="City" value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <select data-placeholder="Select State" name="address_state[]" id="address_state<?php echo $cnt; ?>" <?php echo $disabled;?> class="form-control state_dropdown" placeholder="State"  data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>"></select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode<?php echo $cnt; ?>"  <?php echo $readonly;?> class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
        <div class="form-group">
            <select name="address_country[]" class="form-control  country_dropdown" id="address_country<?php echo $cnt; ?>" <?php echo $disabled;?> data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                <option value="">Select Country</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
</div>