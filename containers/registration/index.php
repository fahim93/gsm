<?php include('../../layout/header.php'); ?>
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
                <select class="form-control le-select required country" name="country" id="country">
                  <option value="">Select One</option>
                  <option value="1">Afghanistan</option>
                  <option value="2">Aland Islands</option>
                  <option value="4">Albania</option>
                  <option value="5">Algeria</option>
                  <option value="6">American Samoa</option>
                  <option value="7">Andorra</option>
                  <option value="8">Angola</option>
                  <option value="9">Anguilla</option>
                  <option value="10">Antigua and Barbuda</option>
                  <option value="11">Argentina</option>
                  <option value="12">Armenia</option>
                  <option value="13">Aruba</option>
                  <option value="14">Australia</option>
                  <option value="15">Austria</option>
                  <option value="16">Azerbaijan</option>
                  <option value="17">Bahamas</option>
                  <option value="18">Bahrain</option>
                  <option value="19">Bangladesh</option>
                  <option value="20">Barbados</option>
                  <option value="21">Belarus</option>
                  <option value="22">Belgium</option>
                  <option value="23">Belize</option>
                  <option value="24">Benin</option>
                  <option value="25">Bermuda</option>
                  <option value="26">Bhutan</option>
                  <option value="27">Bolivia</option>
                  <option value="28">Bosnia and Herzegovina</option>
                  <option value="29">Botswana</option>
                  <option value="30">Brazil</option>
                  <option value="31">British Virgin Islands</option>
                  <option value="32">Brunei</option>
                  <option value="33">Bulgaria</option>
                  <option value="34">Burkina Faso</option>
                  <option value="35">Burundi</option>
                  <option value="36">Cambodia</option>
                  <option value="37">Cameroon</option>
                  <option value="38">Canada</option>
                  <option value="39">Cape Verde</option>
                  <option value="40">Catalonia</option>
                  <option value="41">Cayman Islands</option>
                  <option value="42">Central African Republic</option>
                  <option value="43">Chad</option>
                  <option value="44">Chile</option>
                  <option value="45">China</option>
                  <option value="46">Christmas Island</option>
                  <option value="47">Cocos (Keeling) Islands</option>
                  <option value="48">Colombia</option>
                  <option value="49">Comoros</option>
                  <option value="50">Congo </option>
                  <option value="51">Cook Islands</option>
                  <option value="52">Costa Rica</option>
                  <option value="53">Croatia</option>
                  <option value="54">Cuba</option>
                  <option value="55">Cyprus</option>
                  <option value="56">Czech Republic</option>
                  <option value="57">Denmark</option>
                  <option value="58">Djibouti</option>
                  <option value="59">Dominica</option>
                  <option value="60">Dominican Republic</option>
                  <option value="61">East Timor</option>
                  <option value="62">Ecuador</option>
                  <option value="63">Egypt</option>
                  <option value="64">El Salvador</option>
                  <option value="65">England</option>
                  <option value="66">Equatorial Guinea</option>
                  <option value="67">Eritrea</option>
                  <option value="68">Estonia</option>
                  <option value="69">Ethiopia</option>
                  <option value="70">Falkland Islands</option>
                  <option value="71">Faroe Islands</option>
                  <option value="72">Fiji</option>
                  <option value="73">Finland</option>
                  <option value="74">France</option>
                  <option value="75">French Guiana</option>
                  <option value="76">French Polynesia</option>
                  <option value="77">French Southern and Antarctic Lands</option>
                  <option value="78">Gabon</option>
                  <option value="79">Georgia</option>
                  <option value="80">Germany</option>
                  <option value="81">Ghana</option>
                  <option value="82">Gibraltar</option>
                  <option value="83">Greece</option>
                  <option value="84">Greenland</option>
                  <option value="85">Grenada</option>
                  <option value="86">Guadeloupe</option>
                  <option value="87">Guam</option>
                  <option value="88">Guatemala</option>
                  <option value="89">Guinea</option>
                  <option value="90">Guinea-Bissau</option>
                  <option value="91">Guyana</option>
                  <option value="92">Haiti</option>
                  <option value="93">Holland</option>
                  <option value="94">Honduras</option>
                  <option value="95">Hong Kong</option>
                  <option value="96">Hungary</option>
                  <option value="97">Iceland</option>
                  <option value="98">India</option>
                  <option value="99">Indonesia</option>
                  <option value="100">Iran</option>
                  <option value="101">Iraq</option>
                  <option value="102">Ireland</option>
                  <option value="103">Israel</option>
                  <option value="104">Jamaica</option>
                  <option value="105">Japan</option>
                  <option value="106">Jordan</option>
                  <option value="107">Kazakhstan</option>
                  <option value="108">Kenya</option>
                  <option value="109">Kiribati</option>
                  <option value="110">Korea</option>
                  <option value="111">Kuwait</option>
                  <option value="112">Kyrgyzstan</option>
                  <option value="113">Laos</option>
                  <option value="114">Latvia</option>
                  <option value="115">Lebanon</option>
                  <option value="116">Lesotho</option>
                  <option value="117">Liberia</option>
                  <option value="118">Libya</option>
                  <option value="119">Liechtenstein</option>
                  <option value="120">Lithuania</option>
                  <option value="121">Luxembourg</option>
                  <option value="122">Macau</option>
                  <option value="123">Macedonia</option>
                  <option value="124">Madagascar</option>
                  <option value="125">Malawi</option>
                  <option value="126">Malaysia</option>
                  <option value="127">Maldives</option>
                  <option value="128">Mali</option>
                  <option value="129">Malta</option>
                  <option value="130">Marshall Islands</option>
                  <option value="131">Martinique</option>
                  <option value="132">Mauritania</option>
                  <option value="133">Mauritius</option>
                  <option value="134">Mayotte</option>
                  <option value="135">Mexico</option>
                </select><br>
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
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      firstname: "required",
      lastname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      form.submit();
    }
  });
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
        // data: {
        //   "name": "Fahimul Islam",
        //   "email": "abc@gmail.com",
        //   "password": "123456"
        // }
        // dataType: 'JSON',
        // contentType: 'application/json',
        // processData: 'false'
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