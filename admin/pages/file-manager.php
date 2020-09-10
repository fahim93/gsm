<?php include '../layout/header.php'; ?>
<?php include '../layout/top-navbar.php'; ?>
<?php include '../layout/left-sidebar.php'; ?>
<?php include '../conf/dbConfig.php'; ?>
<?php
  if(isset($_GET['fid']) && $_GET['fid'] != ''){
    $fid = $_GET['fid'];
    $folder_qry = "SELECT * FROM folders WHERE parent = $fid";
    $file_qry = "SELECT * FROM files WHERE folder = $fid";
  }else{
    $folder_qry = "SELECT * FROM folders WHERE parent IS NULL";
    $file_qry = "SELECT * FROM files WHERE folder IS NULL";
  }
  $folder_rs = $conn->query($folder_qry); 
  $file_rs = $conn->query($file_qry);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-caret-right"></i> File Manager</h1>
    <ol class="breadcrumb">
      <li class="active"><a href="<?=BASE_URL?>"><i class="fa fa-home"></i> Home</a></li>
      <li>File Manager</li>
    </ol>
  </section>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="form-control" id="directory-path" readonly=""><a class="path-dir-folder"
            href="<?=FILE_MANAGER_URL?>">File Manager</a></label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="btn-group btn-group-md">
          <button class="btn btn-default"><a href="javascript:history.back()"><i class="fa fa-arrow-left fw-r5"></i>
              Back</a></button>
          <a class="btn btn-default" href="<?=FILE_MANAGER_URL?>"><i class="fa fa-arrow-up fw-r5"></i>
            Up</a>
          <button class="btn btn-default" type="button" data-toggle="modal" data-target="#file-search-modal"><i
              class="fa fa-search fw-r5"></i> Search</button>

          <button class="btn btn-default" type="button" data-toggle="modal" data-target="#folder-new-modal"><i
              class="fa fa-folder-o fw-r5"></i> New Folder</button>
          <button class="btn btn-default" data-toggle="modal" data-target="#file-new-modal"><i
              class="fa fa-file-o fw-r5"></i> New File</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- <div class="box-header">

          </div> -->
          <!-- /.box-header -->
          <div class="box-body" oncontextmenu="return false;">
            <div class="box-body" id="directory-box">
              <h4 id="directory-header-message" style="display: none;"></h4>
              <ul id="directory-list" class="no-padding no-margin">
                <?php
                if(!empty($folder_rs)){
                  foreach($folder_rs as $folder){ ?>

                <li class="directory-folder directory-element folder-context-menu" data-id="<?=$folder['id']?>">
                  <a class="directory-href" title="folder includes some files for test">
                    <div class="element-badge-texts">
                    </div>
                    <div class="element-badge-icons">
                    </div>
                  </a><a href="<?=BASE_URL?>pages/file-manager.php?fid=<?=$folder['id']?>">
                    <img id="img_click" class="element-icon"
                      src="<?=(isset($folder['thumbnail']) && $folder['thumbnail'] != '') ? BASE_URL . 'files/icons/' . $folder['thumbnail'] : DEFAULT_FOLDER_ICON_SRC?>">

                    <span class="element-title text-center" title=""><?=$folder['title']?></span></a>

                </li>
                <input type="hidden" id="folder_id" name="folder_id" value="<?=$folder['id']?>">
                <input type="hidden" value="" id="fo_id" name="fo_id">
                <?php                  
                  }
                } ?>
                <textarea id="textarea" style="display: none;"></textarea>
                <?php
                if(!empty($file_rs)){
                  foreach($file_rs as $file){ ?>
                <li class="directory-file directory-element file-context-menu" data-id="<?=$file['id']?>">
                  <a class="directory-href" title="Test paid file for purchasing by your customers">
                    <div class="element-badge-texts">
                      <span class="bg-gray" title="Shortcut"><i class="fa fa-share"></i></span>
                      <?php if(isset($file['price']) && $file['price'] > 0){ ?>
                      <span class="bg-orange" title="Paid">
                        <span class="price-view-text"><?=$file['price']?>
                          <?=isset($file['price_unit'])?$file['price_unit']:'USD'?>
                        </span>
                      </span>
                      <?php } ?>
                      <?php if(isset($file['file_size']) && $file['file_size'] != ''){ ?>
                      <span class="bg-green" title="Size">
                        <span class=""><?=$file['file_size']?>
                          <?=isset($file['file_size_unit'])?$file['file_size_unit']:''?>
                        </span>
                      </span>
                      <?php } ?>
                    </div>
                    <div class="element-badge-icons">
                    </div>
                    <img class="element-icon"
                      src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? 'files/icons/' . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC?>">
                    <span class="element-title text-center" title=""><?=$file['title']?></span>
                  </a>
                </li>
                <?php
                }
                } ?>
              </ul>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <!-- Col -->
    </div>
    <!-- Row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Folder New Modal -->
