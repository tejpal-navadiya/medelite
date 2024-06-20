<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("config.php");

?>
<section class="content">
    <div class="container-fluid">
        <style>
            #statlicensesTable tr th:nth-child(5),#statlicensesTable tr td:nth-child(5)
            {
                min-width: 220px!important;
            }
            #statlicensesTable tr th:nth-child(6),#statlicensesTable tr td:nth-child(6)
            {
                max-width: 180px!important;
            }
            
        </style>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Licensure List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="index.php?pid=add_license_state_list" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New License(S)</a>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="col-sm-6 col-md-4">
                                 <div class="form-group">
                                                <select name="provider_id" class="form-control" id="provider_id">
                                                    <option value="">Licensure Provider Name</option>
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
                                <!-- <div class="col-sm-6 col-md-3"> -->
                                       
                                <!-- <div class="col-sm-6 col-md-3"> -->
                                <div class="form-group">
                                    <h4>State License For <span id="selected_provider_name">"Provider Name"</span></h4>
                                </div>
                                    <!-- </div> -->
                                <!-- </div> -->
                        <?php include "message.php"; ?>
                        <table id="statlicensesTable" class="data-table table table-hover" style="border:1px solid grey;">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_state_licenses" name="select_all_state_licenses" />
                                <th>State</th>
                                <th>License Number</th>
                                <th>License Status</th>
                                <th>Renewal Service</th>
                                <th>Issue Date</th>
                                <th>Expiration Date </th>
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                        
                    </table>
                    </div>

                </div>

            </div>

        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        <div class="form-group">
                    </div>
                    <div class="card-body">
                            <div>
                                <h4>DEA/State Controlled Substances Licenses</h4>
                            
                            </div>
                            <?php include "message.php"; ?>
                            <table id="cetrackingTable" class="data-table table table-hover" style="border:1px solid grey;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all_ce_tracking" name="select_all_ce_tracking" />
                                        <th>State </th>
                                        <th>License Number</th>
                                        <th>License Status</th>
                                        <th>Renewal Service</th>
                                        <th>Issue Date</th>
                                        <th>Expiration Date </th>
                                        <th>Last Update</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td></td>
                                        <td class="text-center"><img class="custom-table-round-img" src="assets/img/user1.jpg" /> John Deo</td>
                                        <td>1234567890</td>
                                        <td>test@test.com</td>
                                        <td>Testing Address</td>
                                        <td>www.test.com</td>
                                        <td>1234567890</td>
                                        <td>test@test.com</td>
                                        <td>Testing Address</td>
                                        <td>www.test.com</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-sm"><i class="fas fa-edit"></i></button>
                                                
                                                <button class="btn btn-default btn-sm"><i class="fas fa-phone"></i></button>
                                                <button class="btn btn-default btn-sm"><i class="fas fa-envelope"></i></button>
                                                
                                            </div>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td></td>
                                        <td class="text-center"><img class="custom-table-round-img" src="assets/img/user1.jpg" /> John Deo</td>
                                        <td>1234567890</td>
                                        <td>test@test.com</td>
                                        <td>Testing Address</td>
                                        <td>www.test.com</td>
                                        <td>1234567890</td>
                                        <td>test@test.com</td>
                                        <td>Testing Address</td>
                                        <td>www.test.com</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-sm"><i class="fas fa-edit"></i></button>
                                                
                                                <button class="btn btn-default btn-sm"><i class="fas fa-phone"></i></button>
                                                <button class="btn btn-default btn-sm"><i class="fas fa-envelope"></i></button>
                                                
                                            </div>
                                        </td>
                                    </tr>     -->
                                </tbody>
                                
                            </table>
                            </div>

                </div>

            </div>

        </div>
        

    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#provider_id').change(function() {
        var selectedProviderName = $('#provider_id option:selected').text();
        $('#selected_provider_name').text(selectedProviderName);
    });
});
</script>


<!--
<script>
$(document).ready(function() {
    $('#provider_id').change(function() {
        var providerId = $(this).val();
        $.ajax({
            url: 'filter_licenses_data.php',
            method: 'GET',
            data: { provider_id: providerId },
            dataType: 'json',
            success: function(response) {
                // Update the table with filtered data
                updateTable(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    function updateTable(data) {
        // Clear existing table rows
        $('#statlicensesTable tbody').empty();

        // Add new rows with filtered data
        $.each(data, function(index, item) {
            console.log(item);
    var btnGroup = '<div class="btn-group">' +
        '<a href="index.php?pid=add_license_state_list&id=' + item.id + '" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>' +
        '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-sync-alt"></i></button>' + // Load button with icon
        '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-bell"></i></button>' + // Notification button
        '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-times"></i></button>' + // Cross button
        '<button type="button" onclick="delete_state_licensesbtn(' + item.id + ')" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash-alt"></i></button>' +
        '</div>';

    $('#statlicensesTable tbody').append('<tr><td>' + item.id + '</td><td>' + item.state_name + '</td><td>' + item.license_number + '</td><td>' + item.created_at + '</td><td>' + item.renewal_id_pin + '</td><td>' + item.issue_date + '</td><td>' + item.exp_date + '</td><td>' + item.last_updated + '</td><td>' + btnGroup + '</td></tr>');
});

    }
});
</script>-->

