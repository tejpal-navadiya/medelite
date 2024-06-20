<nav class="main-header navbar navbar-expand" style="background:#fff;">

    <div class="custom-sidebar-topmenu-wrapper">
        <ul class="navbar-nav">
        <li class="nav-item custom-toggle-sidebar-button-wrapper2">
            <a class="nav-link" id='main-sidebar-toggle-button' data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?pid=home" class="nav-link">Dashboard</a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?pid=manage_client" class="nav-link">Clients</a>
        </li> -->
        </ul>
    </div>
   <!-- <div class="custom-topbar-logo">
        <img src="assets/img/logo.png" alt="Logo" style="width:75px;" class="brand-image"  >
   </div>  -->
  
  
  
  
  <!-- comment by me -->
   <!-- <ul class="navbar-nav ml-auto" >
      <li class="nav-item">
          <!-- <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
          </a> --
          <div class="user-panel d-flex">
            <div class="image">
                <img src="assets/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['me_user_name'];?><br></a>
            </div>
        </div>
      </li>
      
  </ul> -->

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="assets/img/avatar5.png" class="img-circle user_img" alt="User Image">
            <span class="info dropdown-toggle">
                <?php echo $_SESSION['me_user_name'];?>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="index.php?pid=add_user_profile">User Profile</a>
            <a class="dropdown-item" href="process/logout.php">Sign Out</a>
        </div>
    </li>
</ul>

  <!-- end comment -->
</nav>