<div id="folder-new-modal" class="modal fade modal-dialog-form in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h5 class="modal-title"><i class="fa fa-plus fw-r10"></i> New Folder</h5>
      </div>
      <form class="form-horizontal form-jsonp" method="post" enctype="multipart/form-data" data-resform="true"
        data-pact="renderFileManager" id="folder_form">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="folder_title" value="" class="form-control" type="text" placeholder="Title"
                pattern=".{1,254}" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Description</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="folder_desc" value="" class="form-control" type="text" placeholder="Description"
                pattern=".{1,500}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Thumbnail</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <label role="button">
                <img id="nfolder_thumbnail_src" class="image-form-control-100x90"
                  src="<?=BASE_URL?>files/icons/folder-icon-default.png">
                <input class="hidden" value="" type="file" accept="image/*" name="folder_thumb" id="folder_thumb">
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-8 control-label">Active</label>
            <div class="col-md-9 col-sm-9 col-xs-4">
              <input type="hidden" name="is_active" value="0">
              <label class="pad-5">
                <input name="is_active" type="checkbox" class="flat-green" data-iclass="icheckbox_flat-green" checked
                  value="Yes">
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="folder_id" value="<?=isset($_GET['fid'])? $_GET['fid']:''?>">
          <div class="col-sm-12">
            <div class="progress progress-lg m-b-5">
              <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                aria-valuenow="0" id="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                0%
              </div>
            </div>
          </div>
          <button type="submit" id="create_folder" class="btn btn-success pull-left"><i class="fa fa-plus fw-r5"></i>
            Create Folder</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- File New Modal -->
