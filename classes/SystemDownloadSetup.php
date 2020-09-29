<?php
class SystemDownlodSetup{
    public $id;

    private $conn;
    private $table_name;

    public function __construct($db){
        $this->conn = $db;
        $this->table_name = "system_download_setup";
    }

    public function get_data(){
        $query = "SELECT * FROM {$this->table_name} LIMIT 1";
        $obj = $this->conn->prepare($query);
        if($obj->execute()){
            return $obj->get_result()->fetch_assoc();
        }
        return array();
    }
}
?>