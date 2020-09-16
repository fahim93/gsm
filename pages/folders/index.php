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
            } ?>
        <?php
        $file_list = get_objects($conn, $table_name='files', $filter_set=array('is_active'=>'Yes', 'folder'=>$folder_id));
        if(isset($file_list) && $file_list->num_rows > 0){ ?>
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
                <?php
                if(isset($_GET['view']) && $_GET['view'] == 'list'){ ?>
                <div class="col-md-1 col-sm-1 col-xs-12 pull-right">
                    <div class="grid-list-buttons pull-right">
                        <ul class="pull-right">
                            <li class="grid-list-button-item active">
                                <a href="<?=FOLDER_URL.$folder_id?>&view=grid">
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
                                <a href="<?=FOLDER_URL.$folder_id?>&view=list">
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
        if(isset($_GET['view']) && $_GET['view'] == 'list'){ ?>
        <div class="file-list-item">
            <div class="image">
                <a href="<?=FILE_DETAILS_URL.$file['id']?>">
                    <img src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
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
                    <span class="file-folder text-bold"><a href="#" target="_blank"><?=$base_folder_title?></a></span>
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
                            <img src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
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
                        <span class="seprator text-muted">&ensp;|&ensp;</span><span
                            class="file-date"><?=$file['file_size']?>
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
        <?php

        }
    
 } ?>

        <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
        </div>

    </div>
</div>
<?php include('../../layout/footer.php'); ?>
<?php include('../../layout/scripts.php'); ?>
<?php include('../../layout/foot-scripts.php'); ?>