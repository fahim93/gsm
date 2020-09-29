<?php
include('../conf/dbConfig.php');
include('../classes/Customer.php');
if(isset($_POST['action']) && $_POST['action'] == 'update-password'){
    $customer_id = $_POST['customer_id'];
    $current_password = $_POST['current_password'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    if($current_password == ''){
        die(json_encode(array(
            "status" => 0,
            "message" => "Enter Your Current Password."
        ))); 
    }
    if($password == ''){
        die(json_encode(array(
            "status" => 0,
            "message" => "Enter New Password."
        ))); 
    }
    if($password_confirmation == ''){
        die(json_encode(array(
            "status" => 0,
            "message" => "Enter Password Confirmation."
        ))); 
    }
    if($password != $password_confirmation){
        die(json_encode(array(
            "status" => 0,
            "message" => "Don\'t match this."
        )));
    } 

    $cust_obj = new Customer($conn);
    $cust_obj->id = $customer_id;

    $cust_data = $cust_obj->get_customer_by_id()->fetch_assoc();

    if(!password_verify($current_password, $cust_data['password'])){ // normal password, hashed password
        die(json_encode(array(
            "status" => 0,
            "message" => "Current Password Is Incorrect"
        )));
    }
    $cust_obj->password = password_hash($password, PASSWORD_DEFAULT);

    if($cust_obj->update_password()){
        http_response_code(200);
        echo json_encode(array(
        "status" => 1,
        "message" => "Password has been updated successfully."
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