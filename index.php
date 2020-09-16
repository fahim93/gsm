<?php include('layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<?php include(ROOT_PATH.'functions/fileManager.php'); ?>
<?php
$folder_id = (isset($_GET['fid']) && $_GET['fid'] != '') ? $_GET['fid'] : '';

$current_url = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$view = isset($_GET['view']) ? $_GET['view'] : '';
$folder_list = get_objects($conn, $table_name='folders', $filter_set=array("is_active"=>"Yes", "parent"=>''));

if(isset($_GET['order-by']) && $_GET['order-by'] !='' && isset($_GET['sort']) && $_GET['sort'] !=''){
  $order_by = $_GET['order-by'];
  $sort = $_GET['sort'];
  if($order_by == 'downloads'){
    $file_list = get_custom_objects($conn, "SELECT f.*, COUNT(dh.id) AS total_download FROM `files` AS f LEFT JOIN
    `download_history` AS dh ON f.id = dh.file WHERE f.is_active = 'Yes' GROUP BY f.id ORDER BY total_download $sort");
  }else if($order_by == 'visits'){
    $file_list = get_custom_objects($conn, "SELECT f.*, COUNT(fv.id) AS total_visitors FROM `files` AS f LEFT JOIN
    `file_visitors` AS fv ON f.id = fv.file WHERE f.is_active = 'Yes' GROUP BY f.id ORDER BY total_visitors $sort");

  }else{
    $file_list = get_objects($conn, $table_name='files', $filter_set=array('is_active'=>'Yes', 'folder'=>''), $order_by=$order_by, $sorted=$sort);
  }
}else{
  $file_list = get_objects($conn, $table_name='files', $filter_set=array('is_active'=>'Yes', 'folder'=>''), $order_by='title', $sorted='ASC');
}
?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php
if(isset($top_and_recent_file_list) && $top_and_recent_file_list == 1){
  include(ROOT_PATH.'components/recent-and-top-files.php');
}
?>
<?php include(ROOT_PATH.'components/download-bar.php'); ?>

<div class="wrapper">
  <div class="row downloads-search-home secondary-bg">
    <div class="container">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="search-content center text-center">
          <form class="form-inline" method="get" action="http://gsmtechmaster.com/search">
            <div class="search-form-group form-group">
              <div class="input-group input-group-lg">
                <input name="keyword" type="text" class="form-control search-block-input" placeholder="Search Keyword"
                  aria-label="Search Keyword" required>
                <span class="input-group-addon input-pad-rl hidden-xs">
                  <select name="in">
                    <option value="website">Files / Folders</option>
                    <option value="files">Files</option>
                    <option value="folder">Folders</option>
                  </select>
                </span>
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>;
  <div class="row">
    <div class="container pad-t-10 pad-b-10">
      <div class="col-md-12">
        <p class="alert bg-info text-center"><strong>If file need password so it's in description, if not so password
            is: <span
              class="text-danger"><?=(isset($default_password) && $default_password != '') ? $default_password : ''?></span></strong>
        </p>
      </div>

    </div>
  </div>
  <?php
  if(isset($folder_list) && $folder_list->num_rows > 0){ ?>
  <div class="downloads-folders pad-t-50 wow fadeInUp">
    <div class="container">
      <div class="downloads-folders-grid-holder">
        <?php
          foreach($folder_list as $folder){ ?>
        <a href="<?=FOLDER_URL.$folder['id']?>">
          <div class="col-md-3 col-sm-4 col-xs-12 no-margin">
            <div class="folder-home-item">

              <div class="image">
                <a href="<?=FOLDER_URL.$folder['id']?>">
                  <img
                    src="<?=(isset($folder['thumbnail']) && $folder['thumbnail'] != '') ? DEFAULT_FOLDER_ICON_PATH . $folder['thumbnail'] : DEFAULT_FOLDER_ICON_SRC ?>"
                    class="img-responsive">
                </a>
              </div>
              <div class="body">
                <div class="title">
                  <a href="<?=FOLDER_URL.$folder['id']?>"><?=$folder['title']?></a>
                </div>
                <p class="description"><?=$folder['description']?></p>
              </div>
            </div>
          </div>
        </a>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
  <?php
  if(isset($file_list) && $file_list->num_rows > 0){ ?>
  <div class="downloads-files pad-t-50 wow fadeInUp">
    <div class="container">
      <div class="downloads-files-grid-holder">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="control-bar inline-width">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <form class="inline pad-b-30" method="get" action="">
                <div class="le-select width-200">
                  <select class="sort-by-select" name="order-by">
                    <option value="title" selected>Title</option>
                    <option value="price">Price</option>
                    <option value="created_at">Date</option>
                    <option value="downloads">Downloads</option>
                    <option value="visits">Visits</option>
                    <option value="is_featured">Featured</option>
                  </select>
                </div>
                <div class="le-select">
                  <select class="sort-type-select hasCustomSelect" name="sort" data-placeholder="Sort Type">
                    <option value="DESC">Descending</option>
                    <option value="ASC" selected>Ascending</option>

                  </select>
                </div>
                <button type="submit" class="btn-inline btn btn-sm btn-primary">Sort</button>
              </form>
            </div>
            <?php
            if(isset($view) && $view == 'list'){ ?>
            <div class="col-md-1 col-sm-1 col-xs-12 pull-right">
              <div class="grid-list-buttons pull-right">
                <ul class="pull-right">
                  <li class="grid-list-button-item active">
                    <a href="<?=BASE_URL?>?view=grid">
                      <i class="fa fa-th-large" style="color:#9436BD"></i> Grid
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <?php } else { ?>
            <div class="col-md-3 col-sm-3 col-xs-12 pull-right">
              <div class="grid-list-buttons pull-right">
                <ul>
                  <li class="grid-list-button-item active">
                    <a href="<?=BASE_URL?>?view=list">
                      <i class="fa fa-th-list" style="color:#9436BD"></i> List
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php
              foreach($file_list as $file){ 
                if(isset($view) && $view == 'list'){ ?>
        <div class="file-list-item">
          <div class="image">
            <a href="<?=FILE_DETAILS_URL.$file['id']?>">
              <img
                src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
                class="img-responsive">
            </a>
          </div>
          <div class="body">
            <div class="title">
              <a href="<?=FILE_DETAILS_URL.$file['id']?>"><?=$file['title']?></a>
            </div>
            <div class="file-labels">
              <?php
                if($file['is_featured'] == 'Yes'){ ?>
              <span class="label label-info">Featured</span>
              <?php  
                }
                if($file['is_paid'] == 'Yes'){ ?>
              <span class="label label-warning">Paid</span>
              <span class="label label-success"><?=$file['price']?> <?=$file['price_unit']?></span>
              <?php
                }else{ ?>
              <span class="label label-success">Free</span>
              <?php } ?>
            </div>
            <p class="description"></p>
            <div class="content-controls">
              <span class="file-folder text-bold"><a href="<?=BASE_URL?>" target="_blank">Root Folder</a></span>
              <span class="seprator text-muted">&ensp;|&ensp;</span>
              <span class="file-date">Date: <?=date('d M Y', strtotime($file['created_at']))?></span>
              <span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date">Size:
                <?=$file['file_size']?>
                <?=$file['file_size_unit']?></span>
            </div>
          </div>
          <div class="content-buttons">
            <?php
              if($file['is_paid'] == 'Yes'){ ?>
            <a class="btn btn-primary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                class="fa fa-shopping-cart fw-r5"></i>Buy</a>
            <?php
              }else{ ?>
            <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                class="fa fa-download fw-r5"></i>Download</a>
            <?php
              } ?>
          </div>
        </div>
        <?php
                }
                else{ ?>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="file-grid-item">

            <div class="content-top">
              <div class="image">
                <a href="<?=FILE_DETAILS_URL.$file['id']?>">
                  <?php if(isset($file['is_paid']) && $file['is_paid'] == 'Yes'){ ?>
                  <div class="ribbon green"><span><?=$file['price']?> <?=$file['price_unit']?></span></div>
                  <?php } ?>
                  <img
                    src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
                    class="img-responsive">
                </a>
              </div>
              <div class="body">
                <div class="title">
                  <a href="<?=FILE_DETAILS_URL.$file['id']?>"><?=$file['title']?></a>
                </div>
              </div>
            </div>
            <div class="content-bottom">
              <div class="content-controls">
                <span class="file-date"> <?=date('d M Y', strtotime($file['created_at']))?></span>
                <span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date"><?=$file['file_size']?>
                  <?=$file['file_size_unit']?></span>
              </div>
              <?php if(isset($file['is_paid']) && $file['is_paid'] == 'Yes'){ ?>
              <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                  class="fa fa-money fw-r5"></i>Buy</a>
              <?php }else{ ?>
              <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                  class="fa fa-download fw-r5"></i>Download</a>
              <?php } ?>
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
  <?php
  }
  ?>

  <!-- Our Partner (start) -->
  <?php
  if(isset($our_partner) && $our_partner == 1){
    include(ROOT_PATH.'components/our-partners.php');
  }
  ?>
  <!-- Our Partner (end) -->

  <div class="pad-b-50">
    <div class="container">
      <div class="row no-margin widgets-row">
        <!-- Recent and Top File List (start) -->
        <?php
        if(isset($top_and_recent_file_list) && $top_and_recent_file_list == 1){
          include(ROOT_PATH.'components/recent-and-top-file-list.php');
        }
        ?>
        <!-- Recent and Top File List (end) -->
        <!-- Announcement List (start) -->
        <?php include(ROOT_PATH.'components/announcement-list.php'); ?>
        <!-- Announcement List (end) -->
      </div>
    </div>
  </div>
</div>
<?php include('layout/footer.php'); ?>
<?php include('layout/scripts.php'); ?>
<?php include('layout/foot-scripts.php'); ?>