<?php include('../layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<?php include(ROOT_PATH.'functions/fileManager.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="animate-dropdown">
  <div id="breadcrumb-alt" class="mar5">
    <div class="container">
      <div class="breadcrumb-nav-holder minimal">
        <ul>
          <li class="breadcrumb-item"><a href="javascript:void(0)">Downloads</a></li>
          <li class="breadcrumb-item current"><a href="javascript:void(0)">Request File</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wrapper">
  <div class="container">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="section leave-a-message inner-bottom-xs">
        <h2 class="border"><i class="fa fa-lg fa-info fw-r10"></i>Request Specific File</h2>
        <p class="mar-t-10">If you need a special file, use the below form to send us your request</p>

        <form id="file_request_form" class="contact-form cf-style-1 inner-top-xs" method="post">
          <div class="row field-row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="label-required">Name</label>
              <input name="name" class="le-input" placeholder="Full Name" pattern=".{3,64}" required>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="label-required">Email</label>
              <input name="email" class="le-input" type="email" placeholder="Email Address" required>
            </div>
          </div>

          <div class="field-row">
            <label class="label-required">Phone</label>
            <input name="phone" class="le-input" type="text" placeholder="Phone Number" pattern="[0-9+-]{7,15}"
              required>
          </div>

          <div class="field-row">
            <label class="label-required">Subject</label>
            <input name="subject" class="le-input" type="text" placeholder="Subject" pattern=".{3,150}" required>
          </div>

          <div class="field-row">
            <label class="label-required">Message</label>
            <textarea name="message" rows="8" class="le-input" placeholder="Message" pattern=".{3,300}"
              required></textarea>
          </div>

          <div class="buttons-holder">

            <button type="submit" class="le-button huge"><i class="fa fa-send fw-r10"></i>Send Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('../layout/footer.php'); ?>
<?php include('../layout/scripts.php'); ?>
<script>
  $('#file_request_form').submit(function (event) {
    event.preventDefault();
    let fd = new FormData(this);
    fd.append('action', 'create-file-request');
    $.ajax({
        url: '<?=BASE_URL?>actions/fileManager.php',
        method: 'POST',
        data: fd,
        dataType: 'JSON',
        contentType: false,
        processData: false
      })
      .done(function (data) {
        toastr.success('', data.msg, {
          timeOut: 3000,
          onHidden: function () {

          }
        });
      })
      .fail(function (data) {
        toastr.error('', data, {
          timeOut: 5000,
        });
      });
  });
</script>
<?php include('../layout/foot-scripts.php'); ?>