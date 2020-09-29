<?php

class Package{

  // define properties
    public $id;
    public $title;
    public $description;
    public $is_paid;
    public $price;
    public $price_unit;
    public $validity;
    public $validity_period;
    public $validity_period_unit;
    public $devices;
    public $device_amount;
    public $is_public;
    public $is_active;
    public $bandwith_size;
    public $bandwith_size_unit;
    public $bandwith_size_in_bytes;
    public $file_type;
    public $bandwith_limit_file;
    public $daily_file_limit;
    public $daily_download_size;
    public $daily_download_size_unit;
    public $daily_download_size_in_bytes;
    public $free_file_limit;
    public $free_file_size;
    public $free_file_size_unit;
    public $free_file_size_in_bytes;

    private $conn;
    private $packages_tbl;

    // Constructor
    public function __construct($db){
        $this->conn = $db;
        $this->packages_tbl = "packages";
    }

    public function get_all_packages(){
        $query = "SELECT * FROM ".$this->packages_tbl;
        $obj = $this->conn->prepare($query);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
            // $data = $obj->get_result();
            // $data_arr = array();
            // foreach($data as $d){
            //     $data_arr[] = $d;
            // }
            // return $data_arr;
        }
        return array();
    }

    public function get_all_active_packages(){
        $query = "SELECT * FROM ".$this->packages_tbl." WHERE is_active = 1";
        $obj = $this->conn->prepare($query);
        if($obj->execute()){
            return $obj->get_result()->fetch_all(MYSQLI_ASSOC);
            // $data = $obj->get_result();
            // $data_arr = array();
            // foreach($data as $d){
            //     $data_arr[] = $d;
            // }
            // return $data_arr;
        }
        return array();
    }

    public function get_package_by_id(){
        $query = "SELECT * FROM ".$this->packages_tbl." WHERE id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param("i", $this->id);
        if($obj->execute()){
            return $obj->get_result()->fetch_assoc();
        }
        return array();
    }
}
?>