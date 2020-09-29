<?php include('../../../layout/header.php'); ?>
<?php
if(is_logged_in()){
    header("Location: ". BASE_URL);
}
?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="animate-dropdown">
    <div id="breadcrumb-alt" class="mar5">
        <div class="container">
            <div class="breadcrumb-nav-holder minimal">
                <ul>
                    <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
                    <li class="breadcrumb-item current"><a href="<?=LOGIN_URL?>">Login </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="section sign-in inner-right-xs">
                <h2 class="border"><i class="fa fa-unlock fw-r10"></i>Login to your account</h2>

                <form role="form" id="login_form" class="login-form cf-style-1" method="post">
                    <div class="field-row">
                        <label>Email</label>
                        <input name="email" id="email" value="" type="email" class="le-input" placeholder=" Email">

                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <div class="field-row">
                        <label>Password</label>
                        <input name="password" id="password" type="password" class="le-input" placeholder="Password">
                        <div class="text-danger"></div>
                        <span class="text-danger" id="password_error"></span>
                    </div>
                    <div class="field-row clearfix">
                        <span class="pull-left">
                            <label class="content-color">
                                <input type="checkbox" name="remember_me" value="1"
                                    class="le-checbox auto-width inline"> <span class="bold">Remember me</span>
                            </label>
                        </span>
                        <span class="pull-right">
                            <a href="<?=FORGOT_PASSWORD_URL?>" class="content-color bold">Forgot
                                your Password ?</a>
                        </span>
                    </div>

                    <div class="buttons-holder">
                        <button type="submit" class="le-button huge"><i class="fa fa-unlock fw-r10"></i>Secure
                            Login</button>
                    </div>
                </form>

            </div>
        </div>


        <div class="col-md-6 col-sm-12 col-xs-12">

            <div class="section register inner-left-xs inner-top-xs">

                <h2 class="semi-bold outer-bottom-xs"><i class="fa fa-info fw-r10"></i>Don't have account yet!</h2>

                <div class="buttons-holder mar-b-30">
                    <a class="le-button huge" href="<?=SIGN_UP_URL?>"><i class="fa fa-user fw-r10"></i>Sign Up Today</a>
                </div>

                <ul class="list-unstyled list-benefits">
                    <li><i class="fa fa-check primary-color"></i> Speed your way through the checkout</li>
                    <li><i class="fa fa-check primary-color"></i> Track your orders easily</li>
                    <li><i class="fa fa-check primary-color"></i> Keep a record of all your purchases</li>
                </ul>

            </div>

        </div>


    </div>

</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
    $.fn.serializeObject = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    $('#login_form').submit(function (event) {
        event.preventDefault();
        let login_form = $(this);
        let form_data = JSON.stringify(login_form.serializeObject());
        // let form_data = new FormData(this);
        $.ajax({
                url: '<?=BASE_URL?>api/login.php',
                method: 'POST',
                contentType: 'application/json',
                data: form_data
            })
            .done(function (data) {
                if (data.status == 1) {
                    // store jwt to cookie
                    // setCookie("jwt", data.jwt, 1);
                    // console.log(getCookie('jwt'));
                    toastr.success('', data.message, {
                        timeOut: 2000,
                        onHidden: function () {
                            history.back();
                        }
                    });
                } else {
                    toastr.error('', data.message, {
                        timeOut: 5000,
                    });
                }
            })
            .fail(function (data) {
                toastr.error('', 'Some Problem Occured. Please Try Again.', {
                    timeOut: 5000,
                });
            });
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>