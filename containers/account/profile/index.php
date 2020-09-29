<?php include('../../../layout/header.php'); ?>
<?php
if(!is_logged_in()){
    header("Location: ". BASE_URL);
}else{
    include(ROOT_PATH.'classes/Customer.php');

    $customer_obj = new Customer($conn);
    $customer_id = $_SESSION['customer_id'];
    $customer_obj->id = $customer_id;
    $customer_info = $customer_obj->get_customer_by_id();
    if($customer_info->num_rows > 0){
        $cust = $customer_info->fetch_assoc();
        $name = $cust['name'];
        $username = $cust['username'];
        $email = $cust['email'];
        $phone = $cust['phone'];
        $address = $cust['address'];
        $country = $cust['country'];
        $city = $cust['city'];
        $zip_code = $cust['zip_code'];
        $image = $cust['image'];
        $created_at = $cust['created_at'];
        $login_at = $cust['login_at'];
        $ip = $cust['ip'];
    }
}
?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container outer-bottom-sm mar-t-20">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-default account-sidemenu">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user text-gray fw-r10"></i>Account</h3>
                </div>
                <div class="panel-body no-padding no-margin">
                    <ul class="nav nav-pills nav-stacked menu-links-stack">
                        <li class="">
                            <a href="<?=ACCOUNT_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Dashboard
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?=ACC_PROFILE_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Profile
                            </a>
                        </li>


                        <li class="">
                            <a href="<?=ACC_PACKAGES_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Packages
                            </a>

                        </li>
                        <li class="">
                            <a href="<?=ACC_FILES_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Files
                            </a>
                        </li>

                        <li class="">
                            <a href="<?=ACC_ORDERS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Orders
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_INVOICES_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Invoices
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_TRANSACTIONS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Transactions
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_TRANSFERS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Transfers
                            </a>
                        </li>

                        <li class="">
                            <a href="<?=ACC_DOWNLOADS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Downloads
                            </a>
                        </li>

                    </ul>
                </div>;
            </div>

        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2 class="font-20 mar-b-10"><i class="fa fa-user fw-r10"></i>Profile</h2>
                <form method="post" enctype="multipart/form-data" id="update_profile_form">
                    <div class="panel panel-default ">
                        <div class="panel-body row-form-group">
                            <div class="col-md-9 col-sm-12 col-xs-12">
                                <div class="row field-row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 rc">
                                        <label class="label-required">Name</label>
                                        <input name="name" id="name" type="text" class="le-input required name"
                                            placeholder="Full Name" value="<?=isset($name) ? $name : ''?>"
                                            pattern=".{3,64}" onchange="validation('name')"
                                            onkeyup="validation('name')">
                                        <span class="text-danger show_erro" id="name_error"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 rc">
                                        <label>Phone</label>
                                        <input name="phone" id="phone" type="text" class="le-input required phoneNumber"
                                            value="<?=isset($phone) ? $phone : ''?>" placeholder="Phone Number"
                                            pattern="[0-9+-]{7,15}" onchange="validation('phoneNumber')"
                                            onkeyup="validation('phoneNumber')">
                                        <span class="text-danger show_erro" id="phoneNumber_error"></span>
                                    </div>
                                </div>
                                <div class="row field-row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 rc">
                                        <label class="label-required">Country</label>
                                        <div class="country_select le-input"
                                            data-selectedcountry="<?=isset($country) ? $country : 'BD'?>"
                                            data-showspecial="false" data-showflags="true" data-i18nall="All selected"
                                            data-i18nnofilter="No selection" data-i18nfilter="Filter"
                                            data-onchangecallback="onChangeCallback">
                                        </div>
                                        <input type="hidden" name="country" id="country"
                                            value="<?=isset($country) ? $country : ''?>">
                                        <!-- <span class="text-danger show_erro" id="country_error"></span> -->
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 rc">
                                        <label>City</label>
                                        <input name="city" id="city" type="text" class="le-input required city"
                                            placeholder="City" value="<?=isset($city) ? $city : ''?>" pattern=".{2,64}"
                                            onchange="validation('city')" onkeyup="validation('city')">

                                        <span class="text-danger show_erro" id="city_error"></span>
                                    </div>
                                </div>
                                <div class="row field-row rc">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Address</label>
                                        <input name="address" id="address" type="text" class="le-input required address"
                                            value="<?=isset($address) ? $address : ''?>" placeholder="Street Address"
                                            pattern=".{5,200}" onchange="validation('address')"
                                            onkeyup="validation('address')">

                                        <span class="text-danger show_erro" id="address_error"></span>
                                    </div>
                                </div>
                                <div class="row field-row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 rc">
                                        <label>ZIP Code</label>
                                        <input name="zip_code" id="zip_code" type="text"
                                            class="le-input required zipCode"
                                            value="<?=isset($zip_code) ? $zip_code : ''?>" placeholder="ZIP Code"
                                            onchange="validation('zipCode')" onkeyup="validation('zipCode')">

                                        <span class="text-danger show_erro" id="zipCode_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="field-row text-center">
                                    <input type="file" name="image" id="image" class="dropify"
                                        data-default-file="<?=(isset($image) && $image != '') ? BASE_URL.$image : $default_user_image_src ?>" />
                                </div>
                            </div>
                            <input type="hidden" value="<?=(isset($image) && $image != '') ? $image : '' ?>"
                                name="old_image">

                        </div>
                        <div class="panel-footer">
                            <button type="submit" id="submit_button" class="btn btn-block le-button"><i
                                    class="fa fa-check fw-r10"></i>Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h2 class="font-20 mar-b-10"><i class="fa fa-lock fw-r10"></i>Password</h2>
                <form method="post" id="update_password_form">
                    <div class="panel panel-default">
                        <div class="panel-body row-form-group">
                            <div class="field-row">
                                <label class="label-required">Current Password</label>
                                <input name="current_password" id="old" class="le-input old" type="password"
                                    placeholder="Current Password" pattern=".{3,32}">
                                <span class="text-danger show_erro" id="current_password_error"></span>
                            </div>
                            <div class="row field-row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="label-required">Password</label>
                                    <input name="password" id="password" type="password" class="le-input  password"
                                        placeholder="Password" pattern=".{3,32}">
                                    <span class="text-danger show_erro" id="password_error"></span>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="label-required">Confirm Password</label>
                                    <input name="password_confirmation" id="password_confirmation" type="password"
                                        class="le-input  password_confirmation" placeholder="Confirm Password"
                                        pattern=".{3,32}">
                                    <span class="text-danger show_erro" id="password_confirmation_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-block le-button" id="password_submit"><i
                                    class="fa fa-check fw-r10"></i>Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h2 class="font-20 mar-b-10"><i class="fa fa-envelope fw-r10"></i>Email</h2>

                <form method="post" id="update_email_form">
                    <div class="panel panel-default">
                        <div class="panel-body row-form-group">

                            <div class="row field-row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="label-required">Current Email</label>
                                    <input name="current_email" id="current_email" type="email"
                                        class="le-input currentEmail" readonly=""
                                        value="<?=isset($email) ? $email : ''?>">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="label-required">New Email</label>
                                    <input type="email" name="new_email" id="new_email" class="le-input newEmail"
                                        placeholder="New Email">
                                </div>
                            </div>
                            <div class="row field-row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="label-required">Current Password</label>
                                    <input name="current_password" id="current_password" class="le-input currentPassord"
                                        type="password" placeholder="Current Password" pattern=".{3,32}">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-block le-button" id="email_button"><i
                                    class="fa fa-check fw-r10"></i>Change Email</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
    $('.dropify').dropify();

    $(function () {

        new NiceCountryInput($(".country_select")).init();

    });

    function onChangeCallback(ctr) {
        $('#country').val(ctr);
    }
