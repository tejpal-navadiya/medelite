
<section class="content">
    <div class="container-fluid">
        <style>
            #directoryTable tr th:nth-child(2),#directoryTable tr td:nth-child(2)
            {
                min-width: 220px!important;
            }
            #directoryTable tr th:nth-child(5),#directoryTable tr td:nth-child(5)
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
                                <h3 class="card-title">Directories List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="index.php?pid=add_directory" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Directory</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php include "message.php"; ?>
                    <table id="directoryTable" class="data-table table table-hover" style="border:1px solid grey;">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_directorys" name="select_all_directorys" />
                                <th>State Medical Board Name</th>
                                <th>Phone</th>
                                <th>Board Email(Licensing)</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td class="text-center"><img class="custom-table-round-img" src="assets/img/user1.jpg" /> John Deo</td>
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