<div id="file-new-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h5 class="modal-title"><i class="fa fa-plus fw-r10"></i> New File</h5>
      </div>
      <form class="form-horizontal form-jsonp" method="post" enctype="multipart/form-data" data-pact="renderFileManager"
        data-resform="true" id="new_file_upload">
        <div class="modal-body">
          <div class="nav-tabs-custom no-margin border-none">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_nfile_general" data-toggle="tab" aria-expanded="false"><i
                    class="fa fa-info fw-r5"></i>General</a></li>
              <li class=""><a href="#tab_nfile_view" data-toggle="tab" aria-expanded="true"><i
                    class="fa fa-pencil fw-r5"></i>View</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_nfile_general">
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Title</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="file_title" class="form-control" type="text" placeholder="Title" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Description</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="file_description" class="form-control" rows="5"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Device Brand</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_device_brand" class="form-control" placeholder="Device Brand"
                      required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Device Model</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_device_model" class="form-control" placeholder="Device Model"
                      required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Android Version</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_android_version" class="form-control" placeholder="Android Version"
                      required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Firmware Version</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_firmware_version" class="form-control" placeholder="Firmware Version"
                      required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Chip Detail</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_chip_detail" class="form-control" placeholder="Chip Detail"
                      required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Country</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_country" class="form-control" placeholder="Country" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Language</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_language" class="form-control" placeholder="Language" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Support Tool</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="file_support_tool" class="form-control" placeholder="Support Tool"
                      required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Method</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="file_url_type"
                      onchange="$('.nfile_url_type_form').hide(); if($(this).val() !== '') $('.nfile_url_type_' + $(this).val()).show();"
                      required="">
                      <option value="" selected="">Link Type</option>
                      <option value="direct">Direct URL</option>
                      <option value="upload">File Upload</option>
                    </select>
                  </div>
                </div>
                <div class="form-group default-hidden nfile_url_type_form nfile_url_type_direct" style="display: none;">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Direct URL</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="direct_url" class="form-control" type="text" placeholder="Direct URL"
                      aria-required="true">
                  </div>

                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">File Size</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                      <input name="file_size" value="" class="form-control" type="number" step="any" min="0.01">
                      <span class="input-group-addon input-group-addon-select">
                        <select class="" name="file_size_unit">
                          <option value="Byte">Byte</option>
                          <option value="KB">KB</option>
                          <option value="MB">MB</option>
                          <option value="GB">GB</option>
                          <option value="TB">TB</option>

                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group default-hidden nfile_url_type_form nfile_url_type_upload" style="display: none;">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">File Upload</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="file_path" id="file_path" class="form-control" type="file">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-8 control-label">Paid</label>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <label class="pad-5">
                      <input name="is_paid" onchange="$('.nfile_price_form').toggle();" type="checkbox"
                        class="flat-green" value="Yes" data-iclass="icheckbox_flat-green">
                    </label>
                  </div>
                </div>
                <div class="form-group default-hidden nfile_price_form" style="display: none">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Price</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                      <input name="price" class="form-control" type="number" step="any" min="0.01" placeholder="0.00">
                      <span class="input-group-addon">USD</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-8 control-label">Featured</label>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <label class="pad-5">
                      <input name="is_featured" type="checkbox" class="flat-green" data-iclass="icheckbox_flat-green"
                        value="Yes">
                    </label>
                  </div>
                </div>
                <input type="hidden" name="file_manager_id" value="0">
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-8 control-label">Active</label>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <label class="pad-5">
                      <input name="is_active" type="checkbox" class="flat-green" data-iclass="icheckbox_flat-green"
                        checked value="Yes">
                    </label>
                  </div>
                </div>

              </div>


              <div class="tab-pane" id="tab_nfile_view">
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Thumbnail</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <label role="button">
                      <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon"></span>
                          <p>Drag and drop a file here or click</p>
                          <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                          <ul></ul>
                        </div><input class="form-control dropify" type="file" accept="image/*" name="file_thumbnail"
                          id="file_thumbnail"><button type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                          <div class="dropify-infos">
                            <div class="dropify-infos-inner">
                              <p class="dropify-filename"><span class="file-icon"></span> <span
                                  class="dropify-filename-inner"></span></p>
                              <p class="dropify-infos-message">Drag and drop or click to replace</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Image</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <label role="button">
                      <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon"></span>
                          <p>Drag and drop a file here or click</p>
                          <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                          <ul></ul>
                        </div><input class="form-control dropify" type="file" accept="image/*" name="file_image"
                          id="file_image"><button type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                          <div class="dropify-infos">
                            <div class="dropify-infos-inner">
                              <p class="dropify-filename"><span class="file-icon"></span> <span
                                  class="dropify-filename-inner"></span></p>
                              <p class="dropify-infos-message">Drag and drop or click to replace</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Tags</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="bootstrap-tagsinput"><input type="text" placeholder="Add Tags"></div><input type="text"
                      name="tags" id="tags" placeholder="Add Tags" data-role="tagsinput"
                      class=" form-control tags-input typeahead" style="display: none;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="folder_id" value="<?=isset($_GET['fid'])? $_GET['fid']:''?>">
          <div class="col-sm-12">
            <div class="progress progress-lg m-b-5">
              <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                aria-valuenow="0" id="progressbar1" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                0%
              </div>
            </div>
          </div>
          <button type="submit" id="insert_file" class="btn btn-success pull-left"><i class="fa fa-plus fw-r5"></i>
            Insert File</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="file-search-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title text-bold">Find Files and Folders</h5>
      </div>
      <form class="form-horizontal" method="get" id="search_form" action="https://gsmtechmaster.com/admin/bsearch">
        <input type="hidden" name="_token" value="VmP03xNnIHTI5MNCE2AMlzUouwvXCeWzbVj6nK3c">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Keyword</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="keyword" id="keyword" class="form-control" type="text" placeholder="Keyword">
              <span class="text-warning" id="keyword_error"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Include</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="search_in">
                <option value="all" selected>Files and Folders</option>
                <option value="files">Files only</option>
                <option value="folders">Folders only</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-8 control-label">Advanced</label>
            <div class="col-md-3 col-sm-3 col-xs-4">
              <label class="pad-5">
                <input name="is_advanced" onchange="$('.search_advanced_form').toggle();" value="1" type="checkbox"
                  class="flat-green" data-iclass="icheckbox_flat-green">
              </label>
            </div>
          </div>
          <div class="form-group default-hidden search_advanced_form" style="display: none;">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label">Status</label>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <select class="form-control" name="status">
                <option value="" selected>Any</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="form-group default-hidden search_advanced_form" style="display: none;">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Date</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="date">
                <option value="all" selected>All Time</option>
                <option value="1">Last 24 Hours</option>
                <option value="7">Last 7 Days</option>
                <option value="30">Last 30 Days</option>
                <option value="183">Last 6 Months</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class=" text-center">
            <button type="button" class="btn btn-lg btn-success" id="ser_button"><i
                class="fa fa-search fw-r5"></i>Search</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                class="fa fa-caret-down fw-r5"></i>Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="folder-update-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-pencil fw-r10"></i>Edit Folder</h5>
      </div>
      <form class="form-horizontal form-jsonp" id="folder_update_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_folder_id" id="update_folder_id">
        <div class="modal-body ready-place">
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="update_folder_title" id="update_folder_title" class="form-control" type="text"
                placeholder="Title" pattern=".{1,254}" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Description</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="update_folder_description" class="form-control" type="text" placeholder="Description"
                id="update_folder_description">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Thumbnail</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <label role="button">
                <img id="update_folder_thumbnail_src" class="image-form-control-100x90" src="">
                <input class="hidden" type="file" accept="image/*" name="update_folder_thumbnail"
                  id="update_folder_thumbnail">
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-8 control-label">Active</label>
            <div class="col-md-9 col-sm-9 col-xs-4">

              <label class="pad-5">
                <input name="update_folder_is_active" id="update_folder_is_active" type="checkbox" class="flat-green"
                  value="Yes" data-iclass="icheckbox_flat-green">
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="progress progress-lg m-b-5">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
              aria-valuenow="0" id="progressbar2" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
              0%
            </div>
          </div>
          <input type="hidden" name="fold_id1" id="fold_id1" value="">

          <button type="submit" class="btn btn-info pull-left" id="update_fold_btn"><i
              class="fa fa-check fw-r5"></i>Confirm Update</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="file-update-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-pencil fw-r10"></i> Edit File</h5>
      </div>
      <form class="form-horizontal form-jsonp" method="post" id="file_update_form" enctype="multipart/form-data">
        <input type="hidden" name="update_file_id" id="update_file_id" value="">
        <div class="modal-body">
          <div class="nav-tabs-custom no-margin border-none">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_ufile_general1" data-toggle="tab" aria-expanded="false"><i
                    class="fa fa-info fw-r5"></i>General</a></li>
              <li class=""><a href="#tab_ufile_view1" data-toggle="tab" aria-expanded="true"><i
                    class="fa fa-pencil fw-r5"></i>View</a></li>
            </ul>
            <div class="tab-content ready-place1">
              <div class="tab-pane active" id="tab_nfile_general">
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Title</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="update_file_title" id="update_file_title" class="form-control" type="text"
                      placeholder="Title" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Description</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="update_file_description" id="update_file_description" class="form-control"
                      rows="5"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Device Brand</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_device_brand" id="update_file_device_brand"
                      class="form-control" placeholder="Device Brand" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Device Model</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_device_model" id="update_file_device_model"
                      class="form-control" placeholder="Device Model" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Android Version</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_android_version" id="update_file_android_version"
                      class="form-control" placeholder="Android Version" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Firmware Version</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_firmware_version" id="update_file_firmware_version"
                      class="form-control" placeholder="Firmware Version" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Chip Detail</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_chip_detail" id="update_file_chip_detail" class="form-control"
                      placeholder="Chip Detail" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Country</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_country" id="update_file_country" class="form-control"
                      placeholder="Country" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Language</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_language" id="update_file_language" class="form-control"
                      placeholder="Language" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Support Tool</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_support_tool" id="update_file_support_tool"
                      class="form-control" placeholder="Support Tool" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Method</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="update_file_url_type" id="update_file_url_type"
                      onchange="$('.ufile_url_type_form').hide(); if($(this).val() !== '') $('.ufile_url_type_' + $(this).val()).show();"
                      required="">
                      <option value="" selected="">Link Type</option>
                      <option value="direct">Direct URL</option>
                      <option value="upload">File Upload</option>
                    </select>
                  </div>
                </div>
                <div class="form-group default-hidden ufile_url_type_form ufile_url_type_direct" style="display: none;">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Direct URL</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="update_file_direct_url" id="update_file_direct_url" class="form-control" type="text"
                      placeholder="Direct URL" aria-required="true">
                  </div>

                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">File Size</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                      <input name="update_file_size" id="update_file_size" value="" class="form-control" type="number"
                        step="any">
                      <span class="input-group-addon input-group-addon-select">
                        <select class="" name="update_file_size_unit" id="update_file_size_unit">
                          <option value="Byte">Byte</option>
                          <option value="KB">KB</option>
                          <option value="MB">MB</option>
                          <option value="GB">GB</option>
                          <option value="TB">TB</option>

                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group default-hidden ufile_url_type_form ufile_url_type_upload" style="display: none;">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">File Upload</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="update_file_path" id="update_file_path" class="form-control" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-8 control-label">Paid</label>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <label class="pad-5">
                      <input name="update_file_is_paid" id="update_file_is_paid"
                        onchange="$('.ufile_price_form').toggle();" type="checkbox" class="flat-green" value="Yes"
                        data-iclass="icheckbox_flat-green">
                    </label>
                  </div>
                </div>
                <div class="form-group default-hidden ufile_price_form" style="display: none">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Price</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                      <input name="update_file_price" id="update_file_price" class="form-control" type="number"
                        step="any" placeholder="0.00">
                      <span class="input-group-addon">USD</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-8 control-label">Featured</label>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <label class="pad-5">
                      <input name="update_file_is_featured" id="update_file_is_featured" type="checkbox"
                        class="flat-green" data-iclass="icheckbox_flat-green" value="Yes">
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-8 control-label">Active</label>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <label class="pad-5">
                      <input name="update_file_is_active" id="update_file_is_active" type="checkbox" class="flat-green"
                        data-iclass="icheckbox_flat-green" value="Yes">
                    </label>
                  </div>
                </div>

              </div>


              <div class="tab-pane" id="tab_nfile_view">
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Thumbnail</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <label role="button">
                      <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon"></span>
                          <p>Drag and drop a file here or click</p>
                          <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                          <ul></ul>
                        </div>
                        <input class="form-control dropify" type="file" accept="image/*" name="update_file_thumbnail"
                          id="update_file_thumbnail"><button type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                          <div class="dropify-infos">
                            <div class="dropify-infos-inner">
                              <p class="dropify-filename"><span class="file-icon"></span> <span
                                  class="dropify-filename-inner"></span></p>
                              <p class="dropify-infos-message">Drag and drop or click to replace</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Image</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <label role="button">
                      <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon"></span>
                          <p>Drag and drop a file here or click</p>
                          <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                          <ul></ul>
                        </div><input class="form-control dropify" type="file" accept="image/*" name="update_file_image"
                          id="update_file_image"><button type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                          <div class="dropify-infos">
                            <div class="dropify-infos-inner">
                              <p class="dropify-filename"><span class="file-icon"></span> <span
                                  class="dropify-filename-inner"></span></p>
                              <p class="dropify-infos-message">Drag and drop or click to replace</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">Tags</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="bootstrap-tagsinput"><input type="text" placeholder="Add Tags"></div><input type="text"
                      name="update_file_tags" id="update_file_tags" placeholder="Add Tags" data-role="tagsinput"
                      class=" form-control tags-input typeahead" style="display: none;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info pull-left"><i class="fa fa-check fw-r5"></i>Confirm Update</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="folder-info-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header pad-10 bg-blue">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-info fw-r10"></i> Folder Info</h5>
      </div>
      <div class="modal-body form-horizontal pad-5 ready-place">
        <div class="form-group no-margin">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label">Title</label>
          <div class="col-md-9 col-sm-9 col-xs-12" id="fold_title">

          </div>
        </div>
        <div class="form-group no-margin">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label">Description</label>
          <div class="col-md-9 col-sm-9 col-xs-12" id="fold_descrip">

          </div>
        </div>
        <div class="form-group no-margin">
          <label class="col-md-3 col-sm-3 col-xs-8 control-label">Badges</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <p class="form-control form-control-c" id="badge">

            </p>
          </div>
        </div>
        <div class="form-group no-margin">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label">Created</label>
          <div class="col-md-9 col-sm-9 col-xs-12" id="fold_creat">

          </div>
        </div>
        <div class="form-group no-margin">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label">Created By</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <a class="form-control form-control-c" href="#">admin</a>
          </div>
        </div>
      </div>
      <div class="modal-footer pad-5">
        <input type="hidden" id="fold_info">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
            class="fa fa-caret-down fw-r5"></i>Close</button>
      </div>
    </div>
  </div>
