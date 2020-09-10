<?php include('../conf/dbConfig.php'); ?>
<?php
if(isset($_POST['action']) && $_POST['action'] == 'create-folder'){
    $thumbnail = 'folder-icon-default.png';
    $fid = $_POST['folder_id'];
    $title = $_POST['folder_title'];
    $description = $_POST['folder_desc'];
    $is_active = (isset($_POST['is_active']) && $_POST['is_active'] != '') ? $_POST['is_active'] : 'No';
    if(!empty($_FILES['folder_thumb']['name'])){
        $path = "../files/icons/";
        $path = $path . basename( $_FILES['folder_thumb']['name']);

        if(move_uploaded_file($_FILES['folder_thumb']['tmp_name'], $path)) {
            $thumbnail = basename( $_FILES['folder_thumb']['name']);
            $status = 'ok';
        } else{
            $status = 'err';
            $msg = "There was an error uploading the thumbnail, please try again!";
        }
    }
    if(isset($fid) && $fid != ''){
        $qry = "INSERT INTO folders(`title`, `description`, `thumbnail`, `is_active`, `parent`) VALUES('$title', '$description', '$thumbnail', '$is_active', $fid)";
    }else{
        $qry = "INSERT INTO folders(`title`, `description`, `thumbnail`, `is_active`) VALUES('$title', '$description', '$thumbnail', '$is_active')";
    }
    if($conn->query($qry)){
        $status = 'ok';
        $msg = "Folder ('$title') Is Created Sucessfully";
    }else{
        $status = 'err';
        $msg = $conn->error;
    }
    die(json_encode(array("status"=>$status, "msg"=>$msg)));
}
if(isset($_POST['action']) && $_POST['action'] == 'update-folder'){
    $okFlag = TRUE;
    $thumbFlag = FALSE;

    if(isset($_POST['update_folder_id']) && $_POST['update_folder_id'] != ''){
        $fid = $_POST['update_folder_id'];
    }else{
        $okFlag = FALSE;
        $msg = "Invalid Request. Please Try Again.";
    }
    if(isset($_POST['update_folder_title']) && $_POST['update_folder_title'] != ''){
        $title = $_POST['update_folder_title'];
    }else{
        $okFlag = FALSE;
        $msg = "Folder Title Cannot Be Blank.";
    }
    $description = isset($_POST['update_folder_description']) ? $_POST['update_folder_description'] : '';
    $is_active = (isset($_POST['update_folder_is_active']) && $_POST['update_folder_is_active'] != '') ? $_POST['update_folder_is_active'] : 'No';
    if(!empty($_FILES['update_folder_thumbnail']['name'])){
        $thumbFlag = TRUE;
        $path = "../files/icons/";
        $path = $path . basename( $_FILES['update_folder_thumbnail']['name']);

        if(move_uploaded_file($_FILES['update_folder_thumbnail']['tmp_name'], $path)) {
            $thumbnail = basename( $_FILES['update_folder_thumbnail']['name']);
            $okFlag = TRUE;
        } else{
            $okFlag = FALSE;
            $msg = "There was an error uploading the thumbnail, please try again!";
        }
    }
    if($okFlag==TRUE){
        if($thumbFlag==TRUE){
            $qry = "UPDATE `folders` SET `title` = '$title', `description` = '$description', `thumbnail` = '$thumbnail', `is_active` = '$is_active' WHERE `folders`.`id` = $fid";
        }else{
            $qry = "UPDATE `folders` SET `title` = '$title', `description` = '$description', `is_active` = '$is_active' WHERE `folders`.`id` = $fid";
        }
        if($conn->query($qry)){
            $msg = "Folder ('$title') Is Updated Sucessfully";
        }else{
            $okFlag = FALSE;
            $msg = $conn->error;
        }
    }
    die(json_encode(array("status"=>$okFlag, "msg"=>$msg)));
}
if(isset($_POST['action']) && $_POST['action'] == 'create-file'){
    $fid = $_POST['folder_id'];
    $title = $_POST['file_title'];
    $description = $_POST['file_description'];
    $device_brand = $_POST['file_device_brand'];
    $device_model = $_POST['file_device_model'];
    $android_version = $_POST['file_android_version'];
    $firmware_version = $_POST['file_firmware_version'];
    $chip_detail = $_POST['file_chip_detail'];
    $country = $_POST['file_country'];
    $language = $_POST['file_language'];
    $support_tool = $_POST['file_support_tool'];
    $method = $_POST['file_url_type'];
    $direct_url = $_POST['direct_url'];
    $file_size = $_POST['file_size'];
    $file_size_unit = $_POST['file_size_unit'];
    $is_paid = (isset($_POST['is_paid']) && $_POST['is_paid'] != '') ? $_POST['is_paid'] : 'No';
    $price = (isset($_POST['price']) && $_POST['price'] > 0) ? $_POST['price'] : '';
    $price_unit = (isset($price) && $price > 0) ? 'USD' : '';
    $is_featured = (isset($_POST['is_featured']) && $_POST['is_featured'] != '') ? $_POST['is_featured'] : 'No';
    $is_active = (isset($_POST['is_active']) && $_POST['is_active'] != '') ? $_POST['is_active'] : 'No';
    $file = '';
    $file_thumbnail = '';
    $file_image = '';
    if(!empty($_FILES['file_path']['name'])){
        $path = "../files/";
        $path = $path . basename( $_FILES['file_path']['name']);
        if(move_uploaded_file($_FILES['file_path']['tmp_name'], $path)) {
            $file = basename( $_FILES['file_path']['name']);
            $status = 'ok';
        } else{
            $status = 'err';
            $msg = "There was an error uploading the thumbnail, please try again!";
        }
    }
    if(!empty($_FILES['file_thumbnail']['name'])){
        $path = "../files/icons/";
        $path = $path . basename( $_FILES['file_thumbnail']['name']);

        if(move_uploaded_file($_FILES['file_thumbnail']['tmp_name'], $path)) {
            $file_thumbnail = basename( $_FILES['file_thumbnail']['name']);
            $status = 'ok';
        } else{
            $status = 'err';
            $msg = "There was an error uploading the thumbnail, please try again!";
        }
    }
    if(!empty($_FILES['file_image']['name'])){
        $path = "../files/images/";
        $path = $path . basename( $_FILES['file_image']['name']);

        if(move_uploaded_file($_FILES['file_image']['tmp_name'], $path)) {
            $file_image = basename( $_FILES['file_image']['name']);
            $status = 'ok';
        } else{
            $status = 'err';
            $msg = "There was an error uploading the thumbnail, please try again!";
        }
    }
}
// File Update/Edit
if(isset($_POST['action']) && $_POST['action'] == 'update-file'){
    $okFlag = TRUE;
    $msg = '';
    if(!isset($_POST['update_file_id']) || $_POST['update_file_id'] == ''){
        $okFlag = FALSE;
        $msg = "Invalid Request. Please Try Again.";        
    }else if(!isset($_POST['update_file_title']) || $_POST['update_file_title'] == ''){
        $okFlag = FALSE;
        $msg = "File Title Cannot Be Blank.";
    }else if(!isset($_POST['update_file_device_brand']) || $_POST['update_file_device_brand'] == ''){
        $okFlag = FALSE;
        $msg = "Device Brand Cannot Be Blank.";
    }else if(!isset($_POST['update_file_device_model']) || $_POST['update_file_device_model'] == ''){
        $okFlag = FALSE;
        $msg = "Device Model Cannot Be Blank.";
    }else if(!isset($_POST['update_file_android_version']) || $_POST['update_file_android_version'] == ''){
        $okFlag = FALSE;
        $msg = "Android Version Cannot Be Blank.";
    }else if(!isset($_POST['update_file_firmware_version']) || $_POST['update_file_firmware_version'] == ''){
        $okFlag = FALSE;
        $msg = "Firmware Version Cannot Be Blank.";
    }else if(!isset($_POST['update_file_chip_detail']) || $_POST['update_file_chip_detail'] == ''){
        $okFlag = FALSE;
        $msg = "Chip Detail Cannot Be Blank.";
    }else if(!isset($_POST['update_file_country']) || $_POST['update_file_country'] == ''){
        $okFlag = FALSE;
        $msg = "Country Cannot Be Blank.";
    }else if(!isset($_POST['update_file_language']) || $_POST['update_file_language'] == ''){
        $okFlag = FALSE;
        $msg = "Language Cannot Be Blank.";
    }else if(!isset($_POST['update_file_support_tool']) || $_POST['update_file_support_tool'] == ''){
        $okFlag = FALSE;
        $msg = "Support Tool Cannot Be Blank.";
    }else if(!isset($_POST['update_file_url_type']) || $_POST['update_file_url_type'] == ''){
        $okFlag = FALSE;
        $msg = "Please Select a File Method.";
    }else if(isset($_POST['update_file_url_type']) && $_POST['update_file_url_type'] == 'direct'){
        if(!isset($_POST['update_file_direct_url']) || $_POST['update_file_direct_url'] == ''){
            $okFlag = FALSE;
            $msg = "Please Enter the URL.";
        }else if(!isset($_POST['update_file_size']) || $_POST['update_file_size'] <= 0){
            $okFlag = FALSE;
            $msg = "Please Enter the File Size.";
        }else if(!isset($_POST['update_file_size_unit']) || $_POST['update_file_size_unit'] == ''){
            $okFlag = FALSE;
            $msg = "Please Enter the File Size Unit.";
        }
    }else if(isset($_POST['update_file_is_paid']) && $_POST['update_file_is_paid'] == 'Yes'){
        if(!isset($_POST['update_file_price']) || $_POST['update_file_price'] <= 0){
            $okFlag = FALSE;
            $msg = "Please Enter the File Price.";
        }
    }
    $fid = $_POST['update_file_id'];
    $title = $_POST['update_file_title'];
    $device_brand = $_POST['update_file_device_brand'];
    $device_model = $_POST['update_file_device_model'];
    $android_version = $_POST['update_file_android_version'];
    $firmware_version = $_POST['update_file_firmware_version'];
    $chip_detail = $_POST['update_file_chip_detail'];
    $country = $_POST['update_file_country'];
    $language = $_POST['update_file_language'];
    $support_tool = $_POST['update_file_support_tool'];
    $method = $_POST['update_file_url_type'];
    $direct_url = $_POST['update_file_direct_url'];
    $file_size = $_POST['update_file_size'];
    $file_size_unit = $_POST['update_file_size_unit'];
    $description = isset($_POST['update_file_description']) ? $_POST['update_file_description'] : '';
    $is_paid = (isset($_POST['update_file_is_paid']) && $_POST['update_file_is_paid'] != '') ? $_POST['update_file_is_paid'] : 'No';
    $price = (isset($_POST['update_file_price']) && $_POST['update_file_price'] > 0) ? $_POST['update_file_price'] : '';
    $price_unit = (isset($price) && $price > 0) ? 'USD' : '';
    $is_featured = (isset($_POST['update_file_is_featured']) && $_POST['update_file_is_featured'] != '') ? $_POST['update_file_is_featured'] : 'No';
    $is_active = (isset($_POST['update_file_is_active']) && $_POST['update_file_is_active'] != '') ? $_POST['update_file_is_active'] : 'No';
    if(!empty($_FILES['update_file_path']['name'])){
        $path = "../files/";
        $path = $path . basename( $_FILES['update_file_path']['name']);
        if(move_uploaded_file($_FILES['update_file_path']['tmp_name'], $path)) {
            $file = basename( $_FILES['update_file_path']['name']);
            $has_file = TRUE;
        } else{
            $okFlag = FALSE;
            $msg = "There was an error uploading the file, please try again!";
        }
    }
    if(!empty($_FILES['update_file_thumbnail']['name'])){
        $path = "../files/icons/";
        $path = $path . basename( $_FILES['update_file_thumbnail']['name']);    
        if(move_uploaded_file($_FILES['update_file_thumbnail']['tmp_name'], $path)) {
            $file_thumbnail = basename( $_FILES['update_file_thumbnail']['name']);
            $has_thumb = TRUE;
        } else{
            $okFlag = FALSE;
            $msg = "There was an error uploading the thumbnail, please try again!";
        }
    }
    if(!empty($_FILES['update_file_image']['name'])){
        $path = "../files/images/";
        $path = $path . basename( $_FILES['update_file_image']['name']);

        if(move_uploaded_file($_FILES['update_file_image']['tmp_name'], $path)) {
            $file_image = basename( $_FILES['update_file_image']['name']);
            $has_image = TRUE;
        } else{
            $okFlag = FALSE;
            $msg = "There was an error uploading the file image, please try again!";
        }
    }
    if($okFlag == TRUE){
        $files_query = '';
        $files_query .= (isset($file) && $file != '') ? ", file = '$file'" : '';
        $files_query .= (isset($file_thumbnail) && $file_thumbnail != '') ? ", thumbnail = '$file_thumbnail'" : '';
        $files_query .= (isset($file_image) && $file_image != '') ? ", image = '$file_image'" : '';
        $qry = "UPDATE files SET title = '$title', description = '$description', device_brand = '$device_brand', device_model = '$device_model', android_version = '$android_version', firmware_version = '$firmware_version', chip_detail = '$chip_detail', country = '$country', language = '$language', support_tool = '$support_tool', file_method = '$method', direct_url = '$direct_url', file_size = '$file_size', file_size_unit = '$file_size_unit', is_paid = '$is_paid', price = '$price', price_unit = '$price_unit', is_featured = '$is_featured', is_active = '$is_active' $files_query WHERE id = $fid";
        if($conn->query($qry)){
            $msg = "File ('$title') Is Updated Sucessfully";
        }else{
            $okFlag = FALSE;
            $msg = $conn->error;
        }
    }        
    die(json_encode(array("status"=>$okFlag, "msg"=>$msg)));    
}
if(isset($_POST['delete_folder'])){
    
}
if(isset($_POST['delete_file'])){
    
}
if(isset($_POST['copy_folder'])){
    
}
if(isset($_POST['copy_file'])){
    
}
if(isset($_POST['action']) && $_POST['action'] == 'move-folder'){

    
}
if(isset($_POST['move_file'])){
    
}
if(isset($_POST['action']) && $_POST['action'] == 'get-folder-by-id'){
    $id = $_POST['fid'];
    die(get_folder_by_id($conn, $id));
}
if(isset($_POST['action']) && $_POST['action'] == 'get-folder-list'){
    die(json_encode(get_folder_by_id($conn)));
}
if(isset($_POST['action']) && $_POST['action'] == 'get-file-by-id'){
    $id = $_POST['fid'];
    die(get_file_by_id($conn, $id));
}
// Functions
function get_folder_by_id($conn, $id){
    $qry = "SELECT * FROM folders WHERE id = $id";
    $rs = $conn->query($qry);
    $row = $rs->fetch_assoc();
    return json_encode($row);
}

function get_file_by_id($conn, $id){
    $qry = "SELECT * FROM files WHERE id = $id";
    $rs = $conn->query($qry);
    $row = $rs->fetch_assoc();
    return json_encode($row);
}

function get_folder_list($conn){
    $qry = "SELECT * FROM folders";
    $rs = $conn->query($qry);
    $data_set = array();

    while($data = $rs->fetch_assoc()){
        $data_set[] = $data;
    }
    return $data_set;
}

function get_folder_list_tree($conn){
    $qry = "SELECT * FROM folders";
    $rs = $conn->query($qry);
    $data_set = array();

    while($data = $rs->fetch_assoc()){
        // if($data['parent'] != ''){
        //     $data_set[$data['parent']] = $data;
        // }else{
        //     $data_set[] = $data;
        // }
        $data_set[] = $data;
    }
    return $data_set;
}
?>