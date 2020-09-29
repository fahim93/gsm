<?php
class Invoice{
    public $id;
    public $order_no;
    public $item_type;
    public $file_id;
    public $file_title;
    public $package_id;
    public $package_title;
    public $price;
    public $quantity;
    public $discount;
    public $sub_total;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = 'invoices';
    }

    public function create(){
        $query = "INSERT INTO {$this->table_name} SET order_no = ?, item_type = ?, file_id = ?, file_title = ?, package_id = ?, package_title = ?, price = ?, quantity = ?, discount = ?, sub_total = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("isisisdidd", $this->order_no, $this->item_type, $this->file_id, $this->file_title, $this->package_id, $this->package_title, $this->price, $this->quantity, $this->discount, $this->sub_total);
        return $obj->execute();
    }

    public function get_all_by_order(){
        $query = "SELECT * FROM {$this->table_name} WHERE order_no = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->order_no);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }
}
?>