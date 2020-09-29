<?php

class Customer{

  // define properties
  public $id;
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
  public $ip;
  public $login_at;
  public $token;


  private $conn;
  private $customers_tbl;

  public function __construct($db){
     $this->conn = $db;
     $this->customers_tbl = "customers";
  }

  public function create(){
    $query = "INSERT INTO {$this->customers_tbl} SET name = ?, username = ?, email = ?, password = ?, phone = ?, country = ?, city = ?, address = ?, zip_code = ?";
    $obj = $this->conn->prepare($query);
    $obj->bind_param("sssssssss", $this->name, $this->username, $this->email, $this->password, $this->phone, $this->country, $this->city, $this->address, $this->zip_code);
    return $obj->execute();
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
  public function is_exists_email(){

    $query = "SELECT * from ".$this->customers_tbl." WHERE email = ?";

    $customer_obj = $this->conn->prepare($query);

    $customer_obj->bind_param("s", $this->email);

    if($customer_obj->execute()){

      $data = $customer_obj->get_result();
      if($data->num_rows > 0){
        return TRUE;
      }
      return FALSE;
        
    }

    return FALSE;
  }
  public function is_exists_username(){

    $query = "SELECT * from ".$this->customers_tbl." WHERE username = ?";

    $customer_obj = $this->conn->prepare($query);

    $customer_obj->bind_param("s", $this->username);

    if($customer_obj->execute()){

      $data = $customer_obj->get_result();
      if($data->num_rows > 0){
        return TRUE;
      }
      return FALSE;
        
    }

    return FALSE;
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

  public function update_token(){
    $token_query = "UPDATE ".$this->customers_tbl." SET token = ? WHERE id = ?";
    $customer_obj = $this->conn->prepare($token_query);
    $customer_obj->bind_param("si", $this->token, $this->id);

    if($customer_obj->execute()){
      return TRUE;
    }
    return FALSE;

  }

  public function update_login_info(){
    $query = "UPDATE ".$this->customers_tbl." SET ip = ?, login_at = ? WHERE id = ?";
    $customer_obj = $this->conn->prepare($query);
    $customer_obj->bind_param("ssi", $this->ip, $this->login_at, $this->id);
    if($customer_obj->execute()){
      return TRUE;
    }
    return FALSE;
  }

  public function get_customer_by_id(){
    $query = "SELECT * FROM ".$this->customers_tbl." WHERE id = ?";
    $customer_obj = $this->conn->prepare($query);
    $customer_obj->bind_param("i", $this->id);
    $customer_obj->execute();
    return $customer_obj->get_result();
  }

  public function get_customer_by_email(){
    $query = "SELECT * FROM ".$this->customers_tbl." WHERE email = ?";
    $customer_obj = $this->conn->prepare($query);
    $customer_obj->bind_param("s", $this->email);
    if($customer_obj->execute()){
      return $customer_obj->get_result()->fetch_assoc();
    }
    return array();
  }

  public function update_profile_info(){
    $query = "UPDATE " . $this->customers_tbl . " SET name = ?, phone = ?, country = ?, city = ?, address = ?, zip_code = ?, image = ? WHERE id = ?";
    $obj = $this->conn->prepare($query);
    $obj->bind_param("sssssssi", $this->name, $this->phone, $this->country, $this->city, $this->address, $this->zip_code, $this->image, $this->id);
    if($obj->execute()){
      return TRUE;
    }
    return FALSE;
  }

  public function update_password(){
    $query = "UPDATE " . $this->customers_tbl . " SET password = ? WHERE id = ?";
    $obj = $this->conn->prepare($query);
    $obj->bind_param("si", $this->password, $this->id);
    if($obj->execute()){
      return TRUE;
    }
    return FALSE;
  }

  public function update_email(){
    $query = "UPDATE " . $this->customers_tbl . " SET email = ? WHERE id = ?";
    $obj = $this->conn->prepare($query);
    $obj->bind_param("si", $this->email, $this->id);
    if($obj->execute()){
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
