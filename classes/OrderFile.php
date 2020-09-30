<?php
class OrderFile{
    public $id;
    public $order_id;
    public $order_no;
    public $file_id;
    public $file_title;
    public $price;
    public $quantity;
    public $sub_total;
    public $discount;
    public $total;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = 'orders_files';
    }

    public function create(){
        $query = "INSERT INTO {$this->table_name} SET order_id = ?, order_no = ? file_id = ?, file_title = ?, price = ?, quantity = ?, sub_total = ?, discount = ?, total = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("iiisdiddd", $this->order_id, $this->order_no, $this->file_id, $this->file_title, $this->price, $this->quantity, $this->sub_total, $this->discount, $this->total);
        return $obj->execute();
    }

    public function get_all_by_order(){
        $query = "SELECT * FROM {$this->table_name} WHERE order_id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->order_id);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function get_by_customer($customer){
        $query = "SELECT of.*, o.created_at FROM {$this->table_name} AS of, orders AS o WHERE of.order_id = o.id AND o.order_by = ? AND o.is_paid = 1";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $customer);
        if($obj->execute()){
            $data = $obj->get_result();
            return $data->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function get_details(){
        $query = "SELECT of.*, o.created_at, f.file_method, f.direct_url, f.file FROM {$this->table_name} AS of, orders AS o, files AS f WHERE of.order_id = o.id AND of.file_id = f.id  AND o.is_paid = 1 AND of.id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->id);
        if($obj->execute()){
            $data = $obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }
}
?>