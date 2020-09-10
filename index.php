<?php include('layout/header.php'); ?>
<?php include('layout/navbar.php'); ?>
<?php include('conf/dbConfig.php'); ?>
<?php include('functions/fileManager.php'); ?>
<?php
$folder_id = (isset($_GET['fid']) && $_GET['fid'] != '') ? $_GET['fid'] : '';
?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="downloads-recent-header  row">
  <div class="rf-mq-container mq-container container">
    <div class="col-md-2 col-sm-3 col-xs-2 text-right">
      <i class="fa fa-clock-o fw-r10"></i><span class="hidden-xs font-13 text-bold">Recent Files</span>
    </div>
    <div class="col-md-10 col-sm-9 col-xs-10">
      <div class="marquee-set">
        <div class="marquee-content">
          <div class="mq-file-item inline">
            <a href="download-file/1249.html">LAVA_Z51_1_16_V1.0_S132_20191211 Firmware (GSM Tech Master)</a>
            <span class="item_date item_detail">[ 2020-03-07 15:41:07 ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/1248.html">LAVA_Z51_1_16_V1.0_S126_20190520_ENG_IN_195734_448 (GSM Tech Master)</a>
            <span class="item_date item_detail">[ 2020-03-07 15:39:59 ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/1247.html">RMX1941EX_11_A.23_200108_8ccaffaa (GSM Tech Master)</a>
            <span class="item_date item_detail">[ 2020-03-07 09:47:23 ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/1246.html">RMX1941EX_11_A.17_190919_f59604e3 (GSM Tech Master)</a>
            <span class="item_date item_detail">[ 2020-03-07 08:45:37 ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/1245.html">sagit_images_V11.0.2.0.PCACNXM_20191019.0000.00_9.0_cn_9696da2279 (GSM
              Tech Master)</a>
            <span class="item_date item_detail">[ 2020-03-07 06:10:48 ]</span>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="tf-mq-container mq-container container">
    <div class="col-md-2 col-sm-3 col-xs-2 text-right">
      <i class="fa fa-flash fw-r10"></i><span class="hidden-xs font-13 text-bold">Top Files</span>
    </div>
    <div class="col-md-10 col-sm-9 col-xs-10">
      <div class="marquee-set">
        <div class="marquee-content">

          <div class="mq-file-item inline">
            <a href="download-file/1017.html">JKM-L22&amp;JKM-LX2 9.1.0.220(C636) Downgrade Firmware For FRP Reset
              Tested By (GSM Tech Master)</a>
            <span class="item_downloads item_detail">[ 760 Downloads ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/82.html">ALL FRP APK BY GTM</a>
            <span class="item_downloads item_detail">[ 679 Downloads ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/1054.html">Odin3_v3.13.1 Patched By (GSM Tech Master)</a>
            <span class="item_downloads item_detail">[ 313 Downloads ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/824.html">Redmi 6&amp;6A Mi Account And Frp Tested By [GSM Tech Master]</a>
            <span class="item_downloads item_detail">[ 285 Downloads ]</span>
          </div>
          <div class="mq-file-item inline">
            <a href="download-file/143.html">Redmi 7 (onclite) BL Unlock And Mi Account Permanently Remove File
              Patched By |GSM Tech Master|</a>
            <span class="item_downloads item_detail">[ 209 Downloads ]</span>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>



<div class="downloads-visitor-usage row">
  <div class="container pad-t-10 pad-b-10">
    <div class="col-md-2 col-sm-3 col-xs-2 text-right">
      <i class="fa fa-download fw-r10"></i><span class="hidden-xs font-14 text-bold">Downloads</span>
    </div>
    <div class="col-md-8 col-sm-7 col-xs-10">
      <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="0.012652079264323" aria-valuemin="0"
          aria-valuemax="100" style="width:0.012652079264323%">
          <span class="sr-only">0.012652079264323%</span>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-3 hidden-xs text-left">
      <span class="font-14">796.0 KB / 6 GB</span>
    </div>
  </div>
</div>
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
            is: <span class="text-danger">www.gsmtechmaster.com</span></strong></p>

      </div>

    </div>
  </div>
  <div class="downloads-folders pad-t-50 wow fadeInUp">
    <div class="container">
      <div class="downloads-folders-grid-holder">
        <?php
        $folder_list = get_objects($conn, $table_name='folders', $filter_set=array("is_active"=>"Yes", "parent"=>$folder_id));
        if(isset($folder_list) && $folder_list->num_rows > 0){
          foreach($folder_list as $folder){ ?>
        <a href="<?=BASE_URL.'?fid='.$folder['id']?>">
          <div class="col-md-3 col-sm-4 col-xs-12 no-margin">
            <div class="folder-home-item">

              <div class="image">
                <a href="<?=BASE_URL.'?fid='.$folder['id']?>">
                  <img
                    src="<?=(isset($folder['thumbnail']) && $folder['thumbnail'] != '') ? DEFAULT_FOLDER_ICON_PATH . $folder['thumbnail'] : DEFAULT_FOLDER_ICON_SRC ?>"
                    class="img-responsive">
                </a>
              </div>
              <div class="body">
                <div class="title">
                  <a href="<?=BASE_URL.'?fid='.$folder['id']?>"><?=$folder['title']?></a>
                </div>
                <p class="description"><?=$folder['description']?></p>
              </div>
            </div>
          </div>
        </a>
        <?php }
        }
        ?>
      </div>
    </div>
  </div>
  <div class="downloads-files pad-t-50 wow fadeInUp">
    <div class="container">
      <div class="downloads-files-grid-holder">
        <?php
        if(isset($folder_id) && $folder_id != ''){
          $files_qry = "SELECT files.* FROM files, folders WHERE files.folder = folders.id AND files.is_active = 'Yes' AND folders.is_active = 'Yes'";
        }else{
          $files_qry = "SELECT * FROM files WHERE is_active = 'Yes' AND folder IS NULL";
        }
        if(isset($files_qry) && $files_qry != ''){
          $file_list = get_custom_objects($conn, $files_qry);
          if(isset($file_list) && $file_list->num_rows > 0){
            foreach($file_list as $file){ ?>
            <div class="col-md-3 col-sm-4 col-xs-12 no-margin">
              <div class="file-grid-item">
    
                <div class="content-top">
                  <div class="image">
                    <a href="<?=FILE_DETAILS_URL.$file['id']?>">
                    <?php if(isset($file['is_paid']) && $file['is_paid'] == 'Yes'){ ?>
                    <div class="ribbon green"><span><?=$file['price']?> <?=$file['price_unit']?></span></div>
                    <?php } ?>
                      <img src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>" class="img-responsive">
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
                    <span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date"><?=$file['file_size']?> <?=$file['file_size_unit']?></span>
                  </div>
                  <?php if(isset($file['is_paid']) && $file['is_paid'] == 'Yes'){ ?>
                    <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                        class="fa fa-money fw-r5"></i>Buy</a>
                    <?php }else{ ?>
                      <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i class="fa fa-download fw-r5"></i>Download</a>
                      <?php } ?>
                </div>
              </div>
            </div>
            <?php
            }
          }
        }
        ?>
      </div>
    </div>
  </div>

  <div id="top-brands" class="wow fadeInUp mar-t-60">
    <div class="container">
      <div class="carousel-holder">
        <div class="title-nav">
          <h1>Our Partners</h1>
          <div class="nav-holder">
            <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
            <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
          </div>
        </div>
        <div id="owl-brands" class="owl-carousel brands-carousel">
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582615052.png" alt="vivo" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582384694.png" alt="Samsung" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582614787.png" alt="Del" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582615384.png" alt="oppo" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582615120.png" alt="xiaomi" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582615583.png" alt="htc" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582615474.png" alt="google" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582614876.png" alt="huawei" />
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0)">
              <img src="uploads/partner/1582615733.png" alt="tecno" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pad-b-50">
    <div class="container">
      <div class="row no-margin widgets-row">
        <div class="col-md-4 col-sm-4 col-xs-12 no-margin-left">
          <div class="widget downloads-footer-widget footer-widget footer-widget">
            <h2 class="widget-head"><i class="fa fa-flash fw-r10"></i>Top Files</h2>
            <div class="body text-center">
              <ul class="dfiles-footer-list">

                <li>
                  <a href="download-file/1017.html">JKM-L22&amp;JKM-LX2 9.1.0.220(C636) Downgrade Firmware For FRP
                    Reset Tested By (GSM Tech Master)</a>

                </li>
                <li>
                  <a href="download-file/82.html">ALL FRP APK BY GTM</a>

                </li>
                <li>
                  <a href="download-file/1054.html">Odin3_v3.13.1 Patched By (GSM Tech Master)</a>

                </li>
                <li>
                  <a href="download-file/824.html">Redmi 6&amp;6A Mi Account And Frp Tested By [GSM Tech Master]</a>

                </li>
                <li>
                  <a href="download-file/143.html">Redmi 7 (onclite) BL Unlock And Mi Account Permanently Remove File
                    Patched By |GSM Tech Master|</a>

                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 no-margin-left">
          <div class="widget downloads-footer-widget footer-widget">
            <h2 class="widget-head"><i class="fa fa-tags fw-r10"></i>Recent Files</h2>
            <div class="body text-center">
              <ul class="dfiles-footer-list">
                <li>
                  <a href="download-file/1249.html">LAVA_Z51_1_16_V1.0_S132_20191211 Firmware (GSM Tech Master)</a>

                </li>
                <li>
                  <a href="download-file/1248.html">LAVA_Z51_1_16_V1.0_S126_20190520_ENG_IN_195734_448 (GSM Tech
                    Master)</a>

                </li>
                <li>
                  <a href="download-file/1247.html">RMX1941EX_11_A.23_200108_8ccaffaa (GSM Tech Master)</a>

                </li>
                <li>
                  <a href="download-file/1246.html">RMX1941EX_11_A.17_190919_f59604e3 (GSM Tech Master)</a>

                </li>
                <li>
                  <a href="download-file/1245.html">sagit_images_V11.0.2.0.PCACNXM_20191019.0000.00_9.0_cn_9696da2279
                    (GSM Tech Master)</a>

                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12 no-margin-left">
          <div class="widget announcements-footer-widget footer-widget">
            <h2 class="widget-head"><i class="fa fa-file-text fw-r10"></i>Announcements</h2>
            <div class="body">
              <ul class="announcements-footer-list">
                <li>
                  <a
                    href="announcement/how-to-work-our-website-system06b0.html?aid=eyJpdiI6IlZ0ZlA1Ym96ajNMeUk0czJyT0VvV1E9PSIsInZhbHVlIjoiUGIwd3RTQ2lyNGM3U2NLcllGbXJFQT09IiwibWFjIjoiZmJkN2Q3MGYxMGQyMDljMzg0ZmYzNDgzNjg3ZjZhNTk1YzQzOWQyNmU2ZmExOGVkODgyMDcyYWJmZDBhY2EyYyJ9">How
                    To Work Our Website System</a>
                </li>
                <li>
                  <a
                    href="announcement/must-read-website-user7cb5.html?aid=eyJpdiI6IkNKRlMyNDJGXC90S1YrSFV1eXZpa0VBPT0iLCJ2YWx1ZSI6IktJTjY1OGNrU2xzNXp6ck5iS1FCc1E9PSIsIm1hYyI6IjBiMDI1YjdkYTMyMTcyMjU1OGE2ZTAyNDY3NTRhNDY1ZTc2YTZkNTBjMTQ3NWM1MGM5MmI5MGFjYmIxNjBjMTQifQ==">Must
                    Read Website User</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('layout/footer.php'); ?>
<?php include('layout/scripts.php'); ?>
<?php include('layout/foot-scripts.php'); ?>