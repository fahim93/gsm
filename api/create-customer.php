<?php
//inlcude headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charst=UTF-8");

// including files
include_once("../conf/dbConfig.php");
include_once("../classes/Customer.php");

//objects
// $db = new Database();

// $connection = $db->connect();

$customer_obj = new Customer($conn);

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->name) && !empty($data->email) && !empty($data->password)){

       $customer_obj->name = $data->name;
       $customer_obj->username = $data->username;
       $customer_obj->email = $data->email;
       $customer_obj->password = password_hash($data->password, PASSWORD_DEFAULT);
       $customer_obj->phone = $data->phone;
       $customer_obj->country = $data->country;
       $customer_obj->city = $data->city;
       $customer_obj->address = $data->address;
       $customer_obj->zip_code = $data->zip_code;

       $email_data = $customer_obj->check_email();

       if(!empty($email_data)){
         // some data we have - insert should not go
         http_response_code(500);
         echo json_encode(array(
           "status" => 0,
           "message" => "User already exists, try another email address"
         ));
       }else{
         if($customer_obj->create_customer()){

           http_response_code(200);
           echo json_encode(array(
             "status" => 1,
             "message" => "User has been created, Successfully."
           ));
         }else{

           http_response_code(500);
           echo json_encode(array(
             "status" => 0,
             "message" => "Failed to save user"
           ));
         }
       }
    }else{
      http_response_code(500);
      echo json_encode(array(
        "status" => 0,
        "message" => "Please Enter All Required Fields"
      ));
    }
}else{

  http_response_code(503);
  echo json_encode(array(
    "status" => 0,
    "message" => "Access Denied"
  ));
}

 ?>
