<?php
include('../conf/dbConfig.php');
include('../classes/CustomerPackage.php');
if(isset($_POST['action']) && $_POST['action'] == 'make-active'){
    $id = $_POST['customer_package_id'];
    $customer = $_POST['customer_id'];
    $obj = new CustomerPackage($conn);
    $obj->id = $id;
    $obj->customer = $customer;
    if($obj->make_active()){
        die(json_encode(array("status" => 1, "message"=> "Package Active Status Has Been Changed.")));
    }else{
        die(json_encode(array("status" => 0, "message"=> "Server Error. Try again later.")));
    }
}
?>