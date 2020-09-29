<?php
class CustomerAccount{
    public $id;
    public $customer;
    public $total_business;
    public $total_topup;
    public $current_balance;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = 'customers_accounts';
    }

    public function create(){
        $query = "INSERT INTO {$this->table_name} SET customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->customer);
        return $obj->execute();
    }

    public function get_all(){
        $query = "SELECT * FROM {$this->table_name}";
        $obj = $this->conn->prepare($query);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function get_by_customer(){
        $query = "SELECT * FROM {$this->table_name} WHERE customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->customer);
        if($obj->execute()){
            $data = $obj->get_result()->fetch_assoc();
            return $data;
        }
        return array();
    }
}
?>