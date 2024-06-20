<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> State Medical Board & Institution Directory</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                            </div>        

                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" id="directory_form"  method="post" >
                        <?php if(isset($_REQUEST['id'])){echo "<input type='hidden' id='id' value='".$_REQUEST['id']."'>";}?>
                            <div class="row">
                                <div class="col-sm-6 col-md-4" style="display:none;">
                                    <label for="firstname" class="control-label">Practice /Employer /Facility Type<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <select name="directry_type" class="form-control" id="directry_type">
                                            <option value="">Select Type</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">State Medical Board Name<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="board_name" id="board_name"  class="form-control " placeholder="State Medical Board Name" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Attention To</label>
                                    <div class="form-group">
                                        <input type="text" name="attention_to" id="attention_to"  class="form-control " placeholder="Attention To" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12"><label for="firstname" class="control-label">Address <span class="text-danger">*</span></label></div>
                                <span class="help" id="msg2"></span>
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <input type="text" maxlength="150" name="address_line_1" id="address_line_1" class="form-control" placeholder="Address Line 1" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="address_line_2" id="address_line_2"  class="form-control" placeholder="Address Line 2" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="city" id="city"  class="form-control" placeholder="City" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <!-- <input type="text" maxlength="100" name="state" id="state"  class="form-control" placeholder="State" value="" > -->
                                        <select name="state" class="form-control" id="state">
                                            <option value="">Select State</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="zip_code" id="zip_code"  class="form-control" placeholder="Zip Code" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3" style="display:none;">
                                    <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                                    <div class="form-group">
                                        <select name="country" class="form-control" id="country">
                                            <option value="">Select Country</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12"><label for="firstname" class="control-label">Overnight/Priority Mailing Address</label></div>
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <input type="text" maxlength="150" name="p_address_line_1" id="p_address_line_1" class="form-control" placeholder="Address Line 1" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="p_address_line_2" id="p_address_line_2"  class="form-control" placeholder="Address Line 2" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="p_city" id="p_city"  class="form-control" placeholder="City" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <!-- <input type="text" maxlength="100" name="p_state" id="p_state"  class="form-control" placeholder="State" value="" > -->
                                        <select name="p_state" class="form-control" id="p_state">
                                            <option value="">Select State</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="p_zip_code" id="p_zip_code"  class="form-control" placeholder="Zip Code" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3" style="display:none;">
                                    <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                                    <div class="form-group">
                                        <select name="p_country" class="form-control" id="p_country">
                                            <option value="">Select Country</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <label for="firstname" class="control-label">Board Email Address</label>
                                    <div class="form-group">
                                        <input type="email" name="board_email" id="board_email"  class="form-control " placeholder="Board Email Address" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="firstname" class="control-label">Licensing Email Address</label>
                                    <div class="form-group">
                                        <input type="email" name="board_email_licence" id="board_email_licence"  class="form-control " placeholder="Licensing Email Address" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="firstname" class="control-label">Verification Email Address</label>
                                    <div class="form-group">
                                        <input type="email" name="board_email_verification" id="board_email_verification"  class="form-control " placeholder="Verification Email Address" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Phone<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="tel" name="tel_number_1" id="tel_number_1"  class="form-control " placeholder="Phone" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Phone2</label>
                                    <div class="form-group">
                                        <input type="tel" name="tel_number_2" id="tel_number_2"  class="form-control " placeholder="Phone2" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Fax</label>
                                    <div class="form-group">
                                        <input type="tel" name="fax" id="fax"  class="form-control " placeholder="Fax" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Website Address<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="website" id="website"  class="form-control " placeholder="Website" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Online Portal</label>
                                    <div class="form-group">
                                        <input type="text" name="online_portal" id="online_portal"  class="form-control " placeholder="Online Portal" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="firstname" class="control-label">Notes</label>
                                    <div class="form-group">
                                        <textarea name="notes" id="notes"  class="form-control " placeholder="Notes" value=""  ></textarea>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Application Processing Time</label>
                                    <div class="form-group">
                                        <input type="text" name="application_processing_time" id="application_processing_time"  class="form-control " placeholder="Application Processing Time" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Initial Application Base Fee ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="initial_application_base_fee" id="initial_application_base_fee"  class="form-control " placeholder="Initial Application Base Fee ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="initial_application_base_fee2" class="control-label">Initial Application Base Fee 2 ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="initial_application_base_fee2" id="initial_application_base_fee2" class="form-control fee" placeholder="Initial Application Base Fee 2 ($)" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>                      
                                <div class="col-sm-6 col-md-4">
                                    <label for="application_processing_fee" class="control-label">Application Processing Fee ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="application_processing_fee" id="application_processing_fee" class="form-control fee" placeholder="Application Processing Fee ($)" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="full_biennuim_fee" class="control-label">Full Biennium Fee ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="full_biennuim_fee" id="full_biennuim_fee"  class="form-control fee" placeholder="Full Biennium Fee ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="half_biennuim_fee" class="control-label">Half Biennium Fee ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="half_biennuim_fee" id="half_biennuim_fee" class="form-control fee" placeholder="Half Biennium Fee ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="exam_fee" class="control-label">Exam Fee ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="exam_fee" id="exam_fee"  class="form-control fee" placeholder="Exam Fee ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="fp_cbc_fee" class="control-label">FP/CBC Fees ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="fp_cbc_fee" id="fp_cbc_fee"  class="form-control fee" placeholder="FP/CBC Fees ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="additional_fee" class="control-label">Addt'l Fees ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="additional_fee" id="additional_fee"  class="form-control fee" placeholder="Addt'l Fees ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="issuance_fee" class="control-label">Issuance Fees ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="issuance_fee" id="issuance_fee"  class="form-control fee" placeholder="Issuance Fees ($)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                                                <div class="col-sm-6 col-md-4">
                                    <label for="total_fee" class="control-label">Total Fees ($)</label>
                                    <div class="form-group">
                                        <input type="number" name="total_fee" id="total_fee" class="form-control" placeholder="Total Fees ($)" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    
                                    <button type="submit" id="directory_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                          
        </div>        

    </div>
</section>
<script>
window.onload = function() {
    var feeFields = document.querySelectorAll('.fee');
    var totalFeeField = document.getElementById("total_fee");

    function updateTotalFee() {
        var total = 0;
        feeFields.forEach(function(field) {
            var value = parseFloat(field.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
        totalFeeField.value = total.toFixed(2); 
    }

    feeFields.forEach(function(field) {
        field.addEventListener("input", updateTotalFee);
    });

    totalFeeField.disabled = true;
};
</script>