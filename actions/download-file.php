<?php
// echo json_encode($_POST['data']); die;
if(isset($_POST['action']) && $_POST['action'] == 'download-file'){
    $file_src = trim($_POST['file_src']);
    $file_id = trim($_POST['file_id']); 
    $file_size = trim($_POST['file_size']); 
    $file_size_unit = trim($_POST['file_size_unit']); 
    $user_type = trim($_POST['user_type']); 
    $user_id = trim($_POST['user_id']);
    
    // $file = $file_src;
    // $filetype=filetype($file);
    // $filename=basename($file);
    // header ("Content-Type: ".$filetype);
    // header ("Content-Length: ".filesize($file));
    // header ("Content-Disposition: attachment; filename=".$filename);
    // readfile($file); 
    // echo "I am fine now."; die;
}
?>