</div>

<div id="file-info-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header pad-10 bg-blue">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-info fw-r10"></i> File Info</h5>
      </div>
      <div class="modal-body form-horizontal pad-5 ready-place_file">

      </div>
      <div class="modal-footer pad-5">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
            class="fa fa-caret-down fw-r5"></i>Close</button>
      </div>
    </div>
  </div>
</div>
<div id="file-view-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header pad-10 bg-green">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-file fw-r10"></i>File</h5>
      </div>
      <div class=" ready-place">
      </div>
    </div>
  </div>
</div>

<div id="element-delete-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-minus fw-r10"></i>Delete Item/s</h5>
      </div>
      <div class="modal-body">
        <p class="alert alert-danger no-margin">Are you sure you want to delete selected item/s ?</p>
      </div>

      <div class="modal-footer">

        <input type="hidden" name="fold_id2" id="fold_id2" value="">

        <button type="button" id="delete_folder" class="btn btn-danger pull-left"><i
            class="fa fa-minus fw-r5"></i>Delete</button>
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
            class="fa fa-caret-down fw-r5"></i>Cancel</button>
      </div>

    </div>
  </div>
</div>
<div id="file-delete-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-minus fw-r10"></i>Delete Item/s</h5>
      </div>
      <div class="modal-body">
        <p class="alert alert-danger no-margin">Are you sure you want to delete selected item/s ?</p>
      </div>

      <div class="modal-footer">



        <button type="button" id="delete_file" class="btn btn-danger pull-left"><i
            class="fa fa-minus fw-r5"></i>Delete</button>
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
            class="fa fa-caret-down fw-r5"></i>Cancel</button>
      </div>

    </div>
  </div>
