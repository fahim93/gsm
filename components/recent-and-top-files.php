<?php
    $recent_files = get_custom_objects($conn, $qry="SELECT * FROM files AS f WHERE f.is_active = 'Yes' ORDER BY created_at DESC LIMIT 5");
    $top_downloads = get_custom_objects($conn, $qry="SELECT f.*, COUNT(dh.id) AS total_download FROM `files` AS f, `download_history` AS dh WHERE f.id = dh.file AND f.is_active = 'Yes' GROUP BY f.id ORDER BY total_download DESC LIMIT 5");
?>
<div class="downloads-recent-header  row">
  <div class="rf-mq-container mq-container container">
    <div class="col-md-2 col-sm-3 col-xs-2 text-right">
      <i class="fa fa-clock-o fw-r10"></i><span class="hidden-xs font-13 text-bold">Recent Files</span>
    </div>
    <div class="col-md-10 col-sm-9 col-xs-10">
      <div class="marquee-set">
        <div class="marquee-content">
        <?php
        if(isset($recent_files) && $recent_files->num_rows > 0){
            foreach($recent_files as $rf){ ?>
            <div class="mq-file-item inline">
              <a href="<?=FILE_DETAILS_URL.$rf['id']?>"><?=$rf['title']?></a>
              <span class="item_date item_detail">[ <?=$rf['created_at']?> ]</span>
            </div>
        <?php
            }
        }
        ?>
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
        <?php
        if(isset($top_downloads) && $top_downloads->num_rows > 0){
            foreach($top_downloads as $td){ ?>
            <div class="mq-file-item inline">
              <a href="<?=FILE_DETAILS_URL.$td['id']?>"><?=$td['title']?></a>
              <span class="item_downloads item_detail">[ <?=$td['total_download']?> Downloads ]</span>
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