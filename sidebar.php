<aside class="main-sidebar" style="">
    <!-- <div class="custom-toggle-sidebar-button-wrapper">
        <a  onclick="ToggleClickById('main-sidebar-toggle-button')" href="#" role="button"><i class="fas fa-bars"></i></a> 
    </div> -->
  <!-- <a href="index.php?pid=home" class="brand-link">
      
      <span class="brand-text font-weight-light" style="font-size:17px;"><?php echo ADMIN_CRM_TITLE; ?></span>
  </a> -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="assets/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
              <a href="#" class="d-block"><?php /*echo $_SESSION['dwc_fullname'];*/ ?><br></a>
          </div>
      </div> -->
    <div class="sidebar" style="margin-top:5px!important;">

      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="assets/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
              <a href="#" class="d-block"><?php /*echo $_SESSION['dwc_fullname'];*/ ?><br></a>
          </div>
      </div> -->
        
        <div class="custom-sidebar-logo">
            <a href="index.php?pid=home"><img src="assets/img/logo2.png" alt="Logo" style="" class="brand-image"  ></a>
        </div>
        <div class="form-inline" style="display:none;">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                  aria-label="Search">
              <div class="input-group-append">
                  <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                  </button>
              </div>
            </div>
        </div>
      
<!-- <li class="nav-item menu-open">
                  <a href="#" class="nav-link active"> -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
              data-accordion="false">
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>     -->
                <?php
                
                if(isset($is_provider_user) && $is_provider_user==1)
                {
                    ?>
                <li class="nav-item">
                    <a href="index.php?pid=home" class="nav-link <?php if(isset($active_menu) && $active_menu=="dashboard"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pid=boarding_form_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="boarding_form"){echo 'active';} ?>">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Onboarding Forms</p>
                    </a>
                </li>
                    <?php
                }else
                {
                ?>
                <li class="nav-item">
                    <a href="index.php?pid=home" class="nav-link <?php if(isset($active_menu) && $active_menu=="dashboard"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pid=provider_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="provider"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Providers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?pid=user_role" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="userrole"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manage Role</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pid=boarding_form_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="boarding_form"){echo 'active';} ?>">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Forms</p>
                    </a>
                </li>    
                <li class="nav-item">
                    <a href="#" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="expirables"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p>Expirables</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pid=ce_tracking_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="ce_tracking"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>CE Tracking</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pid=add_verification_request" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="verification_requests"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Verification Requests</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pid=directory_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="directory"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Directory</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="reports"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Reports</p>
                    </a>
                </li>    
                <li class="nav-item">
                    <a href="#" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="finance"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Finance</p>
                    </a>
                </li>
              <?php /*if(get_access('lead')==1){ ?>
                <li class="nav-item <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="task"){echo 'menu-open';} ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                          Leads
                          <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <?php if(get_access('view_lead')==1){ ?>
                        <li class="nav-item">
                            <a href="index.php?pid=manage_lead" class="nav-link  <?php if(isset($active_menu) && $active_menu=="manage_lead"){echo 'active';} ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Leads</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(get_access('add_lead')==1){ ?>
                        <li class="nav-item">
                            <a href="index.php?pid=add_lead" class="nav-link  <?php if(isset($active_menu) && $active_menu=="add_lead"){echo 'active';} ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Lead</p>
                            </a>
                        </li>  
                    <?php } ?>
                    </ul>
                </li>
                <?php }*/ ?>
                
                <li class="nav-item">
                    <a href="index.php?pid=license_state_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="ce_tracking"){echo 'active';} ?>">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Licensure</p>
                    </a>
                </li>
            <?php }?>    
              
              


              <!-- add by me -->
              <!-- add by me -->
              <li class="nav-item <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="provider_type_list" || $active_sidebar_tab=="provider_ethnicity"  || $active_sidebar_tab=="institution_type" || $active_sidebar_tab=="degree" || $active_sidebar_tab=="exam_type" || $active_sidebar_tab=="speciality_subspeciality" || $active_sidebar_tab=="focus" || $active_sidebar_tab=="practice_facility_type" || $active_sidebar_tab=="cert_status" || $active_sidebar_tab=="moc_occ_status" || $active_sidebar_tab=="license_type" || $active_sidebar_tab=="website" || $active_sidebar_tab=="request_type" || $active_sidebar_tab=="method_of_request" ){echo 'menu-open';} ?> ">

                  <a href="#settings" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="provider_type_list" || $active_sidebar_tab=="provider_ethnicity"  || $active_sidebar_tab=="institution_type" || $active_sidebar_tab=="degree" || $active_sidebar_tab=="exam_type" || $active_sidebar_tab=="speciality_subspeciality" || $active_sidebar_tab=="focus" || $active_sidebar_tab=="practice_facility_type" || $active_sidebar_tab=="cert_status" || $active_sidebar_tab=="moc_occ_status" || $active_sidebar_tab=="license_type" || $active_sidebar_tab=="website" || $active_sidebar_tab=="request_type" || $active_sidebar_tab=="method_of_request" ){echo 'active';} ?>">
                      <!-- <i class="nav-icon fas fa-signout"></i> -->
                      <i class="nav-icon fas fa-cog"></i>
                      
                      <p>Setting</p><i class="fa fa-caret-down right"></i>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="index.php?pid=provider_type_list" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="provider_type_list"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Provider Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=provider_ethnicity" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="provider_ethnicity"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Provider Ethnicity</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=institution_type" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="institution_type"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Institution Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=degree" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="degree"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Degree</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=exam_type" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="exam_type"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Exam Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=speciality_subspeciality" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="speciality_subspeciality"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Speciality Subspeciality</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=focus" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="focus"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Focus</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=cert_status" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="cert_status"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Cert Status</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=moc_occ_status" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="moc_occ_status"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>MOC/OCC Status</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=practice_facility_type" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="practice_facility_type"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Practice Facility Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=license_type" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="license_type"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>License Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=website" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="website"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Website</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=request_type" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="request_type"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Request Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?pid=method_of_request" class="nav-link <?php if(isset($active_sidebar_tab) && $active_sidebar_tab=="method_of_request"){echo 'active';} ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Method of request</p>
                        </a>
                    </li>

                  </ul>
              </li> 
              
              <li class="nav-item">
                  <a href="process/logout.php" class="nav-link">
                      <!-- <i class="nav-icon fas fa-signout"></i> -->
                      <i class="nav-icon fas fa-sign-out-alt"></i>
                      <p>Logout</p>
                  </a>
              </li>    
               <!-- end -->
          </ul>
      </nav>
       <!-- <div>
           <img src="assets/img/logo.png" alt="Logo" style="width:75%;margin:15px;" class="brand-image"  >
       </div>  -->
  </div>

</aside>