<?php include('../../layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<?php include(ROOT_PATH.'functions/fileManager.php'); ?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php include(ROOT_PATH.'components/download-bar.php'); ?>
<div class="animate-dropdown">
  <div id="breadcrumb-alt" class="mar5">
    <div class="container">
      <div class="breadcrumb-nav-holder minimal">
        <ul>
          <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Downloads</a></li>
          <li class="breadcrumb-item current"><a href="#">Latests 100 files</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wrapper">
  <div class="inline-width pad-b-20">
    <div class="container text-center">
      <h1 class="section-title">Latest 100 files</h1>
      <p class="lead">Here is a list of our latest 100 files, don't forget to get your best subscription this gives you
        most benefits</p>
    </div>
  </div>
  <div class="inline-width pad-b-50">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <?php
          $recent_files = get_recent_files($conn, $limit=100);
          if($recent_files->num_rows > 0){
            foreach($recent_files as $rf){
              $folder = get_folder_by_file_id($conn, $file_id=$rf['id']);
            ?>
          <div class="file-list-item">
            <div class="image">
              <a href="<?=FILE_DETAILS_URL.$rf['id']?>">
                <img
                  src="<?=(isset($rf['thumbnail']) && $rf['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $rf['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
                  class="img-responsive">
              </a>
            </div>
            <div class="body">
              <div class="title">
                <a href="<?=FILE_DETAILS_URL.$rf['id']?>"><?=$rf['title']?></a>
              </div>
              <div class="file-labels">
                <?php
                if($rf['is_featured'] == 'Yes'){ ?>
                <span class="label label-info">Featured</span>
                <?php  
                }
                if($rf['is_paid'] == 'Yes'){ ?>
                <span class="label label-warning">Paid</span>
                <span class="label label-success"><?=$rf['price']?> <?=$rf['price_unit']?></span>
                <?php
                }else{ ?>
                <span class="label label-success">Free</span>
                <?php } ?>
              </div>
              <p class="description"></p>
              <div class="content-controls">
                <span class="file-folder text-bold"><a
                    href="<?=(isset($folder) && count($folder) > 0) ? FOLDER_URL.$folder['id'] : BASE_URL?>"
                    target="_blank"><?=(isset($folder) && count($folder) > 0) ? $folder['title'] : 'Root Folder'?></a></span>
                <span class="seprator text-muted">&ensp;|&ensp;</span>
                <span class="file-date">Date: <?=date('d M Y', strtotime($rf['created_at']))?></span>
                <span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date">Size:
                  <?=$rf['file_size']?>
                  <?=$rf['file_size_unit']?></span>
              </div>
            </div>
            <div class="content-buttons">
              <?php
              if($rf['is_paid'] == 'Yes'){ ?>
              <a class="btn btn-primary content-btn" href="<?=FILE_DETAILS_URL.$rf['id']?>"><i
                  class="fa fa-shopping-cart fw-r5"></i>Buy</a>
              <?php
              }else{ ?>
              <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$rf['id']?>"><i
                  class="fa fa-download fw-r5"></i>Download</a>
              <?php
              } ?>
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
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>