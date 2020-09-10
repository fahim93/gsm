<?php define('BASE_URL', 'http://localhost/gsm/admin/'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/gsm/admin/urls.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>GSM | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.4 -->
  <link href="<?=BASE_URL?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?=BASE_URL?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link href="<?=BASE_URL?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link href="<?=BASE_URL?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
  <!-- Morris chart -->
  <link href="<?=BASE_URL?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
  <!-- jvectormap -->
  <link href="<?=BASE_URL?>plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
  <!-- Date Picker -->
  <link href="<?=BASE_URL?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- Daterange picker -->
  <link href="<?=BASE_URL?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <!-- bootstrap wysihtml5 - text editor -->
  <link href="<?=BASE_URL?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="<?=BASE_URL?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="<?=BASE_URL?>dist/css/custom/files.css" rel="stylesheet" type="text/css" />
  <link href="<?=BASE_URL?>dist/css/custom/drophy.css" rel="stylesheet" type="text/css" />
  <!-- Toastr -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"
    type="text/css" />
  <!-- contextmenu -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

  <!-- Confirmation -->
  <link href="<?=BASE_URL?>plugins/confirmation/jquery.confirmon.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!-- Section CSS -->
  <!-- jQuery UI (REQUIRED) -->
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/jquery/jquery-ui-1.12.0.css" type="text/css">

  <!-- elfinder css -->
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/commands.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/common.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/contextmenu.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/cwd.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/dialog.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/fonts.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/navbar.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/places.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/quicklook.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/statusbar.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/theme.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/toast.css" type="text/css">
  <link rel="stylesheet" href="<?=BASE_URL?>elFinder/css/toolbar.css" type="text/css">
</head>

<body class="skin-blue sidebar-mini">
  <div class="wrapper">