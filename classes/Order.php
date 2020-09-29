<?php
class Order{
    public $id;
    public $order_no;
    public $order_by;
    public $sub_total;
    public $discount;
    public $tax;
    public $bill_amount;
    public $bill_unit;
    public $notes;
    public $is_paid;
    public $status;
    public $completed_at;
    public $created_at;
    public $files;
    public $packages;

    private $conn;
    private $table_name;
    private $order_no_start_from;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = 'orders';
        $this->is_paid = 0;
        $this->status = 'Pending';
        $this->order_no_start_from = 1001;
    }

    private function generate_new_order_no(){
        $query = "SELECT MAX(order_no) AS max_order_no FROM {$this->table_name}";
        $obj = $this->conn->prepare($query);
        $obj->execute();
        $data = $obj->get_result()->fetch_assoc();
        if(!empty($data['max_order_no'])){
            return $data['max_order_no'] + 1;
        }
        return $this->order_no_start_from;
    }

    public function create(){
        $new_order_no = $this->generate_new_order_no();
        $query = "INSERT INTO {$this->table_name} SET order_no = ?, order_by = ?, sub_total = ?, discount = ?, tax = ?, bill_amount = ?, bill_unit = ?, notes = ?, is_paid = ?, status = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("iiddddssis", $new_order_no, $this->order_by, $this->sub_total, $this->discount, $this->tax, $this->bill_amount, $this->bill_unit, $this->notes, $this->is_paid, $this->status);
        if($obj->execute()){
            $last_entry_query = "SELECT LAST_INSERT_ID() AS order_id FROM {$this->table_name}";
            $last_entry_obj = $this->conn->prepare($last_entry_query);
            if($last_entry_obj->execute()){
                $order_id = $last_entry_obj->get_result()->fetch_assoc()['order_id'];
                if(!empty($this->files)){
                    foreach($this->files as $f){
                        $order_no = $new_order_no;
                        $file_id = $f['file_id'];
                        $file_title = $f['title'];
                        $price = $f['price'];
                        $quantity = $f['quantity'];
                        $sub_total = $f['sub_total'];
                        $discount = $f['discount'];
                        $total = $f['total'];
                        $f_qry = "INSERT INTO orders_files SET order_id = ?, order_no = ?, file_id = ?, file_title = ?, price = ?, quantity = ?, sub_total = ?, discount = ?, total = ?";
                        $f_obj = $this->conn->prepare($f_qry);
                        $f_obj->bind_param("iiisdiddd", $order_id, $order_no, $file_id, $file_title, $price, $quantity, $sub_total, $discount, $total);
                        $f_obj->execute();
                    }
                }
                if(!empty($this->packages)){
                    foreach($this->packages as $p){
                        $order_no = $new_order_no;
                        $package_id = $p['package_id'];
                        $package_title = $p['title'];
                        $price = $p['price'];
                        $quantity = $p['quantity'];
                        $sub_total = $p['sub_total'];
                        $discount = $p['discount'];
                        $total = $p['total'];
                        $p_qry = "INSERT INTO orders_packages SET order_id = ?, order_no = ?, package_id = ?, package_title = ?, price = ?, quantity = ?, sub_total = ?, discount = ?, total = ?";
                        $p_obj = $this->conn->prepare($p_qry);
                        $p_obj->bind_param("iiisdiddd", $order_id, $order_no, $package_id, $package_title, $price, $quantity, $sub_total, $discount, $total);
                        $p_obj->execute();
                    }
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    public function update(){
        $query = "UPDATE {$this->table_name} SET status = ?, is_paid = ? WHERE id = ? AND order_by = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("siii", $this->status, $this->is_paid, $this->id, $this->order_by);
        return $obj->execute();

    }

    public function delete(){
        $query = "DELETE FROM {$this->table_name} WHERE id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->id);
        return $obj->execute();
    }

    public function get_all(){
        $query = "SELECT * FROM {$this->table_name} ORDER BY created_at DESC";
        $obj = $this->conn->prepare($query);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }
    
    public function get_all_by_customer(){
        $query = "SELECT * FROM {$this->table_name} WHERE order_by = ? ORDER BY created_at DESC";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->order_by);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    public function get_by_id_and_customer(){
        $query = "SELECT * FROM {$this->table_name} WHERE id = ? AND order_by = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ii", $this->id, $this->order_by);
        if($obj->execute()){
            return $obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function get_invoice(){
        $query = "SELECT o.*, c.name, c.country, c.city, c.address, c.zip_code FROM {$this->table_name} AS o, customers as c WHERE o.order_by = c.id AND o.id = ? AND o.order_by = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ii", $this->id, $this->order_by);
        if($obj->execute()){
            return $obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function get_customer_order_by_payment_status(){
        $query = "SELECT * FROM {$this->table_name} WHERE order_by = ? AND is_paid = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("ii", $this->order_by, $this->is_paid);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }
}
?>