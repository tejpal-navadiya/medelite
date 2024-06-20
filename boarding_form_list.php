<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('config.php'); // Ensure your database connection is here
$additional_condition="";
if(isset($is_provider_user) && $is_provider_user==1)
{
     $additional_condition=" AND me_onboarding_application.provider_name='".$_SESSION['me_user_id']."' ";
}
// Fetch data from the database
$query = "SELECT 
            me_onboarding_application.*, 
            me_provider.provider_name AS provider_name 
          FROM 
            me_onboarding_application 
          LEFT JOIN 
            me_provider 
          ON 
            me_onboarding_application.provider_name = me_provider.id WHERE me_onboarding_application.is_deleted='0' AND me_onboarding_application.form_id > '0' ".$additional_condition;
$result = mysqli_query($conn, $query);
$total_forms=mysqli_num_rows($result);
if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}
$statusMapping = [
    '0' => 'Submitted',
    '1' => 'Draft',
    '2' => 'Unsubmitted'
];

$apptype = [
    '0' => 'Submitted',
    '1' => 'Draft',
    '2' => 'Unsubmitted'
];
?>
<section class="content">
    <div class="container-fluid">

        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">On Boarding Forms List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if(isset($is_provider_user) && $is_provider_user==1){
                                    // echo $total_forms;
                                    if($MAX_ADD_FORM_LIMIT <= $total_forms)
                                    {
                                        ?>
                                        <button onclick="FormLimitExhaust();" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Form</button>
                                        <?php
                                    }else
                                    {
                                    ?>
                                    
                                <a href="index.php?pid=add_boarding_form" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Form</a>
                                <?php } }?>
                                <!-- <a href="index.php?pid=add_boarding_app_form" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Onboarding App Form</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php include "message.php"; ?>
                        <div class="table-responsive">
                        <div class="row">
                            <?php if(isset($is_provider_user) && $is_provider_user==1)
                            {}else{
                            ?>
                                <div class="col-sm-2">
                                    <!-- <label class="control-label">Provider Title</label> -->
                                    <div class="form-group">
                                        <!-- <input type="text" maxlength="100" name="provider_title" id="provider_title"  class="form-control" placeholder="Provider Title" value="" > -->
                                        <select maxlength="100" name="provider_title" id="provider_title" class="form-control select2" placeholder="Provider Title">
                                            <option value="">Organization</option>
                                            <?php 
                                                for ($i=0; $i < count($provider_titles_list); $i++) 
                                                { 
                                                    echo "<option value='".($i+1)."'>".$provider_titles_list[$i]."</option>";
                                                }
                                            ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <!-- <label class="control-label">Second Dropdown</label> -->
                                    <div class="form-group">
                                        <!-- <input type="text" maxlength="100" name="second_dropdown" id="second_dropdown"  class="form-control" placeholder="Second Dropdown" value="" > -->
                                        <select maxlength="100" name="second_dropdown" id="second_dropdown" class="form-control select2" placeholder="Second Dropdown">
                                            <option value="">Select Option</option>
                                            <?php 
                                                for ($j=0; $j < count($second_dropdown_list); $j++) 
                                                { 
                                                    echo "<option value='".($j+1)."'>".$second_dropdown_list[$j]."</option>";
                                                }
                                            ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                           
                            <table id="example12" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Application Type</th>
                                    <th>Provider Name</th>
                                    <th>Organisation</th>
                                    <th>Submission Date</th>
                                    <th>Application Status</th>
                                    <th>Followup Time</th>
                                    <th>Followup Date</th>
                                    <th>Application Method</th>
                                    <th>Specialist Reviewed</th>
                                    <th>Website/contact info</th>
                                    <?php if(isset($is_provider_user) && $is_provider_user==1)
                                    {}else{
                                    ?>
                                    <th>Application Id</th>
                                    <th>User Id</th>
                                    <th>Password</th>
                                    <th>Note</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php 
                                    // Loop through each record and create table rows
                                    while($row = mysqli_fetch_assoc($result)): 
                                        // Convert the status ID to its name using the mapping array
                                        $statusName = isset($statusMapping[$row['application_status']]) ? $statusMapping[$row['application_status']] : 'Unknown';
                                        $apptypename = isset($apptype[$row['application_type']]) ? $apptype[$row['application_type']] : 'Unknown';

                                    ?>
                                        <tr data-application-id="<?php echo $row['application_id']; ?>" data-provider-name="<?php echo htmlspecialchars($row['provider_name']); ?>" data-organization="<?php echo htmlspecialchars($row['organization']); ?>" data-submission-date="<?php echo htmlspecialchars($row['submission_date']); ?>">
                                                    <td>
                                                        <?php
                                                        if(isset($is_provider_user) && $is_provider_user==1)
                                                        {
                                                        ?>
                                                        <div class="btn-group">
                                                            <a href="index.php?pid=add_boarding_form&id=<?php echo $row['form_id']; ?>"class="btn btn-default btn-sm edit-btn"><i class="fas fa-edit"></i></a>

                                                            <!-- <button class="btn btn-default btn-sm edit-btn" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button> -->
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="btn-group">
                                                            <a href="index.php?pid=admin_edit_boarding_app_form&id=<?php echo $row['form_id']; ?>"class="btn btn-default btn-sm edit-btn"><i class="fas fa-edit"></i></a>
                                                            <a href="index.php?pid=add_boarding_app_form&id=<?php echo $row['id']; ?>"class="btn btn-default btn-sm edit-btn"><i class="fas fa-edit"></i></a>
                                                      
                                                        </div>
                                                        <?php }?>
                                                    </td>
                                                    <!-- Add other table cells similarly -->
                                                <!-- </tr> -->

                                            <td><?php echo htmlspecialchars($apptypename); ?></td>

                                            <!-- <td><?php echo htmlspecialchars($row['application_type']); ?></td> -->
                                            <td><?php echo htmlspecialchars($row['provider_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['organization']); ?></td>
                                            <td><?php echo htmlspecialchars($row['submission_date']); ?></td>
                                            <td><a href="#"><?php echo htmlspecialchars($statusName); ?></a></td>
                                            <!-- <td><a href="#"><?php echo htmlspecialchars($row['application_status']); ?></a></td> -->
                                            <td><?php echo htmlspecialchars($row['follow_up_time']); ?></td>
                                            <td><?php echo htmlspecialchars($row['follow_up_date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['application_method']); ?></td>
                                            <td><?php echo htmlspecialchars($row['specialist_reviewed']); ?></td>
                                            <td><?php echo htmlspecialchars($row['web_contact_info']); ?></td>
                                            <!-- <td><?php echo htmlspecialchars($row['application_id']); ?></td> -->
                                            <?php if(isset($is_provider_user) && $is_provider_user==1)
                                            {}else{
                                            ?>                    
                                            <td><input type="text" name="application_id" class="form-control" value="<?php echo htmlspecialchars($row['application_id']); ?>"></td>

                                            <td><input type="text" name="user_id" class="form-control" value="<?php echo htmlspecialchars($row['user_id']); ?>"></td>
                                            <td><input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($row['password']); ?>"></td>
                                            <td><a href="#">Add note</a></td>
                                            <?php } ?>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>

<!-- Edit Modal -->
<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="editApplicationId" name="application_id">
          <!-- Add your form fields here --
          <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Application Type<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                    <select name="application_type" class="form-control select2" data-is_validate="1" id="application_type<?php echo $cnt; ?>">
                                        <option value="">select status</option>
                                        <option value="1" <?php echo (isset($fetch['status']) && $fetch['status'] == "1") ? 'selected' : ''; ?>>Draft</option>
                                        <option value="0" <?php echo (isset($fetch['status']) && $fetch['status'] == "0") ? 'selected' : ''; ?>>Submited</option>
                                        <option value="2" <?php echo (isset($fetch['status']) && $fetch['status'] == "2") ? 'selected' : ''; ?>>UnSubmited</option>
                                        
                                    </select>
                                            
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                 <div class="form-group">
                                 <label for="firstname" class="control-label">Provider Name<span class="text-danger">*</span></label>

                                                <select name="provider_name" class="form-control" id="provider_name">
                                                    <option value="">Provider Name</option>
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
                                        <label for="firstname" class="control-label">Organization</label>
                                        <div class="form-group">
                                            <input type="text" name="organization" id="organization"  class="form-control " placeholder="Organization" value=""  >
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                    <label for="submission_date" class="control-label">Submission Date</label>
                                        <div class="form-group">
                                            <input type="text"  name="submission_date[]" data-is_validate="1" id="submission_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['submission_date'])){ echo $cur_detail['submission_date'];} ?>">
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Status</label>
                                    <div class="form-group">
                                        <select name="application_status" class="form-control select2" data-is_validate="1" id="application_status<?php echo $cnt; ?>">
                                            <option value="">select status</option>
                                            <option value="1" <?php echo (isset($fetch['status']) && $fetch['status'] == "1") ? 'selected' : ''; ?>>Draft</option>
                                            <option value="0" <?php echo (isset($fetch['status']) && $fetch['status'] == "0") ? 'selected' : ''; ?>>Submited</option>
                                            <option value="2" <?php echo (isset($fetch['status']) && $fetch['status'] == "2") ? 'selected' : ''; ?>>UnSubmited</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="followup_time" class="control-label">Followup Time  </label>
                                        <div class="form-group">
                                            <input type="time"  name="followup_time" data-is_validate="1" id="followup_time<?php echo $cnt; ?>"  class="form-control" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['followup_time'])){ echo $cur_detail['followup_time'];} ?>">
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="followup_date" class="control-label">Followup Date </label>
                                        <div class="form-group">
                                            <input type="text"  name="followup_date[]" data-is_validate="1" id="followup_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['followup_date'])){ echo $cur_detail['followup_date'];} ?>">
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                    <label for="application_method" class="control-label">Application Method</label>
                                        <div class="form-group">
                                            <input type="text"  name="application_method" data-is_validate="1" id="application_method<?php echo $cnt; ?>"  class="form-control" placeholder="application method" value="<?php if(isset($cur_detail['application_method'])){ echo $cur_detail['application_method'];} ?>">
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4">
                                    <label for="specialist_reviewed" class="control-label">Specialist Reviewed</label>
                                        <div class="form-group">
                                            <input type="text"  name="specialist_reviewed" data-is_validate="1" id="specialist_reviewed<?php echo $cnt; ?>"  class="form-control" placeholder="specialist reviewed" value="<?php if(isset($cur_detail['specialist_reviewed'])){ echo $cur_detail['specialist_reviewed'];} ?>">
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                    <label for="web_contact_info" class="control-label">Website Contact Info</label>
                                        <div class="form-group">
                                            <input type="text"  name="web_contact_info" data-is_validate="1" id="web_contact_info<?php echo $cnt; ?>"  class="form-control" placeholder="Website Contact Info" value="<?php if(isset($cur_detail['web_contact_info'])){ echo $cur_detail['web_contact_info'];} ?>">
                                            <span class="help" id="msg2"></span>
                                        </div>
                                    </div>
          <!-- Add other fields similarly --
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div> -->

        

    </div>
</section>
<!-- <script>
$(document).ready(function(){
    $('.edit-btn').on('click', function() {
        var row = $(this).closest('tr');
        $('#editApplicationId').val(row.data('application-id'));
        $('#editProviderName').val(row.data('provider-name'));
        $('#editOrganization').val(row.data('organization'));
        $('#editSubmissionDate').val(row.data('submission-date'));
        // Populate other fields similarly
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'update_application.php', // Backend script to handle the update
            data: $(this).serialize(),
            success: function(response) {
                // Handle success, e.g., show a success message, refresh the table, etc.
                $('#editModal').modal('hide');
            },
            error: function(error) {
                // Handle error, e.g., show an error message
                console.error(error);
            }
        });
    });
});
</script> -->
