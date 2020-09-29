<?php
class Account{
    public $id;
    public $customer;
    public $total_business;
    public $total_topup;
    public $current_balance;
    public $status;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = "customers_accounts";
        $this->status = 1;
    }

    public function deposit($amount){
        $query = "UPDATE {$this->table_name} SET total_topup = total_topup + ?, current_balance = current_balance + ? WHERE customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ddi", $amount, $amount, $this->customer);
        return $obj->execute();
    }

    public function pay($amount){
        $query = "UPDATE {$this->table_name} SET total_business = total_business + ?, current_balance = current_balance - ? WHERE customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ddi", $amount, $amount, $this->customer);
        return $obj->execute();
    }

    public function transfer($amount){
        $query = "UPDATE {$this->table_name} SET current_balance = current_balance - ? WHERE customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ddi", $amount, $this->customer);
        return $obj->execute();
    }

    public function get_balance(){
        $query = "SELECT current_balance FROM {$this->table_name} WHERE customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->customer);
        if($obj->execute()){
            $data = $obj->get_result()->fetch_assoc();
            $current_balance = $data['current_balance'];
            return $current_balance;
        }
        return 0;
    }
}
?>