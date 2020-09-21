<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files for decoding jwt will be here
// required to decode jwt
include_once("../conf/core.php");
include_once("../conf/dbConfig.php");
// include_once 'config/core.php';
// include_once('vendor/firebase/src/BeforeValidException.php');
// include_once('vendor/firebase/src/ExpiredException.php');
// include_once('vendor/firebase/src/SignatureInvalidException.php');
// include_once('vendor/firebase/src/JWT.php');
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// decode jwt here
// if jwt is not empty
if($jwt){
    try {
        // decode jwt
        $decoded = JWT::decode($jwt, SECRET_KEY, array('HS512'));
 
        // set response code
        http_response_code(200);
 
        // show user details
        echo json_encode(array(
            "status" => 1,
            "message" => "Access granted.",
            "data" => $decoded->data
        ));
 
    }
    catch (Exception $e){
    
        // set response code
        http_response_code(401);
    
        // tell the user access denied  & show error message
        echo json_encode(array(
            "status" => 0,
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user access denied
    echo json_encode(array("status" => 0, "message" => "Access denied."));
}
?>