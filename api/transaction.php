<?php
include('../conf/dbConfig.php');
include('../classes/Transaction.php');
if(isset($_POST['action']) && $_POST['action'] == 'get-details'){
    $id = $_POST['id'];

    $transaction = new Transaction($conn);
    $transaction->id = $id;

    $data = $transaction->get_details();
    die(json_encode(array("status" => 1, "data" => $data)));
}
?>