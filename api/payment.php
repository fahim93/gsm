<?php
include('../conf/dbConfig.php');
include('../classes/Order.php');
include('../classes/Account.php');
include('../classes/Transaction.php');
if(isset($_POST['action']) && $_POST['action'] == 'create-payment'){
    $payment_method = $_POST['payment_method'];
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];

    $order = new Order($conn);
    $order->order_by = $customer_id;
    $order->id = $order_id;

    $order_data = $order->get_by_id_and_customer();
    $bill_amount = $order_data['bill_amount'];
    $order_no = $order_data['order_no'];

    $account = new Account($conn);
    $account->customer = $customer_id;
    $current_balance = $account->get_balance();
    if($current_balance < $bill_amount){
        die(json_encode(array(
            "status" => 0,
            "message" => "Insufficient Balance."
        )));
    }

    $order->status = "Completed";
    $order->is_paid = 1;
    if($order->update()){
        if($account->pay($bill_amount)){
            $transaction = new Transaction($conn);
            $transaction->customer = $customer_id;
            $transaction->invoice = $order_no;
            $transaction->amount = $bill_amount;
            $transaction->gateway = $payment_method;
            if($transaction->create()){
                die(json_encode(array(
                    "status" => 1,
                    "message" => "Thanks! Payment has been completed."
                )));
            }else{
                die(json_encode(array(
                    "status" => 0,
                    "message" => "Transaction Problem."
                )));
            }
        }else{
            die(json_encode(array(
                "status" => 0,
                "message" => "Account Problem."
            )));
        }
    }else{
        die(json_encode(array(
            "status" => 0,
            "message" => "Order Problem."
        )));
    }

}
?>