<?php
ini_set("display_errors", 1);
// include vendor
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../conf/core.php");
include_once("../conf/dbConfig.php");
include_once("../classes/Customer.php");

//objects
// $db = new Database();

// $connection = $db->connect();

$customer_obj = new Customer($conn);

if($_SERVER['REQUEST_METHOD'] === "POST"){

   $data = json_decode(file_get_contents("php://input"));

   if(!empty($data->email) && !empty($data->password)){

        $customer_obj->email = $data->email;
        //$user_obj->password = $data->password;

        $customer_data = $customer_obj->check_login();

        if(!empty($customer_data)){
            $id = $customer_data['id'];
            $name = $customer_data['name'];
            $email = $customer_data['email'];
            $password = $customer_data['password'];

            if(password_verify($data->password, $password)){ // normal password, hashed password
              $iss = "localhost";
              $iat = time();
              $nbf = $iat;
              $exp = $iat + 86400;
              $aud = "mycustomers";
              $user_data = array(
                "id" => $id,
                "name" => $name,
                "email" => $email
              );

              $payload_info = array(
                "iss"=> $iss,
                "iat"=> $iat,
                "nbf"=> $nbf,
                "exp"=> $exp,
                "aud"=> $aud,
                "data"=> $user_data
              );

              $jwt = JWT::encode($payload_info, SECRET_KEY, 'HS512');
              $customer_obj->update_token($id, $jwt);
              session_start();
              $_SESSION['is_logged_in'] = TRUE;
              $_SESSION['customer_id'] = $id;
              $_SESSION['customer_name'] = $name;
              $_SESSION['customer_email'] = $email;
              $_SESSION['token'] = $jwt;
              http_response_code(200);
              echo json_encode(array(
                "status" => 1,
                "jwt" => $jwt,
                "message" => "You have logged in successfully"
              ));
            }else{

              http_response_code(404);
              echo json_encode(array(
                "status" => 0,
                "message" => "Invalid credentials"
              ));
            }
        }else{

          http_response_code(404);
          echo json_encode(array(
            "status" => 0,
            "message" => "Invalid credentials"
          ));
        }
   }else{

     http_response_code(404);
     echo json_encode(array(
       "status" => 0,
       "message" => "All data needed"
     ));
   }
}
