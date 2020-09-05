<?php include '../layout/header.php'; ?>
<?php include '../layout/top-navbar.php'; ?>
<?php include '../layout/left-sidebar.php'; ?>
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
      <div class="col-xs-12">
        <div class="box">
          <!-- <div class="box-header">
            <h3 class="box-title">File Manager</h3>
          </div> -->
          <!-- /.box-header -->
          <div class="box-body">
            <div id="elfinder"></div>
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

<?php include '../layout/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>

<!-- Section JavaScript -->
<!-- jQuery and jQuery UI (REQUIRED) -->
<!-- <script src="jquery/jquery-1.12.4.js" type="text/javascript" charset="utf-8"></script> -->
<!-- <script src="jquery/jquery-ui-1.12.0.js" type="text/javascript" charset="utf-8"></script> -->

<!-- elfinder core -->
<script src="<?=BASE_URL?>elFinder/js/elFinder.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.version.js"></script>
<script src="<?=BASE_URL?>elFinder/js/jquery.elfinder.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.mimetypes.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.options.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.options.netmount.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.history.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.command.js"></script>
<script src="<?=BASE_URL?>elFinder/js/elFinder.resources.js"></script>

<!-- elfinder dialog -->
<script src="<?=BASE_URL?>elFinder/js/jquery.dialogelfinder.js"></script>

<!-- elfinder default lang -->
<script src="<?=BASE_URL?>elFinder/js/i18n/elfinder.en.js"></script>

<!-- elfinder ui -->
<script src="<?=BASE_URL?>elFinder/js/ui/button.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/contextmenu.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/cwd.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/dialog.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/fullscreenbutton.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/navbar.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/navdock.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/overlay.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/panel.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/path.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/places.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/searchbutton.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/sortbutton.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/stat.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/toast.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/toolbar.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/tree.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/uploadButton.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/viewbutton.js"></script>
<script src="<?=BASE_URL?>elFinder/js/ui/workzone.js"></script>

<!-- elfinder commands -->
<script src="<?=BASE_URL?>elFinder/js/commands/archive.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/back.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/chmod.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/colwidth.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/copy.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/cut.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/download.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/duplicate.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/edit.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/empty.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/extract.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/forward.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/fullscreen.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/getfile.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/help.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/hidden.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/hide.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/home.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/info.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/mkdir.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/mkfile.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/netmount.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/open.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/opendir.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/opennew.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/paste.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/places.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/preference.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/quicklook.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/quicklook.plugins.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/reload.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/rename.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/resize.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/restore.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/rm.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/search.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/selectall.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/selectinvert.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/selectnone.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/sort.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/undo.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/up.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/upload.js"></script>
<script src="<?=BASE_URL?>elFinder/js/commands/view.js"></script>

<!-- elfinder 1.x connector API support (OPTIONAL) -->
<script src="<?=BASE_URL?>elFinder/js/proxy/elFinderSupportVer1.js"></script>

<!-- Extra contents editors (OPTIONAL) -->
<script src="<?=BASE_URL?>elFinder/js/extras/editors.default.js"></script>

<!-- GoogleDocs Quicklook plugin for GoogleDrive Volume (OPTIONAL) -->
<script src="<?=BASE_URL?>elFinder/js/extras/quicklook.googledocs.js"></script>

<!-- elfinder initialization  -->
<script>
  $(function () {
    $('#elfinder').elfinder(
      // 1st Arg - options
      {
        // Disable CSS auto loading
        cssAutoLoad: false,

        // Base URL to css/*, js/*
        baseUrl: './',

        // Connector URL
        url: '<?=BASE_URL?>elFinder/php/connector.minimal.php',

        commands: [
          'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
          'download', 'rm', 'duplicate', 'rename', 'mkdir', 'mkfile', 'upload', 'copy',
          'cut', 'paste', 'edit', 'extract', 'archive', 'search', 'info', 'view', 'help', 'resize', 'sort',
          'netmount'
        ],

        // Callback when a file is double-clicked
        getFileCallback: function (file) {
          // ...
        },
      },

      // 2nd Arg - before boot up function
      function (fm, extraObj) {
        // `init` event callback function
        fm.bind('init', function () {
          // Optional for Japanese decoder "extras/encoding-japanese.min"
          delete fm.options.rawStringDecoder;
          if (fm.lang === 'ja') {
            fm.loadScript(
              [fm.baseUrl + 'js/extras/encoding-japanese.min.js'],
              function () {
                if (window.Encoding && Encoding.convert) {
                  fm.options.rawStringDecoder = function (s) {
                    return Encoding.convert(s, {
                      to: 'UNICODE',
                      type: 'string'
                    });
                  };
                }
              }, {
                loadType: 'tag'
              }
            );
          }
        });

        // Optional for set document.title dynamically.
        var title = document.title;
        fm.bind('open', function () {
          var path = '',
            cwd = fm.cwd();
          if (cwd) {
            path = fm.path(cwd.hash) || null;
          }
          document.title = path ? path + ':' + title : title;
        }).bind('destroy', function () {
          document.title = title;
        });
      }
    );
  });
</script>

<?php include '../layout/foot-scripts.php'; ?>