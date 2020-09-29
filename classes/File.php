<?php

class File{

  // define properties
    public $id;
    public $title;
    public $description;


    private $conn;
    private $files_tbl;

    // Constructor
    public function __construct($db){
        $this->conn = $db;
        $this->files_tbl = "files";
    }

    public function get_all_files(){
        $query = "SELECT * FROM ".$this->files_tbl;
        $obj = $this->conn->prepare($query);
        $obj->execute();
        return $obj->get_result();
    }

    public function get_all_active_files(){
        $query = "SELECT * FROM ".$this->files_tbl." WHERE is_active = 'Yes'";
        $obj = $this->conn->prepare($query);
        $obj->execute();
        return $obj->get_result();
    }

    public function get_file_by_id(){
        $query = "SELECT * FROM ".$this->files_tbl." WHERE id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->id);
        if($obj->execute()){
            return $obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function is_active(){
        $query = "SELECT * FROM ".$this->files_tbl." WHERE id = ? AND is_active = 'Yes'";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->id);
        $obj->execute();
        $result = $obj->get_result();
        if($result->num_rows > 0){
            return TRUE;
        }
        return FALSE;
    }
}
?>