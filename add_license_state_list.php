<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("config.php");

?>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Licensure List Edit</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                            </div>        
                        </div>
                    </div>

                    <div class="card-body">
                    <form class="form-horizontal" id="state_licenses_form"  method="post" >
                        <?php if(isset($_REQUEST['id'])){echo "<input type='hidden' id='id' value='".$_REQUEST['id']."'>";}?>
                            <div class="row">
                            <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                   <label for="provider_id" class="control-label">Provider Nam</label>
                                      
                                    <select name="provider_id" class="form-control" id="provider_id">
                                                <?php
                                                $sql = "SELECT id, provider_name FROM me_provider where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["provider_name"] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No providers found</option>';
                                                }
                                               
                                                ?>
                                            </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                   <label for="state" class="control-label">Stat</label>
                                        <select name="state" class="form-control" id="state">
                                        <?php
                                                $sql = "SELECT id, name FROM me_states where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                    }

                                                } else {
                                                    echo '<option value="">No License Type found</option>';
                                                }
                                                ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                   <label for="license_type" class="control-label">License Typ</label>
                                    <select name="license_type" class="form-control" id="license_type">
                                                <?php
                                                $sql = "SELECT id, name FROM me_license_type where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                    }

                                                } else {
                                                    echo '<option value="">No License Type found</option>';
                                                }
                                                ?>
                                            </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="license_number" class="control-label">  License Number</label>
                                    <div class="form-group">
                                        <input type="text"  name="license_number" data-is_validate="1" id="license_number"  class="form-control" placeholder="license number" value="<?php if(isset($cur_detail['license_number'])){ echo $cur_detail['license_number'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                   <label for="issue_date" class="control-label">Issue Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="issue_date" data-is_validate="1" id="issue_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['issue_date'])){ echo $cur_detail['issue_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                   <label for="exp_date" class="control-label">Exp Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="exp_date" data-is_validate="1" id="exp_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['exp_date'])){ echo $cur_detail['exp_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="last_updated" class="control-label"> Last Updated</label>
                                    <div class="form-group">
                                        <input type="text"  name="last_updated" data-is_validate="1" id="last_updated"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['last_updated'])){ echo $cur_detail['last_updated'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-md-4">
                                   <label for="suppervising_physician" class="control-label"> Supervising Physician</label>
                                    <div class="form-group">
                                        <input type="text"  name="suppervising_physician" data-is_validate="1" id="suppervising_physician"  class="form-control" placeholder="Supervising" value="<?php if(isset($cur_detail['suppervising_physician'])){ echo $cur_detail['suppervising_physician'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-4">
                                   <label for="practitioners_in_cpa" class="control-label"> Practitioner(s)in CPA</label>
                                    <div class="form-group">
                                        <input type="text"  name="practitioners_in_cpa" data-is_validate="1" id="practitioners_in_cpa"  class="form-control" placeholder="Prectitioner" value="<?php if(isset($cur_detail['practitioners_in_cpa'])){ echo $cur_detail['practitioners_in_cpa'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="firstname" class="control-label">Renewal Id/Pin</label>
                                    <div class="form-group">
                                        <input type="text"  name="renewal_id_pin" data-is_validate="1" id="renewal_id_pin"  class="form-control" placeholder="Renewal Id/Pin" value="<?php if(isset($cur_detail['renewal_id_pin'])){ echo $cur_detail['renewal_id_pin'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="primary_check">Primary</label>
                                        <input type="checkbox" id="primary_check" name="primary_check" value="<?php echo isset($cur_detail['primary_check']) && $cur_detail['primary_check'] == '1' ? '1' : '0'; ?>" <?php if(isset($cur_detail['primary_check']) && $cur_detail['primary_check'] == '1') { echo 'checked'; } ?>>
                                    </div>
                                </div> -->
                              
                                <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="primary_check">Primary</label>
                                            <input type="checkbox" id="primary_check" name="primary_check" value="<?php if(isset($cur_detail['primary_check']) && $cur_detail['primary_check'] == '1') { echo 'checked'; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="compact">Compact</label>
                                            <input type="checkbox" id="compact" name="compact" value="1" <?php if(isset($cur_detail['compact']) && $cur_detail['compact'] == '1') { echo 'checked'; } ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="collaborative_relationship">Collaborative</label>
                                            <input type="checkbox" id="collaborative_relationship" name="collaborative_relationship" value="1" <?php if(isset($cur_detail['collaborative_relationship']) && $cur_detail['collaborative_relationship'] == '1') { echo 'checked'; } ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="enrolled_in_pmp">Enrolled In PMP</label>
                                            <input type="checkbox" id="enrolled_in_pmp" name="enrolled_in_pmp" value="1" <?php if(isset($cur_detail['enrolled_in_pmp']) && $cur_detail['enrolled_in_pmp'] == '1') { echo 'checked'; } ?>>
                                        </div>
                                    </div>

                                <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <h3><u>Licensing Notes</u></h3>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                   <label for="followup_type" class="control-label">Followup Typ</label>
                                      
                                               <select name="followup_type" class="form-control" id="followup_type">
                                                <?php
                                                $sql = "SELECT id, name FROM me_followup_type where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No Followup Type found</option>';
                                                }
                                                ?>
                                            </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                   <label for="note_date" class="control-label">Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="note_date" data-is_validate="1" id="note_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="note" class="control-label">Note</label>
                                    <div class="form-group">
                                        <input type="text"  name="note" data-is_validate="1" id="note"  class="form-control" placeholder="Note" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                   <label for="note_issue_date" class="control-label">Issue Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="note_issue_date" data-is_validate="1" id="note_issue_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                   <label for="note_exp_date" class="control-label">Exp Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="note_exp_date" data-is_validate="1" id="note_exp_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="note_last_updated" class="control-label"> Last Updated</label>
                                    <div class="form-group">
                                        <input type="text"  name="note_last_updated" data-is_validate="1" id="note_last_updated"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                               
                              </div>
                                <div class="col-sm-12 text-center">
                                   <a href="index.php?pid=license_state_list" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+Add Item</a>
                                    <!-- <button type="submit" id="ce_tracking_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button> -->
                                </div>
                          

                                   <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label><u>License Supporting Documentation</u></label>
                                           
                                        </div>
                                    </div>
                               
                                <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                   <label for="document_type" class="control-label">Document Typ</label>
                                      
                                    <!-- <input type="text" maxlength="100" name="state" id="state"  class="form-control" placeholder="State" value="" > -->
                                    <select name="document_type" class="form-control" id="document_type">
                                                <!-- <option>Select Document Type</option> -->
                                                <?php
                                                // Connect to your database (replace dbname, username, password, and host with your actual database credentials)
                                               

                                                // SQL query to fetch provider names
                                                $sql = "SELECT id, name FROM me_license_document_type where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                // Check if records were returned
                                                if ($result->num_rows > 0) {
                                                    // Output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No Document Type found</option>';
                                                }

                                                // Close database connection
                                                // $conn->close();
                                                ?>
                                            </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                   <label for="doc_date" class="control-label">Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="doc_date" data-is_validate="1" id="doc_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['doc_date'])){ echo $cur_detail['doc_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="receipt_amount" class="control-label">Receipt Amoun</label>
                                    <div class="form-group">
                                        <input type="text"  name="receipt_amount" data-is_validate="1" id="receipt_amount"  class="form-control" placeholder="Receipt Amount" value="<?php if(isset($cur_detail['receipt_amount'])){ echo $cur_detail['receipt_amount'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                
                                <div class="col-sm-6 col-md-4">
                                   <label for="doc_exp_date" class="control-label">Exp Date</label>
                                    <div class="form-group">
                                        <input type="text"  name="doc_exp_date" data-is_validate="1" id="doc_exp_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['doc_exp_date'])){ echo $cur_detail['doc_exp_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                             
                                <div class="col-sm-6 col-md-4">
                                   <label for="doc_last_updated" class="control-label"> Last Updated</label>
                                    <div class="form-group">
                                        <input type="text"  name="doc_last_updated" data-is_validate="1" id="doc_last_updated"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['doc_last_updated'])){ echo $cur_detail['doc_last_updated'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                               
                            </div>
                                <div class="col-sm-12 text-center">
                                   <a href="index.php?pid=license_state_list" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+Add Item</a>
                                    <!-- <button type="submit" id="ce_tracking_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button> -->
                                </div>
                            </div>
                            
                                <div class="col-sm-12 text-center">
                                   <a href="index.php?pid=license_state_list" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Back</a>
                                    <button type="submit" id="statelicenses_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button>
                                </div>
                            </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
                          
        </div>        

    </div>
</section>
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var primaryCheck = document.getElementById('primary_check');

    primaryCheck.addEventListener('change', function() {
        if (primaryCheck.checked) {
            primaryCheck.value = '1';
        } else {
            primaryCheck.value = '0';
        }
    });

    // Initialize the checkbox value on page load
    if (primaryCheck.checked) {
        primaryCheck.value = '1';
    } else {
        primaryCheck.value = '0';
    }
});
<script> -->