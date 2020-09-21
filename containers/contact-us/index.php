<?php include('../../layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="animate-dropdown">
  <div id="breadcrumb-alt" class="mar5">
    <div class="container">
      <div class="breadcrumb-nav-holder minimal">
        <ul>
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item current"><a href="#">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wrapper">
  <div class="container-fluid">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <?php
      if(isset($show_map) && $show_map == 1){ ?>
      <div class="section leave-a-message inner-bottom-xs">
        <h2 class="border"><i class=" fw-r10"></i></h2>
        <p class="mar-t-10"></p>
        <div class="contact-info div inner-left-xs">
          <iframe
            src="<?=(isset($map_url) && $map_url !='') ? $map_url : ''?>"
            width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
      </div>
      <?php
      }
      ?>
    </div>


    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="section leave-a-message inner-bottom-xs">
        <h2 class="border"><i class="fa fa-lg fa-envelope fw-r10"></i>Leave a Message</h2>
        <p class="mar-t-10">Use the below form to get in touch with us, we will reply your message via Email within 24
          hours</p>
        <form id="contact_form" class="contact-form cf-style-1 inner-top-xs" method="post">
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
            <button type="submit" class="le-button huge"><i class="fa fa-send fw-r10"></i>Send Message</button>
          </div>
        </form>
      </div>
    </div>


  </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
  $('#contact_form').submit(function (event) {
    event.preventDefault();
    let fd = new FormData(this);
    fd.append('action', 'create-contact');
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
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>