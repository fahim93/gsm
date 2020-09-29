<?php
include_once("../conf/dbConfig.php");
include_once("../classes/Customer.php");

if(isset($_POST['customer_id']) && $_POST['customer_id'] != ''){
    $customer_obj = new Customer($conn);
    
    $customer_id = $_POST['customer_id'];
    $jwt = '';
    $customer_obj->id = $customer_id;
    $customer_obj->token = $jwt;
    if($customer_obj->update_token()){

        http_response_code(200);
        echo json_encode(array(
            "status" => 1,
            "message" => "You have been logged out."
        ));
    }else{
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "Failed to log out"
        )); 
    }
}else{
    http_response_code(400);
    echo json_encode(array(
        "status" => 0,
        "message" => "Bad Request"
    )); 
}
?>