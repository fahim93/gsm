<?php
class CustomerPackage{
    public $id;
    public $customer;
    public $package;
    public $expire_on;
    public $is_active;

    private $conn;
    private $customer_packages_tbl;

    public function __construct($db){
        $this->conn = $db;
        $this->customer_packages_tbl = "customer_packages";
    }

    public function get_all(){
        $query = "SELECT * FROM ".$this->customer_packages_tbl;
        $obj = $this->conn->prepare($query);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function get_by_customer(){
        $query = "SELECT cp.*, p.title FROM {$this->customer_packages_tbl} AS cp, packages AS p WHERE cp.package = p.id AND customer = ? AND expire_on >= CURRENT_TIMESTAMP OR expire_on = 'Non Expirable'";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->customer);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function create(){
        $query = "INSERT INTO {$this->customer_packages_tbl} SET customer = ?, package = ?, expire_on = ?, is_active = 1";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("iis", $this->customer, $this->package, $this->expire_on);
        return $obj->execute();
    }
    
    public function make_active(){
        $query = "UPDATE {$this->customer_packages_tbl} SET is_active = 1 WHERE id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->id);
        if($obj->execute()){
            $this->make_inactive();
            return TRUE;
        }
        return FALSE;
    }

    public function make_inactive(){
        $query = "UPDATE {$this->customer_packages_tbl} SET is_active = 0 WHERE customer = ? AND id <> ? AND expire_on >= CURRENT_TIMESTAMP OR expire_on = 'Non Expirable'";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ii", $this->customer, $this->id);
        if($obj->execute()){
            return TRUE;
        }
        return FALSE;
    }

    public function is_exists(){
        $query = "SELECT * FROM ".$this->customer_packages_tbl." WHERE customer = ? AND package = ? AND expire_on >= CURRENT_TIMESTAMP OR expire_on = 'Non Expirable'";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ii", $this->customer, $this->package);
        $obj->execute();
        $data = $obj->get_result();
        if($data->num_rows > 0){
            return TRUE;
        }
        return FALSE;
    }
}
?>