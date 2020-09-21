<?php

class Customer{

  // define properties
  public $name;
  public $username;
  public $email;
  public $password;
  public $phone;
  public $country;
  public $city;
  public $address;
  public $zip_code;
  public $image;
  public $is_active;


  private $conn;
  private $customers_tbl;

  public function __construct($db){
     $this->conn = $db;
     $this->customers_tbl = "customers";
  }

  public function create_customer(){
    $qry = "INSERT INTO $this->customers_tbl (name, username, email, password, phone, country, city, address, zip_code) VALUES('$this->name', '$this->username', '$this->email', '$this->password', '$this->phone', '$this->country', '$this->city', '$this->address', '$this->zip_code')";
    if($this->conn->query($qry)){
      return true;
    }
    return false;
    // $customer_query = "INSERT INTO ".$this->customers_tbl." SET name = ?, username = ? email = ?, password = ?, phone = ?, country = ?, city = ?, address = ?, zip_code = ?";

    // $customer_obj = $this->conn->prepare($customer_query);

    // $customer_obj->bind_param("sssssssss", $this->name, $this->username, $this->email, $this->password, $this->phone, $this->country, $this->city, $this->address, $this->zip_code);

    // if($customer_obj->execute()){
    //   return true;
    // }

    // return false;
  }

  public function check_email(){

    $email_query = "SELECT * from ".$this->customers_tbl." WHERE email = ?";

    $customer_obj = $this->conn->prepare($email_query);

    $customer_obj->bind_param("s", $this->email);

    if($customer_obj->execute()){

       $data = $customer_obj->get_result();

       return $data->fetch_assoc();
    }

    return array();
  }

  public function check_login(){

    $email_query = "SELECT * from ".$this->customers_tbl." WHERE email = ?";

    $customer_obj = $this->conn->prepare($email_query);

    $customer_obj->bind_param("s", $this->email);

    if($customer_obj->execute()){

       $data = $customer_obj->get_result();

       return $data->fetch_assoc();
    }

    return array();
  }

  public function update_token($id, $jwt){
    $token_query = "UPDATE ".$this->customers_tbl." SET token = ? WHERE id = ?";
    $customer_obj = $this->conn->prepare($token_query);
    $customer_obj->bind_param("si", $jwt, $id);

    if($customer_obj->execute()){
      return TRUE;
    }
    return FALSE;

  }

  // to create projects
  // public function create_project(){

  //     $project_query = "INSERT into ".$this->projects_tbl." SET user_id = ?, name = ?, description = ?, status = ?";

  //     $project_obj = $this->conn->prepare($project_query);
  //     // sanitize input variables
  //     $project_name = htmlspecialchars(strip_tags($this->project_name));
  //     $description = htmlspecialchars(strip_tags($this->description));
  //     $status = htmlspecialchars(strip_tags($this->status));
  //     // bind parameters
  //     $project_obj->bind_param("isss", $this->user_id, $project_name, $description, $status);

  //     if($project_obj->execute()){
  //       return true;
  //     }

  //     return false;

  // }

  // used to list all projects
  // public function get_all_projects(){

  //   $project_query = "SELECT * from ".$this->projects_tbl." ORDER BY id DESC";

  //   $project_obj = $this->conn->prepare($project_query);

  //   $project_obj->execute();

  //   return $project_obj->get_result();

  // }

  // public function get_user_all_projects(){

  //   $project_query = "SELECT * from ".$this->projects_tbl." WHERE user_id = ? ORDER BY id DESC";

  //   $project_obj = $this->conn->prepare($project_query);

  //   $project_obj->bind_param("i", $this->user_id);

  //   $project_obj->execute();

  //   return $project_obj->get_result();

  // }
}

 ?>
