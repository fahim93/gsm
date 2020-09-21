<?php include('../../layout/header.php'); ?>

<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<?php include(ROOT_PATH.'functions/fileManager.php'); ?>
<?php
$folder_id = (isset($_GET['fid']) && $_GET['fid'] != '') ? $_GET['fid'] : '';
if(isset($folder_id) && $folder_id != ''){
    $base_folder_info = get_object_by_id($conn, $table_name='folders', $id=$folder_id);
    $base_folder_id = $base_folder_info['id'];
    $base_folder_title = $base_folder_info['title'];
}

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
        <?php
            }   
 } ?>

        <?php include(ROOT_PATH.'components/file-list.php');?>
    </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script src="<?=BASE_URL?>js/file-list.js"></script>
<script>
    $(document).ready(function () {
        const params = new URLSearchParams(window.location.search)
        let folder_id = (params.has('fid') && params.get('fid') !== null) ? params.get('fid') : '';
        let order_by = $('#order_by').val();
        let sort = $('#sort').val();
        let req_data = {
            action: 'file-list',
            folder_id: folder_id,
            order_by: order_by,
            sort: sort
        };
        $.ajax({
                url: '<?=BASE_URL?>actions/file-list.php',
                method: 'POST',
                data: req_data,
                dataType: 'json'
            })
            .done(function (data) {
                let FOLDER_URL = "<?=FOLDER_URL?>";
                let FILE_DETAILS_URL = "<?=FILE_DETAILS_URL?>";
                let BASE_URL = "<?=BASE_URL?>";
                let DEFAULT_THUMB_SRC = "<?=$default_file_thumbnail?>";
                setFileList(data, FOLDER_URL, FILE_DETAILS_URL, BASE_URL, DEFAULT_THUMB_SRC);
            })
            .fail(function (data) {
                toastr.error('', data, {
                    timeOut: 5000,
                });
            });
        // console.log("fid: " + folder_id + "; order_by: " + order_by + "; sort: " + sort);
    });
</script>
<script>
    $('#btn-sort').click(function () {
        const params = new URLSearchParams(window.location.search)
        let folder_id = (params.has('fid') && params.get('fid') !== null) ? params.get('fid') : '';
        let order_by = $('#order_by').val();
        let sort = $('#sort').val();
        let req_data = {
            action: 'file-list',
            folder_id: folder_id,
            order_by: order_by,
            sort: sort
        };
        $.ajax({
                url: '<?=BASE_URL?>actions/file-list.php',
                method: 'POST',
                data: req_data,
                dataType: 'json'
            })
            .done(function (data) {
                let FOLDER_URL = "<?=FOLDER_URL?>";
                let FILE_DETAILS_URL = "<?=FILE_DETAILS_URL?>";
                let BASE_URL = "<?=BASE_URL?>";
                let DEFAULT_THUMB_SRC = "<?=$default_file_thumbnail?>";
                setFileList(data, FOLDER_URL, FILE_DETAILS_URL, BASE_URL, DEFAULT_THUMB_SRC);
            })
            .fail(function (data) {
                toastr.error('', data, {
                    timeOut: 5000,
                });
            });
    });
</script>
<script>
    $('#grid_view').click(function () {
        $("#list_view").removeClass("btn-primary");
        $("#grid_view").addClass("btn-primary");
        $("#file_container_list").addClass("hidden");
        $("#file_container_grid").removeClass("hidden");
    });
    $('#list_view').click(function () {
        $("#grid_view").removeClass("btn-primary");
        $("#list_view").addClass("btn-primary");
        $("#file_container_grid").addClass("hidden");
        $("#file_container_list").removeClass("hidden");
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>