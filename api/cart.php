<?php
session_start();
include_once("../conf/dbConfig.php");
include_once("../classes/File.php");
include_once("../classes/Package.php");
include_once("../classes/CustomerPackage.php");
if(isset($_POST['action'], $_POST['item_type']) && $_POST['action'] == 'add' && $_POST['item_type'] == 'file'){
    $file_id = $_POST['file_id'];

    
    $file_obj = new File($conn);
    $file_obj->id = $file_id;

    $file_data = $file_obj->get_file_by_id();
    $title = $file_data['title'];
    $price = $file_data['price'];
    $price_unit = $file_data['price_unit'];
    $quantity = 1;
    $sub_total = $price * $quantity;
    $discount = 0;
    $total = $sub_total - $discount;

    $item_array = array(
        "file_id" => $file_id,
        "title" => $title,
        "price" => $price,
        "price_unit" => $price_unit,
        "quantity" => $quantity,
        "sub_total" => $sub_total,
        "discount" => $discount,
        "total" => $total
    );
    if(isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])){
        if(empty($_SESSION['shopping_cart']['file'])){
            $_SESSION['shopping_cart']['file'][] = $item_array;
            die(json_encode(array(
                "status"=> 1,
                "message"=> "File has been added to your cart." 
            )));
        }else{
            if(in_array($file_id, array_column($_SESSION['shopping_cart']['file'], 'file_id'))){
                die(json_encode(array(
                    "status"=> 0,
                    "message"=> "This file already exists in your cart. Please check your cart." 
                )));
            }else{
                $_SESSION['shopping_cart']['file'][] = $item_array;
                die(json_encode(array(
                    "status"=> 1,
                    "message"=> "File has been added to your cart." 
                )));
            }
        }
    }else{
        $_SESSION['shopping_cart'] = array();
        $_SESSION['shopping_cart']['file'][] = $item_array;
        die(json_encode(array(
            "status"=> 1,
            "message"=> "File has been added to your cart." 
        )));
    }
}
if(isset($_POST['action'], $_POST['item_type']) && $_POST['action'] == 'add' && $_POST['item_type'] == 'package'){

    $package_id = $_POST['package_id'];

    $customer_id = $_SESSION['customer_id'];

    $cust_pkg_obj = new CustomerPackage($conn);
    $cust_pkg_obj->customer = $customer_id;
    $cust_pkg_obj->package = $package_id;
    if($cust_pkg_obj->is_exists()){
        die(json_encode(array(
            "status"=> 0,
            "message"=> "This package has been exists on your package list." 
        )));
    }
    
    $package_obj = new Package($conn);
    $package_obj->id = $package_id;

    $package_data = $package_obj->get_package_by_id();
    $title = $package_data['title'];
    $price = $package_data['price'];
    $price_unit = $package_data['price_unit'];
    $quantity = 1;
    $sub_total = $price * $quantity;
    $discount = 0;
    $total = $sub_total - $discount;

    $item_array = array(
        "package_id" => $package_id,
        "title" => $title,
        "price" => $price,
        "price_unit" => $price_unit,
        "quantity" => $quantity,
        "sub_total" => $sub_total,
        "discount" => $discount,
        "total" => $total
    );

    if(isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])){
        if(empty($_SESSION['shopping_cart']['package'])){
            $_SESSION['shopping_cart']['package'][] = $item_array;
            die(json_encode(array(
                "status"=> 1,
                "message"=> "Package has been added to your cart." 
            )));
        }else{
            if(in_array($package_id, array_column($_SESSION['shopping_cart']['package'], 'package_id'))){
                die(json_encode(array(
                    "status"=> 0,
                    "message"=> "This Package already exists in your cart. Please check your cart." 
                )));
            }else{
                unset($_SESSION['shopping_cart']['package']);
                $_SESSION['shopping_cart']['package'][] = $item_array;
                die(json_encode(array(
                    "status"=> 1,
                    "message"=> "Package has been replaced to your cart." 
                )));
            }
        }
    }else{
        $_SESSION['shopping_cart'] = array();
        $_SESSION['shopping_cart']['package'][] = $item_array;
        die(json_encode(array(
            "status"=> 1,
            "message"=> "Package has been added to your cart." 
        )));
    }
}
if(isset($_POST['action'], $_POST['item_type']) && $_POST['action'] == 'remove'){
    if($_POST['item_type'] == 'file'){
        $file_id = $_POST['file_id'];
        if(!empty($_SESSION['shopping_cart']['file'])){
            foreach($_SESSION['shopping_cart']['file'] as $k => $v){
                if($v['file_id'] == $file_id){
                    unset($_SESSION['shopping_cart']['file'][$k]);
                    die(json_encode(array(
                        "status"=> 1,
                        "message"=> "Item has been removed from your cart." 
                    )));
                }
            }
        }
    }
    if($_POST['item_type'] == 'package'){
        $package_id = $_POST['package_id'];
        if(!empty($_SESSION['shopping_cart']['package'])){
            foreach($_SESSION['shopping_cart']['package'] as $k => $v){
                if($v['package_id'] == $package_id){
                    unset($_SESSION['shopping_cart']['package'][$k]);
                    die(json_encode(array(
                        "status"=> 1,
                        "message"=> "Item has been removed from your cart." 
                    )));
                }
            }
        }
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'clear'){
    if(isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])){
        unset($_SESSION['shopping_cart']);
        die(json_encode(array(
            "status"=> 1,
            "message"=> "Cart has been cleared." 
        )));
    }
}
?>