</div>



<div id="element-options-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cogs fw-r10"></i> Set Options</h5>
      </div>
      <form id="elements_options_form" action="https://gsmtechmaster.com/admin/files/folderstatus"
        class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="VmP03xNnIHTI5MNCE2AMlzUouwvXCeWzbVj6nK3c">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Status</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="is_active">
                <option value="No Change" selected>No Change</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="folder_status_id" id="update_fold_status">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check fw-r5"></i>Confirm</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="file-options-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cogs fw-r10"></i> Set Options</h5>
      </div>
      <form action="https://gsmtechmaster.com/admin/files/filestatus" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="VmP03xNnIHTI5MNCE2AMlzUouwvXCeWzbVj6nK3c">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Status</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="is_active">
                <option value="No Change" selected>No Change</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="file_status_id" id="file_status_id">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check fw-r5"></i>Confirm</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div id="file-move-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cogs fw-r10"></i> &nbsp;Set Options</h5>
      </div>
      <form action="https://gsmtechmaster.com/admin/files/movefiles" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="VmP03xNnIHTI5MNCE2AMlzUouwvXCeWzbVj6nK3c">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Move to</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select class="form-control" name="mov_fold_id" id="folders_name">

              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="move_file_id" id="move_file_id">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check fw-r5"></i>Move</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div id="file-copy-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cogs fw-r10"></i> &nbsp;Set Options</h5>
      </div>
      <form action="https://gsmtechmaster.com/admin/files/copyfiles" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="VmP03xNnIHTI5MNCE2AMlzUouwvXCeWzbVj6nK3c">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Copy to</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select class="form-control" name="copy_fold_id" id="copy_folders_name">

              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="copy_file_id" id="copy_file_id">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check fw-r5"></i>Copy</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div id="folder-copy-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cogs fw-r10"></i> &nbsp;Set Options</h5>
      </div>
      <form action="https://gsmtechmaster.com/admin/files/copyfolder" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="VmP03xNnIHTI5MNCE2AMlzUouwvXCeWzbVj6nK3c">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Copy to</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select class="form-control" name="copy_fold_id" id="copy_folders_name1">

              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="copy_folder_id" id="copy_folder_id">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check fw-r5"></i>Copy</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div id="folder-move-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cogs fw-r10"></i> &nbsp;Move Folder</h5>
      </div>
      <form class="form-horizontal" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 col-sm-4 col-xs-12 control-label">Move to</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select class="form-control" name="move_fold_id" id="move_folders_name1">

              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="move_folder_id" id="move_folder_id">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check fw-r5"></i>Move</button>
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
              class="fa fa-caret-down fw-r5"></i>Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="translations-update-modal" class="modal fade modal-dialog-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-language fw-r10"></i>Translation</h5>
      </div>
      <div class="ready-place">

      </div>
    </div>
  </div>
