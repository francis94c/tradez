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
  function signUp() {
    $fullName = $this->input->post("full_name");
    $userName = $this->input->post("user_name");
    $email = $this->input->post("email");
    $phone = $this->input->post("phone");
    $password = $this->input->post("password");
    $this->load->model("UserManager", "users");
    $data = array();
    if ($this->users->createUser($fullName, $userName, $email, $phone, $password)) {
      $data["response"] = 1;
    } else {
      $data["response"] = 0;
    }
    echo json_encode($data);
  }

  /**
   * [validateUserName description]
   * @param  [type] $userName [description]
   * @return [type]           [description]
   */
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

  /**
   * [validateUser description]
   * @param  [type] $userName [description]
   * @param  [type] $password [description]
   * @return [type]           [description]
   */
  function validateUser() {
    $userName = $this->input->post("email");
    $password = $this->input->post("password");
    $this->load->model("UserManager", "users");
    $data = array();
    if ($this->users->validateUser($userName, $password)) {
      $data["user_id"] = $this->users->getUserId($userName);
      $data["user"] = $this->db->getUser($data["user_id"]);
    } else {
      $data["user_id"] = -1;
    }
    echo json_encode($data);
  }

  /**
   * [createAd description]
   * @param  [type] $userId   [description]
   * @param  [type] $title    [description]
   * @param  [type] $location [description]
   * @return [type]           [description]
   */
  function createAd($userId, $title, $location, $category, $subCategory) {
    $this->load->model("AdsManager", "ads");
    $data = array();
    $data["ad_id"] = $this->ads->createAd($userId, $title, $location, $category, $subCategory);
    echo json_encode($data);
  }

  /**
   * [addImage description]
   * @param [type] $adId [description]
   */
  function addImage($adId) {
    $config["upload_path"] = FCPATH . "images";
    $config["allowed_types"] = "gif|jpg|png";
    $this->load->helper("string");
    $fileName = random_string("alnum", 10);
    $config["file_name"] = $fileName . ".jpg";
    $this->load->library("upload", $config);
    $data = array();
    if (!$this->upload->do_upload("ad_image")) {
      $data["success"] = 0;
    } else {
      $this->load->model("MediaManager", "media");
      if ($this->media->addImage($adId, $fileName)) {
        $data["success"] = 1;
      } else {
        $data["success"] = 0;
      }
    }
    echo json_encode($data);
  }

  function getAdImages($adId) {

  }

  function getAdVideos($adId) {

  }

  function getMyAds($userId) {

  }

  function deleteAd($userId, $adId) {

  }

  function getUserContact() {

  }

  function getAds() {

  }

  function getCategories() {

  }

  function getSubCategories() {

  }

  function getAdsByCategory($cid) {

  }

  function searchAds() {

  }

}
?>
