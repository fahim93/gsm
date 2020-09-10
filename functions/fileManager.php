<?php
function get_objects($conn, $table_name, $filter_set=array(), $order_by='id', $sorted='ASC'){
    if(!empty($filter_set)){
        $filter = '';
        $index = 0;
        foreach($filter_set as $key=>$value){
            if($index==0){
                if($value == ''){
                    $filter .= "WHERE $key IS NULL";
                }else{
                    $filter .= "WHERE $key = '$value'";
                }
            }else{
                if($value == ''){
                    $filter .= " AND $key IS NULL";
                }else{
                    $filter .= " AND $key = '$value'";                    
                }
            }
            $index = $index + 1;
        }
        $qry = "SELECT * FROM $table_name $filter ORDER BY $order_by $sorted";
    }else{
        $qry = "SELECT * FROM $table_name ORDER BY $order_by $sorted";
    }
    return $conn->query($qry);
}
// function get_objects($conn, $table_name, $filter_set=array(), $order_by='id', $sorted='ASC', $limit_offset=18446744073709551615){
//     if(!empty($filter_set)){
//         $filter = '';
//         $index = 0;
//         foreach($filter_set as $key=>$value){
//             if($index==0){
//                 $filter .= "WHERE $key = '$value'";
//             }else{
//                 $filter .= " AND $key = '$value'";
//             }
//             $index = $index + 1;
//         }
//         $qry = "SELECT * FROM $table_name $filter ORDER BY $order_by $sorted LIMIT 0, $limit_offset";
//     }else{
//         $qry = "SELECT * FROM $table_name ORDER BY $order_by $sorted LIMIT 0, $limit_offset";
//     }
//     echo $qry;
//     // return $conn->query($qry);
//     // return $qry;
// }

function get_custom_objects($conn, $qry){
    return $conn->query($qry);
}
function get_object_by_id($conn, $table_name, $id){
    $qry = "SELECT * FROM $table_name WHERE id = $id";
    return $conn->query($qry)->fetch_assoc();
}

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

function getIPAddress() { 
    $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR'); 
    // //whether ip is from the share internet  
    //  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
    //     $ip = $_SERVER['HTTP_CLIENT_IP'];  
    // }  
    // //whether ip is from the proxy  
    // else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
    //     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    //  }  
    // //whether ip is from the remote address  
    // else{  
    //     $ip = $_SERVER['REMOTE_ADDR'];  
    //  }  
     return $ip;  
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

// include('../conf/dbConfig.php');
// $dir = get_directory_tree($conn, 12);
// foreach($dir as $d){
//     echo $d['title'] . '<br>';
// }
// get_objects($conn=$conn, $table_name='files');

?>