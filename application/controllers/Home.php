<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function index(){
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->view("upload");
	}
	
	function test() {
		$config["upload_path"] = FCPATH . "videos";
    $config["allowed_types"] = "*";
	$adId = 1;
	$config["max_size"] = 70000;
	$config['overwrite'] = FALSE;
$config['remove_spaces'] = TRUE;
    $this->load->helper("string");
    $fileName = random_string("alnum", 10);
    $config["file_name"] = $fileName . ".mp4";
    $this->load->library("upload", $config);
	$this->upload->initialize($config);
    $data = array();
    if (!$this->upload->do_upload("userfile")) {
      $data["success"] = 0;
	  echo $this->upload->display_errors();
	  print_r($_FILES);
    } else {
      $this->load->model("MediaManager", "media");
      if ($this->media->addVideo($adId, $fileName)) {
        $data["success"] = 1;
      } else {
        $data["success"] = 0;
      }
    }
    echo json_encode($data);
	}
}
?>