<?php include('../../layout/header.php'); ?>
<?php include(ROOT_PATH.'functions/fileManager.php'); ?>
<?php
$file_id = (isset($_GET['fid']) && $_GET['fid'] != '') ? $_GET['fid'] : '';
if(isset($file_id) && $file_id != ''){
    $file_info = get_object_by_id($conn, $table_name='files', $id=$file_id);
    if(isset($file_info) && count($file_info) > 0){      
      $id = $file_info['id'];
      $title = $file_info['title'];
      $description = $file_info['description'];
      $device_model = $file_info['device_model'];
      $device_brand = $file_info['device_brand'];
      $android_version = $file_info['android_version'];
      $firmware_version = $file_info['firmware_version'];
      $chip_detail = $file_info['chip_detail'];
      $country = $file_info['country'];
      $language = $file_info['language'];
      $support_tool = $file_info['support_tool'];
      $file_method = $file_info['file_method'];
      $file = $file_info['file'];
      $direct_url = $file_info['direct_url'];
      $date = $file_info['created_at'];
      $file_size = $file_info['file_size'];
      $file_size_unit = $file_info['file_size_unit'];
      $is_paid = $file_info['is_paid'];
      $is_featured = $file_info['is_featured'];
      $price = $file_info['price'];
      $price_unit = $file_info['price_unit'];
      $is_active = $file_info['is_active'];
      $folder = $file_info['folder'];
      $file_src = (isset($file_method) && $file_method == 'direct') ? $direct_url : (isset($file_method) && $file_method
      == 'upload') ? FILE_PATH.$file : '';
      if(!isset($is_active) || $is_active != 'Yes'){
        echo 'Page Not Found';
        die;
      }
    }else{
              echo 'Page Not Found';
              die;
    }
}else{
  echo 'Page Not Found';
  die;
}
if(isset($id)){
  create_visitor($conn, $file_id=$id, $ip=getIPAddress());
}
?>

