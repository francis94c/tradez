<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryManager extends CI_Model {

  function getCategories() {
    return $this->db->get("categories")->result_array();
  }

  function getSubCategories($cid) {
    return $this->db->get_where("sub_categories", array("category_id" => $cid))->result_array();
  }

  function getCategoryName($id) {
    return $this->db->get_where("categories", array("id" => $id))->result()[0]->name;
  }

  function getSubCategoryName($id) {
    return $this->db->get_where("sub_categories", array("id" => $id))->result()[0]->name;
  }

}
?>
