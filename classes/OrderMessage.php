<?php
class OrderMessage{
    public $id;
    public $order_id;
    public $message_from;
    public $message;
    public $created_at;
    public $updated_at;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = "orders_messages";
    }

    public function send(){
        $query = "INSERT INTO {$this->table_name} SET order_id = ?, message_from = ?, message = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("iis", $this->order_id, $this->message_from, $this->message);
        return $obj->execute();
    }

    public function get_by_order(){
        $query = "SELECT * FROM {$this->table_name} WHERE order_id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->order_id);
        if($obj->execute()){
            $data = $obj->get_result();
            return $data->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }
}
?>