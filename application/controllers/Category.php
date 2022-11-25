<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
        parent::__construct();
       	$this->load->model('category_model');
    }


	public function add_category(){
		$obj = json_decode(file_get_contents('php://input', true));
		$arr = array();
		$arr['name'] =  $obj->name;
		$id = $this->category_model->add_category($arr);
		$this->create_url($id, $obj->name);
	}

	public function update_category(){
		$obj = json_decode(file_get_contents('php://input', true));
		$arr = array();
		$arr['name'] = $obj->name;
		$id = $obj->id;
		$this->load->model('category_model');
		$this->category_model->update_category($arr, $id);
	}


	public function remove_category(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('category_model');
		$this->category_model->remove_category($obj->id);
	}

	public function get_category(){
		$parr = array(); $carr = array();
		$this->load->model('category_model');
		$res = $this->category_model->get_category();
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['name'] = $rr->name;
				$carr['url'] = base_url().'topic/'.$rr->url;
				$carr['post'] = $this->category_model->total_post_by_cat($rr->id);
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	public function single_category(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('category_model');
		$res = $this->category_model->single_category($obj->id);
		if(!empty($res)){
			echo json_encode($res);
		}
	}
	public function create_url($id, $name){
			$to_low = strtolower($name);
			$string = str_replace(' ','-',$to_low);
			$url = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			$res = $this->category_model->url_check($url);
			if($res == 'YES'){
					$unic_string = date('y-m-d:H:m:s');
					$url = $url.'-'.$unic_string;
			}
			$this->category_model->update_url($id, $url);
	}

}
