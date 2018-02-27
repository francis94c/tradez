<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManager extends CI_Model {

  function createUser($fullName, $userName, $email, $phone, $password) {
    $data = array();
    $data["full_name"] = $this->security->xss_clean($fullName);
    $data["username"] = $this->security->xss_clean($userName);
    $data["email"] = $this->security->xss_clean($email);
    $data["phone"] = $this->security->xss_clean($phone);
    $data["password"] = password_hash($this->security->xss_clean($password), PASSWORD_DEFAULT);
    return $this->db->insert("users", $data);
  }

  function getUser($id) {
    return $this->db->get_where("users", array("id"=>$id))->result_array()[0];
  }

  function validateUsername($userName) {
    $this->db->where("username", $userName);
    if ($this->db->count_all_results() > 0) {
      $this->db->reset_query();
      return false;
    }
    return true;
  }

  function validatePhone($phone) {
    $this->db->where("phone", $phone);
    if ($this->db->count_all_results() > 0) {
      $this->db->reset_query();
      return false;
    }
    return true;
  }

  function validateEmail($email) {
    $this->db->where("email", $email);
    if ($this->db->count_all_results() > 0) {
      $this->db->reset_query();
      return false;
    }
    return true;
  }

  function changeFullName($id, $fullName) {
    $this->db->where("id", $id);
    return $this->db->update("users", array("full_name"=>$fullName));
  }

  function validateLogin($user, $password) {
    $this->db->where("username", $user);
    $this->db->or_where("email", $user);
    $this->db->or_where("phone", $user);
    $hash = $this->db->get("users")->result()[0]->password;
    if (password_verify($password, $hash)) {
      return true;
    }
    return false;
  }

}
?>
