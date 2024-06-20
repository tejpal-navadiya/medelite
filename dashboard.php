<!-- <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div> -->
<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("config.php");
//  print_r($_SESSION); 




$provider_query = mysqli_query($conn, "SELECT * FROM me_provider  where is_deleted= 0");
    // Fetch total number of providers
$provider_count_query = mysqli_query($conn, "SELECT COUNT(*) as total_providers FROM me_provider");
$provider_count_row = mysqli_fetch_assoc($provider_count_query);
$total_providers = $provider_count_row['total_providers'];

$licence_query = mysqli_query($conn, "SELECT * FROM me_license_type  where is_deleted= 0");


// tottal alerts

$currentDate = date('m/d/y');

$twoMonthsFromNow = date('m/d/y', strtotime('+2 months'));

$currentDateSQL = date('Y-m-d', strtotime($currentDate));
$twoMonthsFromNowSQL = date('Y-m-d', strtotime($twoMonthsFromNow));

$query = "SELECT COUNT(*) as total_alerts 
          FROM me_onboarding_licensure 
          WHERE STR_TO_DATE(expiry_date, '%m/%d/%y') BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 MONTH)";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalAlerts = $row['total_alerts'];
// end

if(isset($is_provider_user) && $is_provider_user==1)
{
    ?>
    <section class="content">
    <div class="container-fluid pb-50">
        <div class="card mh-80-vh br-15p">
            <div class="card-body">
                
              <h3>Welcome,<br><?php echo $_SESSION['me_user_name'];?></h3>
            </div>
        </div>
    </div>
</section>
    <?php
}else
{


?>

<section class="content">
    <div class="container-fluid pb-50">
        <div class="card mh-80-vh br-15p">
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="small-box custom-summary-box bg-purple">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="inner">
                                <p>Total Providers</p>  
                                <h3><?php echo $total_providers; ?></h3>
                            </div>        
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="small-box custom-summary-box bg-danger">
                            <div class="icon isl">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="inner">
                            <p>Total Alerts</p>
                                <!-- <p>Total Expirables</p>   -->
                                <h3><?php echo $totalAlerts; ?></h3>
                            </div>        
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="small-box custom-summary-box bg-warning">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="inner">
                                <p>Pending Task</p>  
                                <h3>0</h3>
                            </div>        
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="small-box custom-summary-box bg-success">
                            <div class="icon isl">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="inner">
                            <p>Upcoming Payments</p>
                                <!-- <p>Total Expirables</p>   -->
                                <h3><?php echo $totalAlerts; ?></h3>
                            </div>        
                        </div>
                    </div>


                    
                    <!-- <div class="col-lg-3 col-md-6">
                        <div class="small-box custom-summary-box bg-success">
                            <div class="icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="inner">
                            <p>Pending Task</p>  
                                <!-- <p>Total Report</p>   -
                                <h3>12345</h3>
                            </div>        
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="small-box custom-summary-box bg-purple">
                            <div class="icon">
                                <i class="fas fa-address-book"></i>
                            </div>
                            <div class="inner">
                            <p>Upcoming Payments</p>  
                                <!-- <p>Total Directory</p>   
                                <h3>12345</h3>
                            </div>        
                        </div>
                    </div>                     -->
                    
                </div>

                <!-- <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-7">
                        <div class="card custom-inner-card">
                            <div class="card-header">Providers</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="custom-dark-back custom-light-clr">Icon</th>
                                                <th class="custom-dark-back custom-light-clr">First Name</th>
                                                <th class="custom-dark-back custom-light-clr">Speciality</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            for ($i=0; $i < 8; $i++) 
                                            { 
                                                    
                                        ?>
                                            <tr>
                                                <td class="text-center"><img class="custom-table-round-img" src="assets/img/user1.jpg" /></td>
                                                <td>John Deo</td>
                                                <td>Developer</td>
                                            </tr>
                                        <?php 
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-5">
                        <div class="card custom-inner-card">
                            <div class="card-header">Expirables Licence</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="custom-dark-back custom-light-clr">Date</th>
                                                <th class="custom-dark-back custom-light-clr">Name</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            for ($i=0; $i < 10; $i++) 
                                            { 
                                                    
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo date('d/m/Y'); ?></td>
                                                <td>John Deo</td>
                                                
                                            </tr>
                                        <?php 
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                        </div>
                    </div>




                </div> -->
               
               
               
                <!-- add by new  -->
                <section class="content">
                    <div class="container-fluid">
                   
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h1 class="card-title">Providers</h1>
                                            </div>
                                            <!-- <div class="col-md-6 text-right">
                                                <a href="index.php?pid=add_provider" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Provider</a>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <?php include "message.php"; ?>
                                    <table id="providerTable" class="data-table table table-hover" style="border: 1px solid grey;">
                                        <thead>
                                            <tr>
                                                <!-- <th><input type="checkbox" id="select_all_providers" name="select_all_providers" /> -->
                                                <th>Icon</th>
                                                <th>Provider Name</th>
                                                <th>Speciality</th>
                                                <th>Licenses</th>
                                                <th>Renewals</th>
                                            
                                                <!-- <th>Compliance</th> -->
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        
                                    </table>
                                    </div>

                                </div>

                            </div>

                        </div>

                 </div>
             </section>
                <!--  end new  -->
                <!-- type -->
                   <!-- add by new  -->
                    <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h1 class="card-title">Expirables Licenses</h1>
                                            </div>
                                            <!-- <div class="col-md-6 text-right">
                                                <a href="index.php?pid=add_provider" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Provider</a>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php include "message.php";  ?>
                                        <div class="col-12 table-responsive">
                                        <table id="licensureTable" class="data-table table table-hover text-nowrap" style="border:1px solid grey;">
                                            <thead>
                                                <tr>
                                                    <!-- <th><input type="checkbox" id="select_all_providers" name="select_all_providers" /> -->
                                                    <th>Licenses Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>

                            </div>

                        </div>

                    </div>

                </div>
            </section>
        </div>
        </div>


        

    </div>
</section>
<?php 
}
?>