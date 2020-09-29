<?php
include('../conf/dbConfig.php');
include('../classes/Customer.php');
if(isset($_POST['action']) && $_POST['action'] == 'update-profile'){
    $customer_id = $_POST['customer_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $zip_code = $_POST['zip_code'];
    $image = $_FILES['image'];

    $old_image = $_POST['old_image'];

    $cust_obj = new Customer($conn);
    $cust_obj->id = $customer_id;
    $cust_obj->name = $name;
    $cust_obj->phone = $phone;
    $cust_obj->country = $country;
    $cust_obj->city = $city;
    $cust_obj->address = $address;
    $cust_obj->zip_code = $zip_code;
    $cust_obj->image = $old_image;

    if(!empty($_FILES['image']['name'])){
        $path = "../uploads/customers/";
        $path = $path . basename( $_FILES['image']['name']);
        $image_src = "uploads/customers/". basename( $_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            $cust_obj->image = $image_src;
        }
    }
    if($cust_obj->update_profile_info()){
        http_response_code(200);
        echo json_encode(array(
        "status" => 1,
        "message" => "Profile has been updated successfully."
        ));
    }else{
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "Internal Server Error."
        )); 
    }
}else{
    http_response_code(401);
    echo json_encode(array("status" => 0, "message" => "Access denied."));
}
?>