</div>

<div id="upload-bar-modal" class="modal fade modal-dialog-form" role="dialog" data-backdrop="static"
  data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-light-blue pad-10">
        <h5 class="modal-title"><i class="fa fa-upload fw-r10"></i>Uploading</h5>
      </div>
      <div class="modal-body">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <p><span class="upload-progress-percent">0%</span> Completed</p>
          <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0"
              aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer pad-10">
        <button type="button" class="btn btn-danger pull-right upload-cancel-button"><i class="fa fa-ban fw-r5"></i>
          Cancel</button>
      </div>
    </div>
  </div>
</div>


<?php include '../layout/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>

<script>
  let onHiddenToast = () => {
    location.reload();
  }
  $("#folder_form").submit(function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    let files = $('#folder_thumb')[0].files[0];
    formData.append('folder_thumb', files);
    formData.append('action', 'create-folder');

    $.ajax({
      type: 'POST',
      url: '<?=BASE_URL?>actions/fileManager.php',
      data: formData,
      dataType: 'json',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 'ok') {
          toastr.success('', data.msg, {
            timeOut: 3000,
            onHidden: onHiddenToast
          });
          // alert('Success: ' + data.msg);
        } else if (data.status == 'err') {
          toastr.error('', data.msg, {
            timeOut: 5000
          });
        }
      },
      complete: function () {
        // location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.success('Success: ', "Some problem occurred, please try again.", {
          timeOut: 5000,
        });
      }
    });
  });

  // New File Upload
  $("#new_file_upload").submit(function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    formData.append('action', 'create-file');
    let file_path = $('#file_path')[0].files[0];
    let file_thumbnail = $('#file_thumbnail')[0].files[0];
    let file_image = $('#file_image')[0].files[0];
    formData.append('file_path', file_path);
    formData.append('file_thumbnail', file_thumbnail);
    formData.append('file_image', file_image);
    $.ajax({
      type: 'POST',
      url: '<?=BASE_URL?>actions/fileManager.php',
      data: formData,
      dataType: 'json',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 'ok') {
          toastr.success('', data.msg, {
            timeOut: 3000,
            onHidden: onHiddenToast

          });
        } else if (data.status == 'err') {
          toastr.error('', data.msg, {
            timeOut: 5000
          });
        }
      },
      complete: function () {},
      error: function (jqXHR, textStatus, errorThrown) {
        alert("Some problem occurred, please try again.");
      }
    });
  });

  // Folder Update/Edit
  $("#folder_update_form").submit(function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    let update_folder_thumbnail = $('#update_folder_thumbnail')[0].files[0];
    formData.append('update_folder_thumbnail', update_folder_thumbnail);
    formData.append('action', 'update-folder');

    $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: '<?=BASE_URL?>actions/fileManager.php',
      data: formData,
      dataType: 'json',
      contentType: false,
      // cache: false,
      processData: false,
      success: function (data) {
        if (data.status == true) {
          toastr.success('', data.msg, {
            timeOut: 3000,
            onHidden: onHiddenToast
          });
        } else if (data.status == false) {
          toastr.error('', data.msg, {
            timeOut: 5000
          });
        }
      },
      complete: function () {},
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.error('', "Some problem occurred, please try again.", {
          timeOut: 5000
        });
      }
    });
  });

  // File Update/Edit
  $("#file_update_form").submit(function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    formData.append('action', 'update-file');
    // let file_path = $('#file_update_path')[0].files[0];
    let file_thumbnail = $('#update_file_thumbnail')[0].files[0];
    let file_image = $('#update_file_image')[0].files[0];
    // formData.append('file_path', file_path);
    formData.append('file_thumbnail', file_thumbnail);
    formData.append('file_image', file_image);
    $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: '<?=BASE_URL?>actions/fileManager.php',
      data: formData,
      dataType: 'JSON',
      contentType: false,
      // cache: false,
      processData: false,
      success: function (data) {
        if (data.status == true) {
          toastr.success('', data.msg, {
            timeOut: 3000,
            onHidden: onHiddenToast
          });
        } else if (data.status == false) {
          toastr.error('', data.msg, {
            timeOut: 5000
          });
        }
      },
      complete: function () {},
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.error('', "Some problem occurred, please try again.", {
          timeOut: 5000
        });
      }
    });
  });

  // folder context menu
  $.contextMenu({
    selector: '.folder-context-menu',
    items: {
      open: {
        name: "Open",
        icon: "folder-open",
        callback: function (key, opt) {
          let id = $('.context-menu-active').attr('data-id');
          location.replace(location.pathname + '?fid=' + id);
        }
      },
      edit: {
        name: "Edit",
        icon: "edit",
        callback: function (key, opt) {
          let fid = $('.context-menu-active').attr('data-id');
          $.ajax({
            type: 'POST',
            url: '<?=BASE_URL?>actions/fileManager.php',
            data: {
              fid: fid,
              action: 'get-folder-by-id'
            },
            dataType: 'JSON',
            success: function (data) {
              $('#update_folder_id').val(data.id);
              $('#update_folder_title').val(data.title);
              $('#update_folder_description').val(data.description);
              $('#update_folder_thumbnail_src').attr("src",
                "<?=BASE_URL?>files/icons/folder-icon-default.png");
              if (data.is_active === 'Yes') {
                $('#update_folder_is_active').attr("checked", "checked");
              }
              $('#folder-update-modal').modal("show");
            },
            complete: function () {},
            error: function (jqXHR, textStatus, errorThrown) {
              toastr.error('', "Some problem occurred, please try again.", {
                timeOut: 5000
              });
            }
          });
        }
      },
      move: {
        name: "Move",
        icon: "move",
        callback: function (key, opt) {
          $('#folder-move-modal').modal("show");
        }
      },
      copy: {
        name: "Copy",
        icon: "copy",
        callback: function (key, opt) {
          let id = $('.context-menu-active').attr('data-id');
          $('#folder-copy-modal').modal("show");
        }
      },
      delete: {
        name: "Delete",
        icon: "delete",
        callback: function (key, opt) {
          let id = $('.context-menu-active').attr('data-id');
          // $('.context-menu-icon-delete').confirmOn({
          //   questionText: 'Are You Sure, Yow Want to Delete This Folder?',
          //   textYes: 'Yes, I\'m sure',
          //   textNo: 'No, I\'m not sure'
          // }, 'click', function (e, confirmed) {
          //   if (confirmed) {
          //     console.log("deleted" + id);
          //   };
          // });
          $('#folder-delete-modal').modal("show");
        }
      },
      options: {
        name: "Options",
        icon: "cogs",
        callback: function (key, opt) {
          $('#element-options-modal').modal("show");
        }
      },
      info: {
        name: "Info",
        icon: "info",
        callback: function (key, opt) {
          $('#folder-info-modal').modal("show");
        }
      }
    }
  });

  // $('#testConfirmation').confirmOn({
  //   questionText: 'Are You Sure, Yow Want to Delete This Folder?',
  //   textYes: 'Yes, I\'m sure',
  //   textNo: 'No, I\'m not sure'
  // }, 'click', function (e, confirmed) {
  //   if (confirmed) {
  //     console.log("deleted");
  //   };
  // });

  // file context menu
  $.contextMenu({
    selector: '.file-context-menu',
    items: {
      open: {
        name: "Open",
        icon: "file-open",
        callback: function (key, opt) {
          // let id = $('.context-menu-active').attr('data-id');
          // location.replace(location.href + '?fid=' + id);
        }
      },
      edit: {
        name: "Edit",
        icon: "edit",
        callback: function (key, opt) {
          let fid = $('.context-menu-active').attr('data-id');
          $.ajax({
            type: 'POST',
            url: '<?=BASE_URL?>actions/fileManager.php',
            data: {
              fid: fid,
              action: 'get-file-by-id'
            },
            dataType: 'JSON',
            success: function (data) {
              $('#update_file_id').val(data.id);
              $('#update_file_title').val(data.title);
              $('#update_file_description').val(data.description);
              $('#update_file_device_brand').val(data.device_brand);
              $('#update_file_device_model').val(data.device_model);
              $('#update_file_android_version').val(data.android_version);
              $('#update_file_firmware_version').val(data.firmware_version);
              $('#update_file_chip_detail').val(data.chip_detail);
              $('#update_file_country').val(data.country);
              $('#update_file_language').val(data.language);
              $('#update_file_support_tool').val(data.support_tool);
              $('#update_file_url_type').val(data.file_method).change();
              $('#update_file_direct_url').val(data.direct_url);
              $('#update_file_path').val(data.file);
              $('#update_file_size').val(data.file_size);
              $('#update_file_size_unit').val(data.file_size_unit).change();
              $('#update_file_price').val(data.price);
              (data.is_paid === 'Yes') ? $('#update_file_is_paid').attr("checked", "checked"):
                $('#update_file_is_paid').removeAttr("checked");
              (data.is_featured === 'Yes') ? $('#update_file_is_featured').attr("checked", "checked"):
                $('#update_file_is_featured').removeAttr("checked");
              (data.is_active === 'Yes') ? $('#update_file_is_active').attr("checked", "checked"):
                $('#update_file_is_active').removeAttr("checked");

              $('#file-update-modal').modal("show");
            },
            complete: function () {
              // location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert("Some problem occurred, please try again.");
            }
          });
        }
      },
      move: {
        name: "Move",
        icon: "move",
        callback: function (key, opt) {
          $('#file-move-modal').modal("show");
        }
      },
      copy: {
        name: "Copy",
        icon: "copy",
        callback: function (key, opt) {
          $('#file-copy-modal').modal("show");
          let id = $('.context-menu-active').attr('data-id');
        }
      },
      delete: {
        name: "Delete",
        icon: "delete",
        callback: function (key, opt) {
          $('#file-delete-modal').modal("show");

        }
      },
      options: {
        name: "Options",
        icon: "cogs",
        callback: function (key, opt) {
          $('#file-options-modal').modal("show");
        }
      },
      info: {
        name: "Info",
        icon: "info",
        callback: function (key, opt) {
          $('#file-info-modal').modal("show");
        }
      }
    }
  });
</script>
<?php include '../layout/foot-scripts.php'; ?>