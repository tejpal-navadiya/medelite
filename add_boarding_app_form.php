<?php
require_once("config.php");

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$OnBordingDetails = [];

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM me_onboarding_application WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $OnBordingDetails = $result->fetch_assoc();
    }
    $stmt->close();
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php echo $id ? "Update" : "Add"; ?> Onboarding Application Form</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" id="add_boarding_app_form" method="post" action="save_onboarding_application.php">
                            <?php if($id) { echo "<input type='hidden' name='id' id='id' value='$id'>"; } ?>
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <label for="application_type" class="control-label">Application Type<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <select name="application_type" class="form-control select2" data-is_validate="1" id="application_type">
                                            <option value="">select status</option>
                                            <option value="1" <?php echo (isset($OnBordingDetails['application_type']) && $OnBordingDetails['application_type'] == "1") ? 'selected' : ''; ?>>Draft</option>
                                            <option value="0" <?php echo (isset($OnBordingDetails['application_type']) && $OnBordingDetails['application_type'] == "0") ? 'selected' : ''; ?>>Submited</option>
                                            <option value="2" <?php echo (isset($OnBordingDetails['application_type']) && $OnBordingDetails['application_type'] == "2") ? 'selected' : ''; ?>>UnSubmited</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-4">
                                    <label for="provider_name" class="control-label">Provider Name<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select name="provider_name" class="form-control" id="provider_name">
                                            <option value="">Provider Name</option>
                                            <?php
                                            $sql = "SELECT id, provider_name FROM me_provider WHERE is_deleted='0'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $selected = (isset($OnBordingDetails['provider_name']) && $OnBordingDetails['provider_name'] == $row['id']) ? 'selected' : '';
                                                    echo "<option value='{$row['id']}' $selected>{$row['provider_name']}</option>";
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
                                    <label for="organization" class="control-label">Organization</label>
                                    <div class="form-group">
                                        <input type="text" name="organization" id="organization" class="form-control" placeholder="Organization" value="<?php echo isset($OnBordingDetails['organization']) ? $OnBordingDetails['organization'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="submission_date" class="control-label">Submission Date</label>
                                    <div class="form-group">
                                        <input type="text" name="submission_date" id="submission_date" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php echo isset($OnBordingDetails['submission_date']) ? $OnBordingDetails['submission_date'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="application_status" class="control-label">Status</label>
                                    <div class="form-group">
                                        <select name="application_status" class="form-control select2" data-is_validate="1" id="application_status"value="<?php echo isset($OnBordingDetails['status']) ? $OnBordingDetails['status'] : ''; ?>">
                                            <option value="">select status</option>
                                            <option value="1" <?php echo (isset($OnBordingDetails['application_status']) && $OnBordingDetails['application_status'] == "1") ? 'selected' : ''; ?>>Draft</option>
                                            <option value="0" <?php echo (isset($OnBordingDetails['application_status']) && $OnBordingDetails['application_status'] == "0") ? 'selected' : ''; ?>>Submited</option>
                                            <option value="2" <?php echo (isset($OnBordingDetails['application_status']) && $OnBordingDetails['application_status'] == "2") ? 'selected' : ''; ?>>UnSubmited</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="follow_up_time" class="control-label">Followup Time</label>
                                    <div class="form-group">
                                        <input type="time" id="follow_up_time" name="follow_up_time" class="form-control" placeholder="Followup Time" value="<?php echo isset($OnBordingDetails['follow_up_time']) ? $OnBordingDetails['follow_up_time'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="follow_up_date" class="control-label">Followup Date</label>
                                    <div class="form-group">
                                        <input type="text" name="follow_up_date" id="follow_up_date" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php echo isset($OnBordingDetails['follow_up_date']) ? $OnBordingDetails['follow_up_date'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="application_method" class="control-label">Application Method</label>
                                    <div class="form-group">
                                        <input type="text" name="application_method" id="application_method" class="form-control" placeholder="Application Method" value="<?php echo isset($OnBordingDetails['application_method']) ? $OnBordingDetails['application_method'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="specialist_reviewed" class="control-label">Specialist Reviewed</label>
                                    <div class="form-group">
                                        <input type="text" name="specialist_reviewed" id="specialist_reviewed" class="form-control" placeholder="Specialist Reviewed" value="<?php echo isset($OnBordingDetails['specialist_reviewed']) ? $OnBordingDetails['specialist_reviewed'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="web_contact_info" class="control-label">Website Contact Info</label>
                                    <div class="form-group">
                                        <input type="text" name="web_contact_info" id="web_contact_info" class="form-control" placeholder="Website Contact Info" value="<?php echo isset($OnBordingDetails['web_contact_info']) ? $OnBordingDetails['web_contact_info'] : ''; ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-12 text-center">
                                    <button type="submit" id="onboarding_app_form_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button>
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
