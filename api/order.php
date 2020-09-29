<?php
session_start();
include('../conf/dbConfig.php');
include('../classes/Order.php');
if(isset($_POST['action']) && $_POST['action'] == 'create-order'){
    $notes = $_POST['notes'];
    $order_by = $_SESSION['customer_id'];
    $files = array();
    $packages = array();
    if(isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])){
        $sub_total = 0;
        if(isset($_SESSION['shopping_cart']['file']) && !empty($_SESSION['shopping_cart']['file'])){
            $files = $_SESSION['shopping_cart']['file'];
            if(!empty($files)){
                foreach($files as $f){
                    $sub_total = $sub_total + $f['total'];
                }
            }
            
        }
        if(isset($_SESSION['shopping_cart']['package']) && !empty($_SESSION['shopping_cart']['package'])){
            $packages = $_SESSION['shopping_cart']['packages'];
            if(!empty($packages)){
                foreach($files as $p){
                    $sub_total = $sub_total + $p['total'];
                }
            }
        }
        $discount = 0;
        $tax = 0;
        $bill_amount = $sub_total - $discount + $tax;
        $bill_unit = 'USD';

        $order_obj = new Order($conn);
        $order_obj->order_by = $order_by;
        $order_obj->sub_total = $sub_total;
        $order_obj->discount = $discount;
        $order_obj->tax = $tax;
        $order_obj->bill_amount = $bill_amount;
        $order_obj->bill_unit = $bill_unit;
        $order_obj->notes = $notes;
        $order_obj->files = $files;
        $order_obj->packages = $packages;
        if($order_obj->create()){
            unset($_SESSION['shopping_cart']);
            die(json_encode(array("status"=> 1, "message"=> "Your order has been placed successfully.")));
        }else{
            die(json_encode(array("status"=> 0, "message"=> "Server Error. Please try again later")));
        }

    }else{
        die(json_encode(array("status"=> 0, "message"=> "Cart is Empty. You have nothing to order.")));
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'cancel-order'){
    $order_id = $_POST['order_id'];

    $order_obj = new Order($conn);
    $order_obj->id = $order_id;
    if($order_obj->delete()){
        die(json_encode(array(
            "status" => 1,
            "message" => "Your order has been cancelled successfully"
        )));
    }else{
        die(json_encode(array(
            "status" => 0,
            "message" => "Internal problem, please try again later."
        )));
    }
}
?>