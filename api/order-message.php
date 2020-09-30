<?php
include('../conf/dbConfig.php');
include('../classes/OrderMessage.php');
if(isset($_POST['action']) && $_POST['action'] == 'send-message'){
    $msg_from = ($_POST['message_from']== "Customer") ? 1 : 2;
    $msg = $_POST['message'];
    $order_id = $_POST['order_id'];
    $obj = new OrderMessage($conn);
    $obj->order_id = $order_id;
    $obj->message_from = $msg_from;
    $obj->message = $msg;
    if($obj->send()){
        die(json_encode(array("status" => 1, "message" => "Message Sent.")));
    }else{
        die(json_encode(array("status" => 0, "message" => "Message Not Sent.")));
    }
}
if($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['order_id']) && $_GET['order_id'] != ''){
        $order_id = $_GET['order_id'];
        $obj = new OrderMessage($conn);
        $obj->order_id = $order_id;
        $data = $obj->get_by_order();
        die(json_encode($data));
    }
}
?>