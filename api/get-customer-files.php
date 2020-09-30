<?php
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['customer']) && $_GET['customer'] != ''){
        $customer = $_GET['customer'];
        include('../conf/dbConfig.php');
        include('../classes/OrderFile.php');
        $of_obj = new OrderFile($conn);
        $of_data = $of_obj->get_by_customer($customer);
        die(json_encode($of_data));
    }
}
?>