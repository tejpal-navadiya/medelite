
<section class="content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Institution Type List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="index.php?pid=add_institution_type" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Institution Type</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php include "message.php"; ?>
                    <table id="institution_typeTable" class="data-table table table-hover" style="border:1px solid grey;">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_institution_type" name="select_all_institution_type" />
                                 <!-- <td class="text-center"><img class="custom-table-round-img" src="assets/img/user1.jpg" /></td> -->
                                <th> Name</th>
                                <!-- <th>Compliance</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td class="text-center"><img class="custom-table-round-img" src="assets/img/user1.jpg" /> John Deo<span style="display: block; margin-left: 65px;margin-top: -12px;" class="text-danger text-xs">Family Medicines</span></td>
                                <td>Internal Medicine</td>
                                <td>MD</td>
                                <td><span class="text-danger">1 alert <i class="fas fa-exclamation-triangle"></i></span></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fas fa-file"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fas fa-phone"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fas fa-envelope"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fas fa-hand-holding-usd"></i></button>
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