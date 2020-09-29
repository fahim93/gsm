<?php
class Transaction{
    public $id;
    public $customer;
    public $invoice;
    public $admin_pay;
    public $gateway;
    public $gateway_identity;
    public $amount;
    public $status;
    public $created_at;
    public $updated_at;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = "transactions";
        $this->admin_pay = 0;
        $this->status = 1;
        $this->gateway_identity = '';
    }

    public function create(){
        $query = "INSERT INTO {$this->table_name} SET customer = ?, invoice = ?, admin_pay = ?, gateway = ?, gateway_identity = ?, amount = ?, status = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("iiissdi", $this->customer, $this->invoice, $this->admin_pay, $this->gateway, $this->gateway_identity, $this->amount, $this->status);
        return $obj->execute();
    }

    public function get_all_by_customer(){
        $query = "SELECT * FROM {$this->table_name} WHERE customer = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->customer);
        if($obj->execute()){
            $data = $obj->get_result();
            return $data->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function get_by_invoice(){
        $query = "SELECT * FROM {$this->table_name} WHERE invoice = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->invoice);
        if($obj->execute()){
            $data = $obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

}
?>