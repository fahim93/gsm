<?php
//inlcude headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charst=UTF-8");

// including files
include_once("../conf/dbConfig.php");
include_once("../classes/Customer.php");
include_once("../classes/CustomerPackage.php");
include_once("../classes/SystemDownloadSetup.php");
include_once("../classes/Package.php");
include_once("../classes/CustomerAccount.php");



if($_SERVER['REQUEST_METHOD'] === "POST"){

    $data = json_decode(file_get_contents("php://input"));
    if(empty($data->name)){
      die(json_encode(array(
        "status" => 0,
        "message" => "Please Enter Your Name."
      )));
    }
    if(empty($data->country)){
      die(json_encode(array(
        "status" => 0,
        "message" => "Please Select A Country."
      )));
    }
    if(empty($data->email)){
      die(json_encode(array(
        "status" => 0,
        "message" => "Please Enter An Email."
      )));
    }
    if(empty($data->username)){
      die(json_encode(array(
        "status" => 0,
        "message" => "Please Enter An Username."
      )));
    }
    if(empty($data->password)){
      die(json_encode(array(
        "status" => 0,
        "message" => "Please Enter the Password."
      )));
    }
    if(empty($data->password_confirmation)){
      die(json_encode(array(
        "status" => 0,
        "message" => "Please Enter Confirm Password."
      )));
    }
    $customer_obj = new Customer($conn);
    $customer_obj->name = $data->name;
    $customer_obj->username = $data->username;
    $customer_obj->email = $data->email;
    $customer_obj->password = password_hash($data->password, PASSWORD_DEFAULT);
    $customer_obj->phone = $data->phone;
    $customer_obj->country = $data->country;
    $customer_obj->city = $data->city;
    $customer_obj->address = $data->address;
    $customer_obj->zip_code = $data->zip_code;

    if($customer_obj->is_exists_email()){
      die(json_encode(array(
        "status" => 0,
        "message" => "Email already exists, try another email address"
      )));      
    }
    if($customer_obj->is_exists_username()){
      die(json_encode(array(
        "status" => 0,
        "message" => "Username already exists, try another username"
      )));
    }
    if($customer_obj->create()){
      $cust_id = $customer_obj->get_customer_by_email()['id'];

      // Create Customer Account 
      $acc_obj = new CustomerAccount($conn);
      $acc_obj->customer = $cust_id;
      $acc_obj->create();

      $sds_obj = new SystemDownlodSetup($conn);
      $sds_data = $sds_obj->get_data();

      if(!empty($sds_data) && $sds_data['default_registration_package'] > 0){
        $package_id = $sds_data['default_registration_package'];
        $pack_obj = new Package($conn);
        $pack_obj->id = $package_id;
        $pack_data = $pack_obj->get_package_by_id();
        if(!empty($pack_data)){
          if($pack_data['validity'] == 'Expirable'){
            $period = $pack_data['validity_period'];
            $period_unit = $pack_data['validity_period_unit'];
            $date = date_create(date('Y-m-d H:i:s'));
            date_add($date, date_interval_create_from_date_string("{$period} {$period_unit}"));
            $expire_on = date_format($date,"Y-m-d h:i:s");
            }else{
              $expire_on = 'Non Expirable';
            }
            $cust_pack_obj = new CustomerPackage($conn);
            $cust_pack_obj->customer = $cust_id;
            $cust_pack_obj->package = $package_id;
            $cust_pack_obj->expire_on = $expire_on;
            $cust_pack_obj->create();
        }
      }
      die(json_encode(array(
        "status" => 1,
        "message" => "Registration has been completed successfully."
      )));
    }else{
      die(json_encode(array(
        "status" => 1,
        "message" => "Failed to register. please try again later."
      )));
    }
}else{
  http_response_code(503);
  echo json_encode(array(
    "status" => 0,
    "message" => "Access Denied"
  ));
}

 ?>
