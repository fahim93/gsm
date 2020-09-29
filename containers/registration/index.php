<?php include('../../layout/header.php'); ?>
<?php
if(is_logged_in()){
  header("Location:".BASE_URL);
}
?>
<?php include('../../layout/navbar.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
  <div class="outer-bottom-xs">
    <div class="container">
      <div class="col-md-12 col-sm-12 col-xs-12 no-margin">

        <div class="row-form-group">
          <form method="post" action="" id="registration_form" name="registration_form">
            <h2 class="border h1"><i class="fa fa-user fw-r10"></i>Personal Details </h2>
            <div class="row field-row">
              <div class="col-md-6 col-sm-6 col-xs-12 rc">
                <label class="label-required">Full Name</label>
                <input name="name" id="name" type="text" class="le-input required name" placeholder="Full Name"
                  value="">
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 rc">
                <label>Phone</label>
                <input name="phone" id="phone" type="text" class="le-input required phoneNumber" value=""
                  placeholder="Phone Number" pattern="[0-9+-]{7,15}">
                <span class="text-danger show_erro" id="phoneNumber_error"></span>
              </div>
            </div>
            <div class="row field-row">
              <div class="col-md-6 col-sm-6 col-xs-12 rc">
                <label class="label-required">Country</label>
                <div class="country_select le-input" data-selectedcountry="BD" data-showspecial="false"
                  data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection"
                  data-i18nfilter="Filter" data-onchangecallback="onChangeCallback">
                </div>
                <input type="hidden" name="country" id="country" value="BD">
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 rc">
                <label>City</label>
                <input name="city" id="city" type="text" class="form-control le-input required city" placeholder="City"
                  value="">
              </div>
            </div>
            <div class="row field-row rc">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Address</label>
                <input name="address" id="address" type="text" class="le-input required address" value=""
                  placeholder="Street Address">

              </div>
            </div>
            <div class="row field-row">
              <div class="col-md-12 col-sm-12 col-xs-12 rc">
                <label>ZIP Code</label>
                <input name="zip_code" id="zip_code" type="text" min="0" class="le-input required zipCode" value=""
                  placeholder="ZIP Code">
              </div>
            </div>
            <h2 class="border h1"><i class="fa fa-lock fw-r10"></i>Account Details</h2>
            <div class="row field-row">
              <div class="col-md-12 col-sm-12 col-xs-12 rc">
                <label class="label-required">Email</label>
                <input name="email" id="email" type="email" class="le-input required email" placeholder="Email Address"
                  value="">
              </div>
            </div>
            <div class="row field-row">
              <div class="col-md-12 col-sm-12 col-xs-12 rc">
                <label class="label-required">Username</label>
                <input name="username" id="username" value="" type="text" class="le-input required username"
                  placeholder="User Name" pattern="[a-zA-Z0-9-_.]{3,32}">
              </div>
            </div>
            <div class="row field-row">
              <div class="col-md-6 col-sm-6 col-xs-12 rc">
                <label class="label-required">Password</label>
                <input name="password" id="password" type="password" class="le-input required password"
                  placeholder="Password">
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 rc">
                <label class="label-required">Confirm Password</label>
                <input name="password_confirmation" id="password_confirmation" type="password"
                  class="le-input required password_confirmation" placeholder="Confirm Password">
              </div>
            </div>
            <div class="field-row clearfix rc">
              <label class="content-color">
                <input type="checkbox" name="agree" id="agree" value="1"
                  class="le-checbox auto-width inline required agree">  By proceeding you agree to <a
                  href="https://gsmtechmaster.com/terms-of-service" target="_blank">Terms of Service</a> and <a
                  href="https://gsmtechmaster.com/privacy-policy" target="_blank">Privacy Policy</a>
              </label>
              <span class="text-danger show_erro" id="agree_error"></span>
            </div>
            <div class="place-order-button">
              <button type="submit" id="submit_button" class="le-button big"><i class="fa fa-check fw-r10"></i>Complete
                Registration</button>
              <a href="<?=LOGIN_URL?>" class="le-button big"><i class="fa fa-check fw-r10"></i>Back to
                Login </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
  $(function () {

    new NiceCountryInput($(".country_select")).init();

  });

  function onChangeCallback(ctr) {
    $('#country').val(ctr);
  }
</script>
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
  $('#registration_form').submit(function (event) {
    event.preventDefault();
    let registration_form = $(this);
    let form_data = JSON.stringify(registration_form.serializeObject());
    // let form_data = new FormData(this);
    $.ajax({
        url: '<?=BASE_URL?>api/create-customer.php',
        method: 'POST',
        contentType: 'application/json',
        data: form_data
      })
      .done(function (data) {
        if (data.status == 1) {
          toastr.success('', data.message, {
            timeOut: 3000,
            onHidden: function () {

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