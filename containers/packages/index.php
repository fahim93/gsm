<?php include('../../layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<?php include(ROOT_PATH.'functions/fileManager.php'); ?>
<?php include(ROOT_PATH.'classes/Package.php'); ?>

<?php
  $package = new Package($conn);
  $actvie_packages = $package->get_all_active_packages();
?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php include(ROOT_PATH.'components/download-bar.php'); ?>

<div class="animate-dropdown">
  <div id="breadcrumb-alt" class="mar5">
    <div class="container">
      <div class="breadcrumb-nav-holder minimal">
        <ul>
          <li class="breadcrumb-item"><a href="index.html">Downloads</a></li>
          <li class="breadcrumb-item current"><a href="javascript:void(0)">Packages and Pricing</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wrapper">
  <div class="inline-width pad-b-20">
    <div class="container text-center">
      <h1 class="section-title">Best Prices on The Market</h1>
      <p class="lead">Don't miss the chance. Get your download package now and start downloading files today</p>
    </div>
  </div>
  <div class="inline-width pad-b-50">
    <div class="container pad-b-30">
      <div class="row">
        <?php
        if(!empty($actvie_packages)){
          foreach($actvie_packages as $pkg){ ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="panel price pricing-panel">
            <div class="panel-heading text-center secondary-bg">
              <h3 class="text-bold"><?=$pkg['title']?></h3>
            </div>
            <div class="panel-body text-center">
              <h2>
                <span class="price primary-color text-bold">
                  <span><?=($pkg['is_paid'] == 1) ? $pkg['price'] .' '. $pkg['price_unit'] : 'Free'?></span>
                </span>
              </h2>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Validity</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  <span>
                    <?=($pkg['validity'] == 'Expirable') ? $pkg['validity_period'] .' '. $pkg['validity_period_unit'] : $pkg['validity']?>
                  </span>
                </div>
              </li>
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Bandwidth</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  <?=$pkg['bandwith_size']. ' ' .$pkg['bandwith_size_unit'].' / '.$pkg['bandwith_limit_file']. ' Files'?>
                </div>
              </li>
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Usage</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  <span class="label label-success"><?=$pkg['file_type']?> Files</span>
                </div>
              </li>


              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Daily</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  <span>
                    <?=$pkg['daily_download_size'] .' '. $pkg['daily_download_size_unit'] .' / '. $pkg['daily_file_limit'] .' Files'?>
                  </span>
                </div>
              </li>
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Fair Usage</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  <?=$pkg['free_file_size'] .' '. $pkg['free_file_size_unit'] .' / '. $pkg['free_file_limit'] .' Files'?>

                </div>
              </li>
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Every</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  1 Days

                </div>
              </li>
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Usage</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">

                  <span class="label label-warning"> Non-Feature Files </span>
                </div>
              </li>
              <li class="list-group-item">
                <div class="col-md-4 col-sm-5 col-xs-5">
                  <label class="text-right text-bold">Devices</label>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                  <?=($pkg['devices'] == 'Limited') ? $pkg['device_amount'] . ' PCs' : $pkg['devices']?>
                </div>
              </li>
            </ul>
            <div class="panel-footer">
              <!--    <a class="btn btn-lg btn-block btn-primary text-bold" href="https://gsmtechmaster.com/packagecart/1"><i class="fa fa-shopping-cart fw-r10"></i>BUY NOW</a> -->
              <button name="buy_package_btn" data-package-id="<?=$pkg['id']?>"
                class="btn btn-lg btn-block btn-primary text-bold buy_package_btn"><i
                  class="fa fa-shopping-cart fw-r10"></i>BUY
                NOW</button>
            </div>
          </div>
        </div>
        <?php
          }
        }
        ?>

      </div>
    </div>
  </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
  $('.buy_package_btn').click(function () {
    let package_id = $(this).attr("data-package-id");
    $.ajax({
        url: '<?=BASE_URL?>api/cart.php',
        method: 'POST',
        data: {
          "action": "add",
          "item_type": "package",
          "package_id": package_id
        },
        dataType: 'JSON'
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