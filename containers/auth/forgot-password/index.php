<?php include('../../../layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="animate-dropdown">
    <div id="breadcrumb-alt" class="mar5">
        <div class="container">
            <div class="breadcrumb-nav-holder minimal">
                <ul>
                    <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
                    <li class="breadcrumb-item current"><a href="<?=FORGOT_PASSWORD_URL?>">Forgot Password </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="container">
        <div class="center-block col-md-7 col-sm-12 col-xs-12">
            <div class="section sign-in inner-right-xs">
                <h2 class="border">Forgot your password ?</h2>
                <h5></h5>
                <form role="form" id="forgot_password_form" class="login-form cf-style-1" method="post">
                    <div class="field-row">
                        <label>Email Address</label>
                        <input name="email" type="email" class="le-input" placeholder="Email Address" required=""
                            value="">
                        <input type="hidden" name="for" value="1">
                    </div>
                    <div class="buttons-holder">
                        <input type="hidden" name="submit_forget_password" value="1">
                        <button type="submit" class="le-button huge"><i class="fa fa-check fw-r10"></i>Request Password
                            Reset</button>
                        <span class="pull-right">
                            <a href="<?=LOGIN_URL?>">Login to your account ?</a>

                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>