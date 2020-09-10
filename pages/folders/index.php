<?php include('../../layout/header.php'); ?>
<?php include('../../layout/navbar.php'); ?>
<?php include('../../conf/dbConfig.php'); ?>
<?php include('../../functions/fileManager.php'); ?>
<?php include('../../functions/custom-functions.php'); ?>
<?php
$folder_id = (isset($_GET['fid']) && $_GET['fid'] != '') ? $_GET['fid'] : '';
if(isset($folder_id) && $folder_id != ''){
    $base_folder_info = get_object_by_id($conn, $table_name='folders', $id=$folder_id);
    $base_folder_id = $base_folder_info['id'];
    $base_folder_title = $base_folder_info['title'];
}
$original_size = get_daily_downloaded_size_per_user($conn, $ip=getIPAddress(), $user_id=$user_id);
$max_limit = 6 * 1024 * 1024 * 1024;
$percentage_of_max_limit = ($original_size * 100) / $max_limit;
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
                        <a href="../download-file/1249.html">LAVA_Z51_1_16_V1.0_S132_20191211 Firmware (GSM Tech
                            Master)</a>
                        <span class="item_date item_detail">[ 2020-03-07 15:41:07 ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/1248.html">LAVA_Z51_1_16_V1.0_S126_20190520_ENG_IN_195734_448 (GSM
                            Tech
                            Master)</a>
                        <span class="item_date item_detail">[ 2020-03-07 15:39:59 ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/1247.html">RMX1941EX_11_A.23_200108_8ccaffaa (GSM Tech Master)</a>
                        <span class="item_date item_detail">[ 2020-03-07 09:47:23 ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/1246.html">RMX1941EX_11_A.17_190919_f59604e3 (GSM Tech Master)</a>
                        <span class="item_date item_detail">[ 2020-03-07 08:45:37 ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/1245.html">sagit_images_V11.0.2.0.PCACNXM_20191019.0000.00_9.0_cn_9696da2279
                            (GSM Tech Master)</a>
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
                        <a href="../download-file/1017.html">JKM-L22&amp;JKM-LX2 9.1.0.220(C636) Downgrade Firmware For
                            FRP Reset
                            Tested By (GSM Tech Master)</a>
                        <span class="item_downloads item_detail">[ 760 Downloads ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/82.html">ALL FRP APK BY GTM</a>
                        <span class="item_downloads item_detail">[ 679 Downloads ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/1054.html">Odin3_v3.13.1 Patched By (GSM Tech Master)</a>
                        <span class="item_downloads item_detail">[ 313 Downloads ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/824.html">Redmi 6&amp;6A Mi Account And Frp Tested By [GSM Tech
                            Master]</a>
                        <span class="item_downloads item_detail">[ 285 Downloads ]</span>
                    </div>
                    <div class="mq-file-item inline">
                        <a href="../download-file/143.html">Redmi 7 (onclite) BL Unlock And Mi Account Permanently
                            Remove File
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
        <div class="progress-bar" role="progressbar"
          aria-valuenow="<?=isset($percentage_of_max_limit) ? $percentage_of_max_limit : 0?>" aria-valuemin="0"
          aria-valuemax="100" style="width:<?=isset($percentage_of_max_limit) ? $percentage_of_max_limit : 0?>%">
          <span class="sr-only"><?=isset($percentage_of_max_limit) ? $percentage_of_max_limit : 0?>%</span>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-3 hidden-xs text-left">
      <span class="font-14"><?=size_humanize($original_size)['SAU']?> / 6 GB</span>
    </div>
  </div>
</div>
<div class="animate-dropdown">
    <div id="breadcrumb-alt" class="mar5">
        <div class="container">
            <div class="breadcrumb-nav-holder minimal">
                <ul>
                    <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Downloads</a></li>
                    <?php
                    if(isset($base_folder_id) && $base_folder_id != ''){
                        $dir = get_directory_tree($conn, $base_folder_id);
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
<div class="wrapper">
    <div class="container">
        <div class="inline-width pad-b-25">
            <div class="col-md-12 col-sm-12 col-xs-12 no-margin no-padding">
                <div class="back-head">
                    <a href="javascript:history.back()">
                        <i class="fa fa-caret-left square-icon-medium primary-bg back-icon fw-r10"></i>
                        <span class="title"><?=isset($base_folder_title) ? $base_folder_title : '' ?></span>
                        <span class="back-description small-font hidden-xs">Go Back</span>
                    </a>
                </div>
                <h3 class="page-title sub-back-head"><?=isset($base_folder_title) ? $base_folder_title : '' ?></h3>
            </div>
        </div>
        <?php
        if(isset($folder_id) && $folder_id != ''){
            $folder_list = get_objects($conn, $table_name='folders', $filter_set=array("is_active"=>"Yes", "parent"=>$folder_id));
            if(isset($folder_list) && $folder_list->num_rows > 0){ ?>
        <div class="downloads-folders pad-t-50 wow fadeInUp">
            <div class="container">
                <div class="downloads-folders-grid-holder">
                    <?php foreach($folder_list as $folder){ ?>
                    <a href="<?=FOLDER_URL.$folder['id']?>">
                        <div class="col-md-3 col-sm-4 col-xs-12 no-margin">
                            <div class="folder-home-item">
                                <div class="image">
                                    <a href="<?=FOLDER_URL.$folder['id']?>">
                                        <img src="<?=(isset($folder['thumbnail']) && $folder['thumbnail'] != '') ? DEFAULT_FOLDER_ICON_PATH . $folder['thumbnail'] : DEFAULT_FOLDER_ICON_SRC ?>"
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
        <?php }else{ ?>
        <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
            <div class="control-bar inline-width">
                <div class="col-md-8 col-sm-8 col-xs-12 no-margin">
                    <form class="inline pad-b-30" method="get" action="#">
                        <div class="le-select width-200">
                            <select class="sort-by-select" name="shortBy">
                                <option value="0" selected>Title</option>
                                <option value="1">Price</option>
                                <option value="2">Date</option>
                                <option value="3">Downloads</option>
                                <option value="4">Visits</option>
                                <option value="5">Featured</option>
                            </select>
                        </div>
                        <div class="le-select">
                            <select class="sort-type-select hasCustomSelect" name="orderBy"
                                data-placeholder="Sort Type">
                                <option value="1">Descending</option>
                                <option value="2" selected>Ascending</option>

                            </select>
                        </div>
                        <button type="submit" class="btn-inline btn btn-sm btn-primary">Sort</button>
                    </form>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12 pull-right">
                    <div class="grid-list-buttons pull-right">
                        <ul class="pull-right">
                            <li class="grid-list-button-item ">
                                <a href="781.html">
                                    <i class="fa fa-th-large" style="color:#9436BD"></i> Grid
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 pull-right">
                    <div class="grid-list-buttons pull-right">
                        <ul>
                            <li class="grid-list-button-item active">
                                <a href="../folder/781.html">
                                    <i class="fa fa-th-list"></i> List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 no-margin">
            <div class="file-grid-item">

                <div class="content-top">
                    <div class="image">
                        <a href="../download-file/1179.html">
                            <img src="../uploads/system/fi1582383446.png" class="img-responsive">
                        </a>
                    </div>
                    <div class="body">
                        <div class="title">
                            <a href="../download-file/1179.html">InfinityBox_update_CM2MTK_Supplementary-files-package_v1.58
                                (GSM
                                Tech Master)</a>
                        </div>
                        <p class="description"></p>
                    </div>
                </div>
                <div class="content-bottom">
                    <div class="content-controls">
                        <span class="file-date"> 20-Dec-2019</span>
                        <span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date">2
                            MB</span>
                    </div>
                    <a class="btn btn-secondary content-btn" href="../download-file/1179.html"><i
                            class="fa fa-download fw-r5"></i>Download</a>
                </div>
            </div>
        </div>
        <?php }
        } ?>

        <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
        </div>

    </div>
</div>
<?php include('../../layout/footer.php'); ?>
<?php include('../../layout/scripts.php'); ?>
<?php include('../../layout/foot-scripts.php'); ?>