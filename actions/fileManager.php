<?php
include('../functions/fileManager.php');
include('../conf/dbConfig.php');
if(isset($_POST['action']) && $_POST['action'] == 'create-download-history'){
    $file_id = trim($_POST['file_id']); 
    $file_size = trim($_POST['file_size']); 
    $file_size_unit = trim($_POST['file_size_unit']); 
    $user_type = trim($_POST['user_type']); 
    $user_id = trim($_POST['user_id']);
    if(create_download_history($conn, $file_id, $file_size, $file_size_unit, $user_type, $user_id, $ip=getIPAddress())==TRUE){
        die;
    }else{
        die('error');
    }
    
}
?>