<?php
include('../conf/dbConfig.php');
include('../classes/Customer.php');
if(isset($_POST['action']) && $_POST['action'] == 'update-email'){
    $customer_id = $_POST['customer_id'];
    $current_email = $_POST['current_email'];
    $new_email = $_POST['new_email'];
    $current_password = $_POST['current_password'];

    if($current_email == ''){
        die(json_encode(array(
            "status" => 0,
            "message" => "Enter Your Current Email."
        ))); 
    }
    if($new_email == ''){
        die(json_encode(array(
            "status" => 0,
            "message" => "Enter New Email."
        ))); 
    }
    if($current_password == ''){
        die(json_encode(array(
            "status" => 0,
            "message" => "Enter Current Password."
        ))); 
    }

    $cust_obj = new Customer($conn);
    $cust_obj->id = $customer_id;
    $cust_obj->email = $new_email;

    if(!empty($cust_obj->check_email())){
        die(json_encode(array(
            "status" => 0,
            "message" => "Email Already Exist, Try Another."
        )));
    }

    if($cust_obj->update_email()){
        http_response_code(200);
        echo json_encode(array(
        "status" => 1,
        "message" => "Email has been updated successfully."
        ));
    }else{
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "Internal Server Error. Try Again Later"
        )); 
    }
}else{
    http_response_code(500);
    echo json_encode(array("status" => 0, "message" => "Bad Request."));
}
?>