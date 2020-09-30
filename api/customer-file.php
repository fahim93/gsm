<?php
include('../conf/dbConfig.php');
include('../classes/OrderFile.php');
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['customer']) && $_GET['customer'] != ''){
        $customer = $_GET['customer'];
        $of_obj = new OrderFile($conn);
        $of_data = $of_obj->get_by_customer($customer);
        die(json_encode($of_data));
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'get-details'){
    $id = $_POST['id'];
    $of_obj = new OrderFile($conn);
    $of_obj->id = $id;
    $of_data = $of_obj->get_details();
    die(json_encode(array("status" => 1, "data" => $of_data)));
}
?>