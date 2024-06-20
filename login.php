<?php 
    session_start();
    include "process/config.php";
    include("functions.php");
    $login_page_title="Login";
    include "login_header.php";

?>
<style>

</style>
<div class="row">
    <div class="col-md-6 no-padding">
        <div class="custom-login-left-wrapper">
            <div class="custom-login-left-card">
                <h2 class="head-text">WELCOME BACK</h2>
            
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
                    <form id="loginForm" method="post">
                        <div class="input-group mb-3">
                            
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" id="email" name="email" class="form-control" value="" placeholder="User Name">
                        </div>
                        <div class="input-group mb-3">
                            
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password"  id="password" name="password" class="form-control" value="" placeholder="Password">
                        </div>
                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>" />
                        <input type="hidden" name="category_name" value="<?php echo $category_name; ?>" />
                        <div class="row">
                            <div class="col-6">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember_me">
                                    <label for="remember" class="text-light">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 text-right">
                                <a href="forgot_password.php" class="text-light">Forgot Password?</a>        
                            </div>
                            <div class="col-12">
                                <button type="submit" id="loginSubmit" class="btn btn-primary btn-block">Login</button>
                                <!-- <a href="index.php?pid=home" class="btn cutom-login-light-button btn-block">Log in</a> -->
                            </div>

                        </div>
                    </form>
                    

                    <p class="mb-1">
                        
                    </p>
                    
                

            </div>

        </div>
    </div>
</div>

<?php include "login_footer.php"; ?>
<script src="assets/js/login.js"></script>