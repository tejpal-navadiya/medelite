<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
?>
<section class="content">
    <div class="container-fluid">
        <style>
            #user_roleTable tr th:nth-child(5),#user_roleTable tr td:nth-child(5)
            {
                min-width: 220px!important;
            }
            #user_roleTable tr th:nth-child(6),#user_roleTable tr td:nth-child(6)
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
                                <h3 class="card-title">Manage Roles</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="index.php?pid=add_user_role" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add User Role</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php include "message.php"; ?>
                    <table id="user_roleTable" class="data-table table table-hover" style="border:1px solid grey;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Roles </th>
                                <!-- <th>CE Completion Status</th>
                                <th>License Start Date</th>
                                <th>License End Date</th>
                                <th>First Time Renewal</th>
                                <th>CE Broker Required</th>
                                <th>Issue Date</th>
                                <th>Expiration Date </th>
                                <th>Last Update</th> -->
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