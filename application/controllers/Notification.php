<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

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
       	$this->load->model('notification_model');         
    }


	

	public function add_notification(){
		$obj = json_decode(file_get_contents('php://input', true));
		$arr = array();
		// $arr['user_ref'] = $obj->user_ref;
		// $arr['icon'] = $obj->icon;
		// $arr['text'] = $obj->text;

		$uid = $this->session->userdata('uid');

		$arr['user_ref'] = $uid;
		$arr['icon'] = '<i></i>';
		$arr['text'] = 'Demo Text';
		$this->notification_model->add_notification($arr);
	}

	public function remove_notification(){
		$obj = json_decode(file_get_contents('php://input', true));
		//$not_id = $obj->id;
		$not_id = 3;
		$this->notification_model->remove_notification($not_id);
	}

	public function get_notification(){
		$parr = array(); $carr = array();
		$uid = $this->session->userdata('uid'); 
		$res = $this->notification_model->get_notification($uid);
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['user_ref'] = $rr->user_ref;
				$carr['icon'] = $rr->icon;
				$carr['text'] = $rr->text;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	/*public function add_admin_notification(){
		$arr = array();
		$arr['icon'] = '<i></i>';
		$arr['text'] = 'Demo Admin Text';
		$this->notification_model->add_admin_notification($arr);
	}

	public function remove_admin_notification(){
		$obj = json_decode(file_get_contents('php://input', true));
		//$not_id = $obj->id;
		$not_id = 2;
		$this->notification_model->remove_admin_notification($not_id);
	}

	public function get_admin_notification(){
		$parr = array(); $carr = array();
		$res = $this->notification_model->get_admin_notification();
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['icon'] = $rr->icon;
				$carr['text'] = $rr->text;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	} */

	public function clear_all_notiy(){
		$obj = json_decode(file_get_contents('php://input', true));
		$uid = $this->session->userdata('uid'); 
		$this->notification_model->clear_all_notiy($uid);
	}
	

}