<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php include(ROOT_PATH.'components/download-bar.php'); ?>
<div class="animate-dropdown">
  <div id="breadcrumb-alt" class="mar5">
    <div class="container">
      <div class="breadcrumb-nav-holder minimal">
        <ul>
          <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Downloads</a></li>
          <?php
          if(isset($folder) && $folder != ''){
            $dir = get_directory_tree($conn, $folder);
            foreach($dir as $d){
              $last_folder_title = $d['title'];
               ?>
          <li class="breadcrumb-item">
            <a href="<?=FOLDER_URL.$d['id']?>"><i class="fa fa-folder-open fw-r10"></i><?=$d['title']?></a>
          </li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wrapper single-file-wrapper">
  <div class="container">

    <div class="back-head">

      <a href="javascript:history.back()">
        <i class="fa fa-caret-left square-icon-medium primary-bg back-icon fw-r10"></i>
        <span class="title"><?=isset($last_folder_title) ? $last_folder_title : 'Home' ?></span>
        <span class="back-description hdivs">Go Back</span>
      </a>

    </div>

    <div class="inline-width pad-b-40 width-100per single-file-content">

      <div class="col-md-12">
        <p class="alert bg-info text-center"><strong>If file need password so it's in description, if not so password
            is: <span class="text-danger">www.gsmtechmaster.com</span></strong></p>

      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 no-margin no-padding">
        <h3 class="file-title page-title"><?=isset($title) ? $title : '' ?><br>
          <span class="badge badge-info" style="background: green">
            <?=(isset($is_paid) && $is_paid == 'Yes') ? 'Paid File' : 'Free File'?></span>
          <?php if(isset($is_featured) && $is_featured == 'Yes'){ ?>
          <span class="badge badge-info" style="background: green">
            Feature File</span>
          <?php } ?>
        </h3>





        <div class="social-row mar-t-50">
          <h2 style="color: red;">File Information
          </h2>
        </div>

        <div class="file-details">

          <div class="col-md-7 col-sm-7 col-xs-12 col-sm-offset-3 col-md-offset-3">
            <table class="table">
              <tbody>
                <tr>
                  <td class="bold text-left">Device Brand</td>
                  <td class="text-left"><span><?=isset($device_brand) ? $device_brand : '' ?></span></td>
                </tr>

                <tr>
                  <td class="bold text-left">Device Model</td>
                  <td class="text-left"><span><?=isset($device_model) ? $device_model : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">OS Version</td>
                  <td class="text-left"><span><?=isset($android_version) ? $android_version : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">File Version</td>
                  <td class="text-left"><span><?=isset($firmware_version) ? $firmware_version : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">Chip Detail</td>
                  <td class="text-left"><span><?=isset($chip_detail) ? $chip_detail : '' ?></span></td>
                </tr>

                <tr>
                  <td class="bold text-left">Country</td>
                  <td class="text-left"><span><?=isset($country) ? $country : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">Language</td>
                  <td class="text-left"><span><?=isset($language) ? $language : '' ?></span></td>
                </tr>

                <tr>
                  <td class="bold text-left">Support Tool</td>
                  <td class="text-left"><span><?=isset($support_tool) ? $support_tool : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">Date</td>
                  <td class="text-left"><span><?=isset($date) ? $date : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">File Size</td>
                  <td class="text-left"><span><?=isset($file_size) ? $file_size : '' ?>
                      <?=isset($file_size_unit) ? $file_size_unit : '' ?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">Visits</td>
                  <td class="text-left">
                    <span><?=isset($id) ? get_visitors_by_file($conn, $id)->num_rows : ''?></span></td>
                </tr>
                <tr>
                  <td class="bold text-left">Downloads</td>
                  <td class="text-left">
                    <span><?=isset($id) ? get_download_history_by_file($conn, $id)->num_rows : ''?></span>
                  </td>
                </tr>
                <?php if(isset($is_paid) && $is_paid == 'Yes'){ ?>
                <tr>
                  <td class="bold text-left">Price</td>
                  <td class="text-left"><span><?=isset($price) ? $price : '' ?>
                      <?=isset($price_unit) ? $price_unit : '' ?></span></td>
                </tr>
                <?php } ?>


              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>
    <div class="file-download">
      <?php if(isset($is_paid) && $is_paid=='Yes'){ ?>
      <button name="buy_file" class="btn btn-lg btn-info btn-block btn-download"><i
          class="fa fa-money fw-r10"></i>Buy</button>
      <?php }else{ ?>
      <button name="download_file" id="download_file" class="btn btn-lg btn-success btn-block btn-download"><i
          class="fa fa-download fw-r10"></i>Download</button>
      <?php }?>

    </div><!--  -->
    <div class="single-view-tab">

      <div class="tags-wrap" style="border-radius: 0px">
      </div>
    </div>
    <div class="single-view-tab">
      <div class="no-container">
        <div class="tab-holder">
          <ul class="nav nav-tabs primary">
            <li class=""><a href="#" data-toggle="tab">Description</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="reviews">
              <div class="add-review row">
                <div class="col-sm-12 col-xs-12">
                  <?=isset($description) ? $description : '' ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<div id="pop-alert-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: red">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Invaid device </h4>
      </div>
      <form action="http://gsmtechmaster.com/trust-this-device" method="post">
        <input type="hidden" name="_token" value="gLdAU1gEIfekAy6woZ620rVvGrheZOoPHAxoGVYe">
        <div class="modal-body bg-success">
          <p class="font-18 text-bold">This device is not active as a trusted device.Before download you need to trust
            this device.</p>
          <p>Your ip is : 144.48.110.207</p>
        </div>
        <div class="modal-footer bg-success">
          <input type="submit" class="btn btn-info " value="Trust This Device">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    </form>
  </div>
</div>
<?php include('../../layout/footer.php'); ?>
<?php include('../../layout/scripts.php'); ?>

<script>
  $('#download_file').click(function () {
    let file_src = "<?=$file_src?>";
    location.href = file_src;
    $.ajax({
      type: "HEAD",
      url: file_src,
      complete: function (xhr) {
        file_size = xhr.getResponseHeader('Content-Length');
        let file_data = {
          action: 'create-download-history',
          file_id: "<?=$id?>",
          file_size: file_size,
          file_size_unit: "byte",
          user_type: "<?=$user_type?>",
          user_id: "<?=(isset($user_id) && $user_id != '')? $user_id : ''?>"
        };
        $.ajax({
            // contentType: "application/x-www-form-urlencoded; charset=UTF-8", // $_POST
            // dataType: "json",
            url: '<?=BASE_URL?>actions/fileManager.php',
            method: 'POST',
            data: file_data
          })
          .done(function (data) {
            location.reload();
          })
          .fail(function (data) {
            toastr.error('', data, {
              timeOut: 5000,
            });
          });
      }
    });

  });

  function humanize(size) {
    var units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];
    var ord = Math.floor(Math.log(size) / Math.log(1024));
    ord = Math.min(Math.max(0, ord), units.length - 1);
    var s = Math.round((size / Math.pow(1024, ord)) * 100) / 100;
    return s + ' ' + units[ord];
  }
</script>

<?php include('../../layout/foot-scripts.php'); ?>