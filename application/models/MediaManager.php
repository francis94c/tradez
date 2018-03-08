<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MediaManager extends CI_Model {

  function getVideos($adId) {
    return $this->db->get_where("videos", array("ad_id" => $adId))->result_array();
  }

  function getImages($adId) {
    return $this->db->get_where("images", array("ad_id" => $adId))->result_array();
  }

  function getImageUrl($image) {
    return base_url("images/$image");
  }

  function getVideoUrl($video) {
    return base_url("videos/$video");
  }

  function getImageFileName($image) {
    return $image . ".jpg";
  }

  function getVideoFileName($video) {
    return $video . ".mp4";
  }

  function deleteImage($id) {
    $this->db->where("id", $id);
    return $this->db->delete("images");
  }

  function deleteVideo($id) {
    $this->db->where("id", $id);
    return $this->db->delete("videos");
  }

  function getImage($id) {
    return $this->db->get_where("images", array("id" => $id))->result_array()[0];
  }

  function getVideo($id) {
    return $this->db->get_where("videos", array("id" => $id))->result_array()[0];
  }

  function createVideo($adId) {
    $data = array();
    $this->load->helper("string");
    $data["name"] = random_string('alnum', 10);
    $data["ad_id"] = $adId;
    if ($this->db->insert("videos", $data)) {
      return $this->db->insert_id();
    }
    return -1;
  }

  function createImage($adId) {
    $data = array();
    $this->load->helper("string");
    $data["name"] = random_string('alnum', 10);
    $data["ad_id"] = $adId;
    if ($this->db->insert("images", $data)) {
      return $this->db->insert_id();
    }
    return -1;
  }

}
?>