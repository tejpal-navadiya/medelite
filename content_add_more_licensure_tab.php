<?php 
    $cnt=$cnt_i+1;
?>
<div class="row col-sm-12" id="content_item1">
                            <div class="col-sm-8 col-md-9"><h5><u>Licensure <?php echo $cnt; ?></u></h5></div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Licence Type<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="license_type[]" class="form-control select2" data-is_validate="1" id="license_type<?php echo $cnt; ?>">
                                        <option value="">Select Type</option>
                                        <option value="State Licenses" <?php if(isset($cur_detail['license_type']) && $cur_detail['license_type']=="State Licenses"){ echo "selected";} ?>>State Licenses</option>
                                        <option value="DEA Licenses" <?php if(isset($cur_detail['license_type']) && $cur_detail['license_type']=="DEA Licenses"){ echo "selected";} ?>>DEA Licenses</option>
                                        <option value="State Controlled Substance Licenses" <?php if(isset($cur_detail['license_type']) && $cur_detail['license_type']=="State Controlled Substance Licenses"){ echo "selected";} ?>>State Controlled Substance Licenses</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">State<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="license_state[]" class="form-control state_dropdown" data-is_validate="1" id="license_state<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['license_state_name_sel'])){ echo base64_encode($cur_detail['license_state_name_sel']);} ?>">
                                        <option value="">Select State</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Licence Number<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="license_no[]" id="license_no<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="License Number" value="<?php if(isset($cur_detail['license_no'])){ echo $cur_detail['license_no'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text"  name="issue_date[]" id="issue_date<?php echo $cnt; ?>" data-is_validate="1"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['issue_date'])){ echo $cur_detail['issue_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Expiry Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text"  name="expiry_date[]" id="expiry_date<?php echo $cnt; ?>" data-is_validate="1"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['expiry_date'])){ echo $cur_detail['expiry_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Primary<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="primary_license[]" class="form-control" id="primary_license<?php echo $cnt; ?>">
                                        <option value="Yes" <?php if(isset($cur_detail['primary_license']) && $cur_detail['primary_license']=="Yes"){ echo "selected";} ?>>Yes</option>
                                        <option value="No" <?php if(isset($cur_detail['primary_license']) && $cur_detail['primary_license']=="No"){ echo "selected";} ?>>No</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Compact<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="compact_license[]" class="form-control" id="compact_license<?php echo $cnt; ?>">
                                        <option value="Yes" <?php if(isset($cur_detail['compact_license']) && $cur_detail['compact_license']=="Yes"){ echo "selected";} ?>>Yes</option>
                                        <option value="No" <?php if(isset($cur_detail['compact_license']) && $cur_detail['compact_license']=="No"){ echo "selected";} ?>>No</option>
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Status<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="license_status[]" class="form-control select2" data-is_validate="1" id="license_status<?php echo $cnt; ?>">
                                        <option value="">select status</option>
                                        <?php
                                            for ($i=0; $i < count($license_status_list); $i++) 
                                            { 
                                                $cur_status_id=$i+1;
                                                $selected_status="";
                                                if(isset($cur_detail['license_status']) && $cur_detail['license_status']==$cur_status_id)
                                                {
                                                    $selected_status="selected";
                                                }
                                                echo '<option value="'.$cur_status_id.'" '.$selected_status.'>'.$license_status_list[$i].'</option>';
                                            } 
                                        ?>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                        </div>