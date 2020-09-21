<?php define('BASE_URL', 'http://localhost/gsm/'); ?>
<?php session_start(); ?>
<?php define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/gsm/'); ?>
<?php include(ROOT_PATH.'urls.php'); ?>
<?php include(ROOT_PATH.'conf/dbConfig.php'); ?>
<?php include(ROOT_PATH.'functions/common.php'); ?>
<?php include(ROOT_PATH.'functions/custom-functions.php'); ?>
<?php
function is_logged_in(){
    include(ROOT_PATH.'conf/dbConfig.php');
    if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == TRUE && isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != '' && isset($_SESSION['token']) && $_SESSION['token'] != ''){
        $customer_id = $_SESSION['customer_id'];
        $token = $_SESSION['token'];
        $qry = "SELECT * FROM customers WHERE id = $customer_id AND token = '$token'";
        $rs = $conn->query($qry)->fetch_assoc();
        if(!empty($rs)){
            return TRUE;
        }
        return FALSE;
    }
}
if(is_logged_in()){
    $customer_id = $_SESSION['customer_id'];
    $user_type = 'Registered';
}else{
    $customer_id = '';
    $user_type = 'Anonymous';
}
?>
<?php
$interface_setup = get_objects($conn, $table_name='interface_setup');
$system_setup = get_objects($conn, $table_name='system_setup');
if(isset($interface_setup) && $interface_setup->num_rows==1){
    $is = $interface_setup->fetch_assoc();
    $language = $is['language'];
    $skin = $is['skin'];
    $default_password = $is['default_password'];
    $show_new_days = $is['show_new_days'];
    $footer_text = $is['footer_text'];
    $copyright = $is['copyright'];
    $header_contact = $is['header_contact'];
    $footer_contact = $is['footer_contact'];
    $switch_language = $is['switch_language'];
    $enable_review = $is['enable_review'];
    $facebook_url = $is['facebook_url'];
    $youtube_url = $is['youtube_url'];
    $twitter_url = $is['twitter_url'];
    $linkedin_url = $is['linkedin_url'];
    $instagram_url = $is['instagram_url'];
    $image_slider = $is['image_slider'];
    $download_search = $is['download_search'];
    $download_folder = $is['download_folder'];
    $feature_and_arrival = $is['feature_and_arrival'];
    $best_sells = $is['best_sells'];
    $top_feature_product = $is['top_feature_product'];
    $top_and_recent_file_list = $is['top_and_recent_file_list'];
    $our_partner = $is['our_partner'];
    $active = $is['active'];
}
if(isset($system_setup) && $system_setup->num_rows==1){
    $ss = $system_setup->fetch_assoc();
    $site_title = $ss['site_title'];
    $site_url = $ss['site_url'];
    $site_logo = $ss['site_logo'];
    $lazy_image = $ss['lazy_image'];
    $default_folder_icon = $ss['default_folder_icon'];
    $default_file_thumbnail = $ss['default_file_thumbnail'];
    $og_image = $ss['og_image'];
    $fav_icon = $ss['fav_icon'];
    $meta_tag = $ss['meta_tag'];
    $meta_description = $ss['meta_description'];
    $support_email = $ss['support_email'];
    $contact_email = $ss['contact_email'];
    $technical_email = $ss['technical_email'];
    $billing_email = $ss['billing_email'];
    $currency_code = $ss['currency_code'];
    $currency_format = $ss['currency_format'];
    $currency_decimal = $ss['currency_decimal'];
    $maximum_pending_order = $ss['maximum_pending_order'];
    $allow_registration = $ss['allow_registration'];
    $mail_verification = $ss['mail_verification'];
    $captcha_active = $ss['captcha_active'];
    $lazy_active = $ss['lazy_active'];
    $balance_order = $ss['balance_order'];
    $balance_transfer = $ss['balance_transfer'];
    $show_partner = $ss['show_partner'];
    $show_recent_file = $ss['show_recent_file'];
    $show_top_file = $ss['show_top_file'];
    $show_announcement = $ss['show_announcement'];
    $login_download = $ss['login_download'];
    $free_download_size = $ss['free_download_size'];
    $size_unit = $ss['size_unit'];
    $size_in_bytes = $ss['size_in_bytes'];
    $file_limit = $ss['file_limit'];
    $theme_color = $ss['theme_color'];
    $theme_text = $ss['theme_text'];
    $top_bar_color = $ss['top_bar_color'];
    $menu_bar_color = $ss['menu_bar_color'];
    $header_color = $ss['header_color'];
    $news_part = $ss['news_part'];
    $folder_color = $ss['folder_color'];
    $footer_color = $ss['footer_color'];
    $footer_bar_color = $ss['footer_bar_color'];
    $show_map = $ss['show_map'];
    $map_url = $ss['map_url'];
    $is_email_verified = $ss['is_email_verified'];
    $is_active = $ss['is_active'];
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from gsmtechmaster.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Mar 2020 08:43:28 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="author" content="GSM Tech Master">
<meta name="csrf-token" content="gLdAU1gEIfekAy6woZ620rVvGrheZOoPHAxoGVYe">
<meta name="keywords"
    content="GSM Tech Master Soft,Samsung Firmware,Huawei Firmware,HTC Firmware,Samsung Combination,Clone Firmware Flash File,Symphony Customer Care Firmware,Walton Customer Care Firmware,Logo Fix Firmware, Dead Recovey Flash File,LCD Fix Firmware Flash File,Root File TWRP,Mi Cloud Clean Rom,Xiaomi Downgrade Firmware,MIUI 10 Firmware,Bootloader Unlock File,">
<meta name="robots" content="all,index,follow,snippet,archive,odp">
<meta name="og:title" content="GSM Tech Master">
<meta name="og:image" content="<?=isset($og_image) ? BASE_URL.$og_image : ''?>">
<meta name="og:description"
    content="Welcome To GSM Tech Master Official Download Server, Hare You Can Find Firmware Flash File,SAMSUNG Firmware,SAMSUNG Combination,Customer Care Firmware,All Root File,MTK Clone Firmware, Xiaomi Firmware,Huawei Firmware,Also All GTM Tested Firmware And Solution, FRP Remove File And Solution">

<title><?=isset($site_title) ? $site_title : ''?></title>
<!-- 'theme_color','theme_text','top_bar','folder','manu_bar','footer_color','' -->

<style>
    :root {
        --main-bg-color: #33BD25;
        /* themecolor */
        --main-ft-color: <?=isset($footer_color) ? $footer_color: '#101010'?>;
        --main-folder-color: <?=isset($footer_color) ? $footer_color: '#101010'?>;
        --title-nav: #33BD25;
        --top-bar: <?=isset($top_bar_color) ? $top_bar_color: '#222'?>;
        --top-bar-header: <?=isset($header_color) ? $header_color: '#222'?>;
        --top-bar-menu: <?=isset($menu_bar_color) ? $menu_bar_color: '#222'?>;
        --footer-background: <?=isset($footer_bar_color) ? $footer_bar_color: '#222'?>;
        --copyright-background: #101010;
        --news-part: <?=isset($news_part) ? $news_part: '#101010'?>;
    }
</style>
<link rel="shortcut icon" href="<?=isset($fav_icon) ? BASE_URL.$fav_icon : ''?>">

<link rel="stylesheet" href="<?=BASE_URL?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/components/fancybox/jquery.fancybox.min.css">

<link rel="stylesheet" href="<?=BASE_URL?>assets/css/style.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/main.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/server.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/owl.transitions.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/font-awesome.min.css">

<!-- Bootstrap-select  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
<!-- Bootstrap-select-country  -->
<link rel="stylesheet" href="<?=BASE_URL?>plugins/bootstrap-select-country-4.2.0/css/bootstrap-select-country.min.css">

    

<!-- simple-list-grid -->
<!-- <link rel="stylesheet" href="<?=BASE_URL?>assets/css/simple-list-grid/simple-list-grid.css"> -->

<!-- Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<style>
    #owl-main .owl-wrapper {
        margin-bottom: 0px !important;
    }
</style>
</head>

<body class="page-home">