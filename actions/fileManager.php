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
if(isset($_POST['action']) && $_POST['action'] == 'create-file-request'){
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']); 
    $phone = trim($_POST['phone']); 
    $subject = trim($_POST['subject']); 
    $message = trim($_POST['message']);
    $create_file_request = create_file_request($conn, $name=$name, $email=$email, $phone=$phone, $subject=$subject, $message=$message);
    if($create_file_request==TRUE){
        $msg = "Your File Request Has Been Sent. Thank You.";
        $status = TRUE;
    }else{
        $msg = "Something Went Wrong, Please Try Again Later";
        $status = FALSE;
    }
    die(json_encode(array("status"=>$status, "msg"=>$msg))); 
}
if(isset($_POST['action']) && $_POST['action'] == 'create-contact'){
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']); 
    $phone = trim($_POST['phone']); 
    $subject = trim($_POST['subject']); 
    $message = trim($_POST['message']);
    $create_contact = create_contact($conn, $name=$name, $email=$email, $phone=$phone, $subject=$subject, $message=$message);
    if($create_contact==TRUE){
        $msg = "Your Message Has Been Sent. Thank You.";
        $status = TRUE;
    }else{
        $msg = "Something Went Wrong, Please Try Again Later";
        $status = FALSE;
    }
    die(json_encode(array("status"=>$status, "msg"=>$msg))); 
}
?>