</script>
<script>
    $('#update_profile_form').submit(function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        let customer_id = "<?=$customer_id?>";
        formData.append("customer_id", customer_id);
        formData.append("action", "update-profile");
        $.ajax({
                url: "<?=BASE_URL.'api/update-profile.php'?>",
                method: 'POST',
                data: formData,
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function (data) {
                if (data.status == 1) {
                    toastr.success('', data.message, {
                        timeOut: 2000,
                        onHidden: function () {
                            location.reload();
                        }
                    });
                } else {
                    toastr.error('', data.message, {
                        timeOut: 5000
                    });
                }
            })
            .fail(function (data) {
                toastr.error('', "Some Problem Occurred, Please Try Again.", {
                    timeOut: 5000
                });

            });
    });
</script>
<script>
    $('#update_password_form').submit(function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        let customer_id = "<?=$customer_id?>";
        formData.append("customer_id", customer_id);
        formData.append("action", "update-password");
        $.ajax({
                url: "<?=BASE_URL.'api/update-password.php'?>",
                method: 'POST',
                data: formData,
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function (data) {
                if (data.status == 1) {
                    toastr.success('', data.message, {
                        timeOut: 2000,
                        onHidden: function () {
                            location.reload();
                        }
                    });
                } else {
                    toastr.error('', data.message, {
                        timeOut: 5000
                    });
                }
            })
            .fail(function (data) {
                toastr.error('', "Some Problem Occurred, Please Try Again.", {
                    timeOut: 5000
                });

            });
    });
</script>
<script>
    $('#update_email_form').submit(function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        let customer_id = "<?=$customer_id?>";
        formData.append("customer_id", customer_id);
        formData.append("action", "update-email");
        $.ajax({
                url: "<?=BASE_URL.'api/update-email.php'?>",
                method: 'POST',
                data: formData,
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function (data) {
                if (data.status == 1) {
                    toastr.success('', data.message, {
                        timeOut: 2000,
                        onHidden: function () {
                            location.reload();
                        }
                    });
                } else {
                    toastr.error('', data.message, {
                        timeOut: 5000
                    });
                }
            })
            .fail(function (data) {
                toastr.error('', "Some Problem Occurred, Please Try Again.", {
                    timeOut: 5000
                });

            });
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>