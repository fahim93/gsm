<?php
include('../conf/dbConfig.php');
include('../functions/common.php');
if(isset($_POST['action']) && $_POST['action'] == 'file-list'){
    $order_by = $_POST['order_by'];
    $sort = $_POST['sort'];
    $folder_id = $_POST['folder_id'];
    if(isset($folder_id) && $folder_id != ''){
        if($order_by == 'downloads'){
            $qry = "SELECT fd.title AS folder_title, f.*, COUNT(dh.id) AS total_download FROM `files` AS f LEFT JOIN
            `download_history` AS dh ON f.id = dh.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder = $folder_id GROUP BY f.id ORDER BY total_download $sort";
            // $file_list = get_custom_objects($conn, "SELECT fd.title AS folder_title, f.*, COUNT(dh.id) AS total_download FROM `files` AS f LEFT JOIN
            // `download_history` AS dh ON f.id = dh.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder = $folder_id GROUP BY f.id ORDER BY total_download $sort");
        }else if($order_by == 'visits'){
            $qry = "SELECT fd.title AS folder_title, f.*, COUNT(fv.id) AS total_visitors FROM `files` AS f LEFT JOIN
            `file_visitors` AS fv ON f.id = fv.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder = $folder_id GROUP BY f.id ORDER BY total_visitors $sort";
            // $file_list = get_custom_objects($conn, "SELECT fd.title AS folder_title, f.*, COUNT(fv.id) AS total_visitors FROM `files` AS f LEFT JOIN
            // `file_visitors` AS fv ON f.id = fv.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder = $folder_id GROUP BY f.id ORDER BY total_visitors $sort");
    
        }else{
            $qry = "SELECT fd.title AS folder_title, f.* FROM files AS f LEFT JOIN folders AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder = $folder_id ORDER BY $order_by $sort";
            // $file_list = get_objects($conn, $table_name='files', $filter_set=array('is_active'=>'Yes', 'folder'=>$folder_id), $order_by=$order_by, $sorted=$sort);
            // $qry = "SELECT fd.title AS folder_title, f.* FROM files AS f LEFT JOIN folders AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder = 1 ORDER BY title ASC";
        }
    }else{
        if($order_by == 'downloads'){
            $qry = "SELECT fd.title AS folder_title, f.*, COUNT(dh.id) AS total_download FROM `files` AS f LEFT JOIN
            `download_history` AS dh ON f.id = dh.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder IS NULL GROUP BY f.id ORDER BY total_download $sort";
            // $file_list = get_custom_objects($conn, "SELECT fd.title AS folder_title, f.*, COUNT(dh.id) AS total_download FROM `files` AS f LEFT JOIN
            // `download_history` AS dh ON f.id = dh.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder IS NULL GROUP BY f.id ORDER BY total_download $sort");
        }else if($order_by == 'visits'){
            $qry = "SELECT fd.title AS folder_title, f.*, COUNT(fv.id) AS total_visitors FROM `files` AS f LEFT JOIN
            `file_visitors` AS fv ON f.id = fv.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder IS NULL GROUP BY f.id ORDER BY total_visitors $sort";
            // $file_list = get_custom_objects($conn, "SELECT fd.title AS folder_title, f.*, COUNT(fv.id) AS total_visitors FROM `files` AS f LEFT JOIN
            // `file_visitors` AS fv ON f.id = fv.file LEFT JOIN `folders` AS fd ON f.folder = fd.id WHERE f.is_active = 'Yes' AND f.folder IS NULL GROUP BY f.id ORDER BY total_visitors $sort");
    
        }else{
            $qry = "SELECT f.* FROM files AS f WHERE f.is_active = 'Yes' AND f.folder IS NULL ORDER BY $order_by $sort";
            // $file_list = get_objects($conn, $table_name='files', $filter_set=array('is_active'=>'Yes', 'folder'=>''), $order_by=$order_by, $sorted=$sort);
        }
    }
    $file_list = get_custom_objects($conn, $qry);
    $data_set = array();
    foreach($file_list as $file){
        $data_set[] = $file;
    }
    die(json_encode($data_set));
}
?>