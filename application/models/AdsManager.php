<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdsManager extends CI_Model {

  function createAd($userId, $title, $location, $category, $subCategory) {
    $data = array();
    $data["user_id"] = $this->security->xss_clean($userId);
    $data["title"] = $this->security->xss_clean($title);
    $data["location"] = $this->security->xss_clean($location);
    $data["category_id"] = $category;
    $data["sub_category_id"] = $subCategory;
    if ($this->db->insert("ads", $data)) {
      return $this->db->insert_id();
    }
    return -1;
  }

  function getAd($id) {
    return $this->db->get_where("ads", array("id"=>$id));
  }

  function searchAds($like) {
    $this->db->like("title", $title);
    return $this->db->get("ads")->result_array();
  }

  function getAdsInCategory($cid) {
    return $this->db->get_where("ads", array("category_id"=>$cid))->result_array();
  }

  function getAdsInSubCategory($subCategoryId) {
    return $this->db->get_where("ads", array("sub_category_id"=>$cid))->result_array();
  }

  function deleteAd($id) {
    $this->db->where("id", $id);
    return $this->db->delete("ads");
  }

  function setAdLocation($id, $location) {
    $this->db->where("id", $id);
    return $this->db->update("ads", array("location"=>$location));
  }

  function setAdLatLong($id, $latLong) {
    $this->db->where("id", $id);
    return $this->db->update("ads", array("lat_long"=>$latLong));
  }

}
?>
