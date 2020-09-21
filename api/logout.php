<?php
include_once("../conf/dbConfig.php");
include_once("../classes/Customer.php");
$customer_obj = new Customer($conn);

if(isset($_POST['customer_id']) && $_POST['customer_id'] != ''){
    $customer_id = $_POST['customer_id'];
    $jwt = '';
    if($customer_obj->update_token($customer_id, $jwt)){

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