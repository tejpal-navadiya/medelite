<?php
  $title="Organization Profile";$active_menu="organisation_profile";
  include "header.php";  include "sidebar.php"; 
  // print_r($_SESSION);
//   if(isset($_SESSION['me_role']) && $_SESSION['me_role']!="master_admin")
//   {
//     ?><script> window.location.href='user-profile.php';</script><?php
//   }
?>

  <main id="main" class="main">

    <div class="pagetitle align-items-center justify-content-between">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Organization</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-3">

          <!-- <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <input type="hidden" id="id" value="<?php echo $_SESSION['me_user_id']; ?>"/>
              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2 id="label_name2"></h2>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div> -->

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <input type="hidden" id="id" value="<?php echo $_SESSION['me_user_id']; ?>"/>
              <img id="profile_page_user_image" style="width:120px;height:120px;" src="<?php if(isset($_SESSION['me_profile_img'])){echo $_SESSION['me_profile_img'];}else{echo "assets/img/profile-img.jpg";}?>" alt="Profile" class="rounded-circle">
              <h2 id="label_name2"></h2>
              <form id="profile_picture_form" novalidate="novalidate">
                <input type="file" id="profile_picture_image" name="filename" onchange="previewUserImage()"   accept="image/*"  style="display:none;">
                <div class="row">
                  <div class="col-md-6">
                    <button class="save_btn"  type="submit" id="profile_picture_submit" style="display:none;padding: 8px 15px;">Save</button>
                  </div>
                  <div class="col-md-6">
                    <button class="cance_btn" type="button" id="profile_picture_cancel" style="display:none;padding: 8px 15px;">Cancel</button>
                  </div>
                </div>
              </form>
              <button class="save_btn" type="button" id="init_upload_image" onclick="InitUploadProfileImg(this);">Upload</button>
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
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

              </ul>

              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
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

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <!-- Profile Edit Form -->
                <form id="UpdateForm" class="row g-3" novalidate="novalidate" style="padding: 15px;">
                  <!-- <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="assets/img/profile-img.jpg" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div> -->

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

                    <div class="col-md-6 mb-3">
                      <label for="phone_number" class="col-form-label">Phone <span class="text-danger">*</span></label>            
                      <input name="phone_number" type="tel" class="form-control" id="phone_number" value="">
                    </div>

                    <div class="col-md-12 mb-3">
                      <label for="address" class="col-form-label">Address</label>                   
                      <input name="address" type="text" class="form-control" id="address" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="Phone" class="col-form-label">State </label>
                      <select class="form-select" id="state" name="state">
                        <option  value="">Select State</option>
                      </select>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="Phone" class="col-form-label">City </label>
                      <select class="form-select" id="city" id="city">
                        <option  value="">Select City</option>
                        
                      </select>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                      <label for="Phone" class="col-form-label">Zip Code </label>            
                      <input name="zip_code" type="text" class="form-control" id="zip_code" value="" placeholder="Zip Code">
                    </div>

                  </div>

                  <div class="text-center">
                    <button class="save_btn" type="submit" id="SubmitBtn">Save</button>
                    <!-- <button class="cance_btn" type="reset">Cancel</button> -->
                  </div>
                </form><!-- End Profile Edit Form -->
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include "footer.php"; ?>
  <script src="assets/js/org-profile.js?v=<?php echo $php_version;?>"></script>
  <script src="assets/js/profile_picture.js?v=<?php echo $php_version;?>"></script>