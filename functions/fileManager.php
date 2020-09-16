<?php
function get_folder_by_file_id($conn, $file_id){
    $qry = "SELECT folders.* FROM files, folders WHERE files.folder = folders.id AND files.id = $file_id";
    return $conn->query($qry)->fetch_assoc();
}

function get_directory_tree($conn, $folder_id){
    $tree = array();
    $parent = $folder_id;
    while($parent != ''){
        $qry = "SELECT * FROM folders WHERE id = $parent";
        $rs = $conn->query($qry)->fetch_assoc();
        $parent = $rs['parent'];
        $tree[] = $rs;
    }
    return array_reverse($tree, true);
}

function get_download_history_by_file($conn, $file_id){
    $qry = "SELECT * FROM download_history WHERE file = $file_id";
    return $conn->query($qry);
}
function get_visitors_by_file($conn, $file_id){
    $qry = "SELECT * FROM file_visitors WHERE file = $file_id";
    return $conn->query($qry);
}

function create_visitor($conn, $file_id, $ip){
    $get_query = "SELECT * FROM file_visitors WHERE file = $file_id AND ip = '$ip'";
    $current_date_time = date("Y-m-d H:i:s");
    if($conn->query($get_query)->num_rows > 0){
        $qry = "UPDATE file_visitors SET updated_at = '$current_date_time' WHERE file = $file_id AND ip = '$ip'";
    }else{
        $qry = "INSERT INTO file_visitors(ip, file)VALUES('$ip', $file_id)";
    }    
    if($conn->query($qry)){
        return TRUE;
    }else{
        return $conn->error;
    }
}

function create_download_history($conn, $file_id, $file_size, $file_size_unit, $user_type, $user_id, $ip){
    if(isset($user_id) && $user_id != ''){
        $qry = "INSERT INTO download_history(`file`, `size`, `size_unit`, `user_type`, `customer`, `ip`) VALUES($file_id, $file_size, '$file_size_unit', '$user_type', '$user_id', '$ip')";
    }else{
        $qry = "INSERT INTO download_history(`file`, `size`, `size_unit`, `user_type`, `ip`) VALUES($file_id, $file_size, '$file_size_unit', '$user_type', '$ip')";
    }
    if($conn->query($qry)){
        return TRUE;
    }else{
        // return $conn->error;
        return FALSE;
    }
}

function get_daily_downloaded_size_per_user($conn, $ip, $user_id){
    if($user_id != ''){
        $qry = "SELECT SUM(size) AS total_size FROM download_history WHERE DATE(created_at) = CURDATE() AND customer = $user_id OR ip = '$ip'";
    }else{
        $qry = "SELECT SUM(size) AS total_size FROM download_history WHERE DATE(created_at) = CURDATE() AND ip = '$ip'";
    }
    $rs = $conn->query($qry)->fetch_assoc();
    return $rs['total_size'];
}

function get_recent_files($conn, $limit){
    $qry = "SELECT * FROM files WHERE is_active = 'Yes' ORDER BY created_at DESC LIMIT $limit";
    return $conn->query($qry);
}

function create_file_request($conn, $name, $email, $phone, $subject, $message){
    $qry = "INSERT INTO file_requests (`name`, `email`, `phone`, `subject`, `message`) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    if($conn->query($qry)){
        return TRUE;
    }
    return FALSE;
}
function create_contact($conn, $name, $email, $phone, $subject, $message){
    $qry = "INSERT INTO file_requests (`name`, `email`, `phone`, `subject`, `message`) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    if($conn->query($qry)){
        return TRUE;
    }
    return FALSE;
}

// include('../conf/dbConfig.php');
// $dir = get_directory_tree($conn, 12);
// foreach($dir as $d){
//     echo $d['title'] . '<br>';
// }
// get_objects($conn=$conn, $table_name='files');

?>