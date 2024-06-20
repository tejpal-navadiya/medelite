<?php 
    session_start();
    include "process/config.php";
    include("functions.php");
    $login_page_title="Forgot Password";
    include "login_header.php";

?>
<style>

</style>
<div class="row">
    <div class="col-md-6 no-padding">
        <div class="custom-login-left-wrapper">
            <div class="custom-login-left-card">
                <h2 class="head-text">Reset Password</h2>
            
                <div class="cutom-login-icon-left">
                    <img src="assets/img/logo.png"/>
                </div>
                <p class="custom-login-left-text">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text.
                </p>
            </div>    
        </div>
    </div>
    <div class="col-md-6 no-padding">
        <div class="custom-login-box">

            <div class="custom-login-card card-outline">
                
                
                    <?php include "message.php"; ?>
                    <div class="cutom-login-icon-right">
                        <img src="assets/img/login-page-user-icon.png"/>
                    </div>
                    <!-- <p class="login-box-msg"> Login </p> -->
                    <form action="process/check_login.php" method="post">
                        <div class="input-group mb-3">
                            
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" name="login_username" required class="form-control" value="" placeholder="Password">
                        </div>
                        <div class="input-group mb-3">
                            
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" name="login_username" required class="form-control" value="" placeholder="Confirm Password">
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <span  class="text-light">Remembered Password?</span >
                                <a href="login.php" class="text-light">Login</a>
                            </div>

                            <div class="col-6 text-right">
                                <a href="login.php" class="btn cutom-login-light-button btn-block">Reset Password</a>        
                            </div>
                            
                        </div>
                    </form>                   
                

            </div>

        </div>
    </div>
</div>

<?php include "login_footer.php"; ?>