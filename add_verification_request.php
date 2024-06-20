
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("config.php");

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .icon-wrapper {
  position: relative;
}

.icon-wrapper .form-control {
  padding-left: 50px; /* Adjust based on the width of the icon */
}

.icon-wrapper .icon {
  position: absolute;
  top: 50%;
  left: 40px; /* Adjust based on your desired padding */
  transform: translateY(-50%);
  pointer-events: none; /* Ensures the icon doesn't block text box interactions */
  color: #999; /* Optional: Adjust icon color */
}
.fa-stack {
      font-size: 0.8em; /* Adjust size as needed */
    }
</style>



<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Create Verification Request</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                            </div>        

                        </div>
                    </div>
                <!-- provider dorp down -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <label for="firstname" class="control-label">Practice /Employer /Facility Type<span class="text-danger">*</span> </label> -->
                                                    <div class="form-group">
                                                    <select name="provider_name" class="form-control" id="provider_name">
                                                                    <option value="">Select Provider:</option>
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
                                            <div class="col-sm-6">
                                                <h3 class="card-title">Date Created: MM/DD/YYYY</h3>
                                            </div>
                                        </div>
                                </div>
                        </div>
                  <!-- end -->
                    <div class="card-body">
                            <!-- <div class="col-md-6 text-right"> -->
                            <div class="col-sm-4 col-md-3 text-left"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>

                            <!-- </div> -->
                        <form class="form-horizontal" id="directory_form"  method="post" >
                        <?php if(isset($_REQUEST['id'])){echo "<input type='hidden' id='id' value='".$_REQUEST['id']."'>";}?>
                            <div class="row">
                               
                                
                                
                                <div class="col-sm-4">
                                    <label for="firstname" class="control-label">Verification request type</label>
                                    <div class="form-group">
                                        <!-- <input type="text" name="board_name" class="form-control " placeholder="Verification request type" value=""  > -->
                                        <select name="request_type" id="request_type<?php echo $cnt; ?>" class="form-control" >

                                            <option value="">Select Type</option>

                                            <?php
                                                $sql = "SELECT id, name FROM me_request_type where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No found</option>';
                                                }
                                                
                                            ?>

                                            </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <label for="firstname" class="control-label">Form</label>
                                    <div class="form-group icon-wrapper">
                                    <input type="text" name="Form"  class="form-control">
                                    <span class="fa-stack icon">
                                        <i class="fas fa-folder fa-stack-2x"></i>
                                        <i class="fas fa-search fa-stack-1x fa-inverse" style="margin-left: -0.2em; margin-top: 0.1em;"></i>
                                    </span>
                                    <szpan class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label for="firstname" class="control-label">Link</label>
                                    <div class="form-group icon-wrapper">
                                        <input type="text" name="Link"  class="form-control">
                                        <i class="fas fa-link icon"></i> <!-- Example icon, use FontAwesome or any other icon library -->
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <label for="firstname" class="control-label">Email</label>
                                    <div class="form-group icon-wrapper">
                                        <input type="text" name="Email" class="form-control">
                                        <i class="fas fa-envelope  icon"></i> <!-- Example icon, use FontAwesome or any other icon library -->
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label for="firstname" class="control-label">Fee</label>
                                    <div class="form-group icon-wrapper">
                                        <input type="text" name="Fee" class="form-control">
                                        <i class="fas fa-dollar-sign  icon"></i> <!-- Example icon, use FontAwesome or any other icon library -->
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="firstname" class="control-label">Upload documents</label>
                                    <div class="form-group icon-wrapper">
                                        <input type="text" name="attention_to"  class="form-control">
                                        <i class="fas fa-upload  icon"></i> <!-- Example icon, use FontAwesome or any other icon library -->
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                <h3 class="card-title">Date Completed:MM/DD/YYYY</h3>
                            </div>
                               
                            
                                
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Method Of Request</label>
                                    <div class="form-group">
                                        <!-- <input type="email" name="board_email" id="board_email"  class="form-control " placeholder="Method Of Request" value=""  > -->
                                        <select name="request_method" id="request_method<?php echo $cnt; ?>" class="form-control" >

                                            <option value="">Select Method</option>

                                            <?php
                                                $sql = "SELECT id, name FROM me_method_of_request where is_deleted='0'";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No found</option>';
                                                }
                                                    
                                            ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="board_email_licence" class="control-label">Note</label>
                                    <div class="form-group">
                                    <textarea name="board_email_licence" id="board_email_licence" class="form-control" rows="5" placeholder="Licensing Email Address"></textarea>
                                    <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Select State</label>
                                    <div class="form-group">
                                        
                                    <select name="state" class="form-control" id="state">
                                                    <option value="">Select State:</option>
                                                    <?php
                                                    $sql = "SELECT id, name FROM me_states where is_deleted='0'";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">No providers found</option>';
                                                    }
                                                    ?>
                                                </select>
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