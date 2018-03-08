<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradezAPI extends CI_Controller {
  /**
   * [signUp for signing up users]
   * @param  [type] $fullName [description]
   * @param  [type] $userName [description]
   * @param  [type] $email    [description]
   * @param  [type] $phone    [description]
   * @param  [type] $password [description]
   * @return [type]           [description]
   */
  function signUp($fullName, $userName, $email, $phone, $password) {
    $this->load->model("UserManager", "users");
    $data = array();
    if ($this->users->createUser($fullName, $userName, $email, $phone, $password)) {
      $data["response"] = 1;
    } else {
      $data["response"] = 0;
    }
    echo json_encode($data);
  }

  function validateUserName($userName) {
    $this->load->model("UserManager", "users");
    $data = array();
    if ($this->users->validateUserName($userName)) {
      $data["valid"] = 1;
    } else {
      $data["valid"] = 0;
    }
    echo json_encode($data);
  }

}
?>
