<?php
  $title="User Account Profile";$active_menu="organisation_profile";
  include "header.php";  include "sidebar.php"; 
  // print_r($_SESSION);
  if(isset($_SESSION['me_role']) && $_SESSION['me_role']=="master_admin")
  {
    ?><script> window.location.href='org-profile.php';</script><?php
  }
?>
<main class="main">

    <section class="section profile">
    <div class="row">
        <div class="col-xl-3">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <input type="hidden" id="id" value="<?php echo $_SESSION['me_user_id']; ?>"/>
              <img src="assets/img/avatar5.png" alt="Profile" class="rounded-circle">
              <h2 id="label_name2"></h2>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>


            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link edit-profile-btn" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link change-pass-btn" data-bs-toggle="tab" data-bs-target="#password-edit">Change Password</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <!-- Profile Details -->
                              
                                <h5 class="card-title">Profile Details</h5>
                                <table class="profile_details_box">
                                    <tr class="de_bg">
                                        <td>Name :</td>
                                        <td id="label_name"></td>
                                    </tr>
                                    <tr>
                                        <td>Email Address :</td>
                                        <td id="label_email"></td>
                                    </tr>
                                    <tr class="de_bg">
                                        <td>Phone :</td>
                                        <td id="label_phone_number"></td>
                                    </tr>
                                    <tr>
                                        <td>Address :</td>
                                        <td id="label_address"></td>
                                    </tr>
                                </table>
                            </div>
                                <!-- Your profile details table -->
                            </div>
                        </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form (Initially hidden) -->
                                <form id="UpdateForm" class="row g-3" method="POST" novalidate="novalidate" style="padding: 15px;" enctype="multipart/form-data">
                                <div class="row">
                                        <div class="col-md-6 mb-3">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input name="name" type="text" class="form-control" id="name" value="">
                                        </div>

                                        <!-- <div class="col-md-6 mb-3">
                                        <label for="lastname" class="col-form-label">Last Name <span class="text-danger">*</span></label>     
                                        <input name="lastname" type="text" class="form-control" id="lastname" value="Anderson">
                                        </div> -->

                                        <div class="col-md-6 mb-3" style="display:none;">
                                        <label for="Email" class="col-form-label">Email Address <span class="text-danger">*</span></label>
                                        <input name="email" type="email" class="form-control" id="email" value="">
                                        </div>

                                        <!-- <div class="col-md-6 mb-3">
                                        <label for="phone_number" class="col-form-label">Phone <span class="text-danger">*</span></label>            
                                        <input name="phone_number" type="tel" class="form-control" id="phone_number" value="">
                                        </div> -->
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number" class="control-label">Phone</label>
                                            <div class="form-group">
                                                <input type="tel" name="phone_number" id="phone_number"  class="form-control " placeholder="Phone" value=""  >
                                                <span class="help" id="msg2"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                        <label for="address" class="col-form-label">Address</label>                   
                                        <input name="address" type="text" class="form-control" id="address" value="">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                        <label for="Phone" class="col-form-label">State </label>
                                        <select class="form-select" id="state" name="state">
                                            <option  value="">Select State</option>
                                        </select>
                                        </div>

                                        <!-- <div class="col-md-6 mb-3">
                                        <label for="Phone" class="col-form-label">City </label>
                                        <select class="form-select" id="city">
                                            <option  value="">Select City</option>
                                            
                                        </select>
                                        </div> -->

                                        
                                        <div class="col-md-6 mb-3">
                                        <label for="Phone" class="col-form-label">Zip Code </label>            
                                        <input name="zip" type="text" class="form-control" id="zip" value="" placeholder="Zip Code">
                                        </div>

                                    </div>

                                    <div class="text-center">
                                        <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary" type="submit" id="SubmitBtn">Save</button>
                                        <!-- <button class="cance_btn" type="reset">Cancel</button> -->
                                    </div>
                                                    <!-- Your edit profile form fields -->
                                </form>
                            </div>

                            <div class="tab-pane fade password-edit pt-3" id="password-edit">
                                <!-- Change Password Form -->
                                <form id="UpdatepassForm" class="row g-3" novalidate="novalidate" style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <label for="current_password" class="col-form-label">Current Password <span class="text-danger">*</span></label>
                                    <input name="current_password" type="password" class="form-control" id="current_password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <label for="new_password" class="col-form-label">New Password  <span class="text-danger">*</span></label>
                                    <input name="new_password" type="password" class="form-control" id="new_password">
                                    </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                    <label for="confirm_password" class="col-form-label">Confirm Password  <span class="text-danger">*</span></label>            
                                    <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                                    </div>

                                

                                <div class="text-center">
                                    <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary" type="submit" id="SubmitpassBtn">Save</button>
                                    <!-- <button class="cance_btn" type="reset">Cancel</button> -->
                                </div>
                                </form><!-- End Profile Edit Form -->
                                <!-- Your change password form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<script src="assets/js/org-profile.js?v=<?php echo $php_version;?>"></script>

<!-- Include JavaScript library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Toggle Edit Profile Form
        $('.edit-profile-btn').click(function() {
            $('.profile-edit').toggleClass('show');
        });

         // Toggle Edit Profile Form
         $('.change-pass-btn').click(function() {
            $('.password-edit').toggleClass('show');
        });
    });
</script>
