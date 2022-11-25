<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
       	$this->load->model('email_model');
		$this->load->model('category_model');
		$this->load->model('posts_model');
		$this->load->model('users_model');
		$this->load->model('admin_model');
		$this->load->model('ads_model');
		$this->load->model('settings_model');
		$this->title = 'Atom Forum';
		$uid = $this->session->userdata('uid');
		if(!empty($uid)){
			$this->single = $this->users_model->single_users($uid);
			$this->single->image = $this->users_model->profile_image_Check($this->single->image);
			
		}
		$this->page_detail = $this->admin_model->single_admin();
	
		
    }
	public function index($ofset = 0){
		$this->load->library('pagination');
		$this->load->model('common_model');
		$config['base_url'] = base_url().'page/';
		$config['total_rows'] = $this->common_model->get_post_count();
		$setting = $this->settings_model->get_settings();
		$config['per_page'] = $setting->pp;
		$this->config->load('pagination');
		$this->pagination->initialize($config);
		$res = $this->posts_model->get_posts($config['per_page'], $ofset);
		$data['category'] = $this->get_category();
		$data['posts'] = $this->get_posts($res);
		$top_res = $this->posts_model->get_top_posts();
		$data['top_post'] = $this->get_posts($top_res);
		$data['ads'] = $this->ads_model->add_ads();
		$data['txt'] = $this->ads_model->get_footer_script();
		$data['main_content'] ='pages/index';
    	$this->load->view('template', $data);
	}
	
	public function user_profile($url){
		$single = $this->users_model->get_id_by_url($url);
		$uid = $this->session->userdata('uid');
		if($single['id'] == $uid){
			header('Location:'.base_url().'users/dashboard');
		}else{
			if(!empty($single)){
				$data['category'] = $this->get_category();
				$res = $this->users_model->get_my_post($single['id'], 30);
				$data['posts'] = $this->get_posts($res);
				$data['single'] = $single;
				$data['post_count'] = $this->users_model->my_post_count($single['id']);
				$data['replay_count'] = $this->users_model->my_replay_count($single['id']);
				$data['main_content'] ='pages/view_profile';
				$this->load->view('template', $data);
			}else{
				header('Location:'.base_url().'404');
			}
		}
		
		
	}
	public function single_post($url){
		$this->vue = array('vue/post_vue.js');
		$id = $this->posts_model->get_id_by_url($url);
		$this->post_id = $id;
		$this->posts_model->add_view_count($this->post_id);
		$data['single'] = $this->single_posts($id);
		$data['category'] = $this->get_category();
		$top_res = $this->posts_model->get_top_posts();
		$data['top_post'] = $this->get_posts($top_res);
		$uid = $this->session->userdata('uid');
		if($uid == $data['single']['user_ref']){
			$data['edit'] = 1;
		}else{
			$data['edit'] = 0;
		}
		$data['ads'] = $this->ads_model->add_ads();
		$data['txt'] = $this->ads_model->get_footer_script();
		$data['main_content'] ='pages/single_post';
		$this->load->view('template', $data);
		

	}
	public function post_by_category($url, $off=0){	
		$data['single'] = $this->category_model->get_id_by_url($url);
		$this->load->library('pagination');
		if(!empty($data['single'])){
			$this->cat_id = $data['single']->id;
			$this->load->model('common_model');
			$config['base_url'] = base_url().'topic/'.$data['single']->url;
			$config['total_rows'] = $this->common_model->get_post_bu_cat_count($this->cat_id);
			$setting = $this->settings_model->get_settings();
			$config['per_page'] = $setting->pp;
			$this->config->load('pagination');
			$this->pagination->initialize($config);
			$post = $this->posts_model->get_posts_by_cat($this->cat_id, $config['per_page'], $off);
			$data['category'] = $this->get_category();
			$top_res = $this->posts_model->get_top_posts();
			$data['top_post'] = $this->get_posts($top_res);
			$data['posts'] = $this->get_posts($post);
			$data['ads'] = $this->ads_model->add_ads();
			$data['txt'] = $this->ads_model->get_footer_script();
			$data['main_content'] ='pages/post_by_category';
		    $this->load->view('template', $data);
		}
	}
	public function new_post(){
		$this->vue = array('vue/post_vue.js');
		$this->load->model('category_model');
		$data['category'] = $this->category_model->get_category();
		$uid = $this->session->userdata('uid');
		if(!empty($uid)){
			$data['main_content'] ='pages/new_post';
			$this->load->view('template', $data);
		}else{
			header('Location:'.base_url().'pages/error');
		}
		
	}

	public function verification(){
		$t_uid = $this->session->userdata('t_uid');
		$this->vue = array('vue/post_vue.js');
		$this->load->model('category_model');
		$single = $this->users_model->single_users($t_uid);
		$data['email'] = $single->email_address;
		$data['category'] = $this->category_model->get_category();
		$data['main_content'] ='pages/verification';
		$this->load->view('template', $data);
	}
	public function verified(){
		$this->vue = array('vue/post_vue.js');
		$this->load->model('category_model');
		$data['category'] = $this->category_model->get_category();
		$data['main_content'] ='pages/verified';
		$this->load->view('template', $data);
	}
	public function forgetPassword(){
		$data['main_content'] ='pages/forgetPassword';
		$this->load->view('template', $data);
	}
	public function reset_password(){
		$data['main_content'] ='pages/reset_password';
		$this->load->view('template', $data);
	}
	public function login(){
		$this->page = 'login';
		$data['main_content'] ='pages/login';
		$this->load->view('template', $data);
	}
	public function error(){
		$data['main_content'] ='pages/error';
		$this->load->view('template', $data);
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
			return $parr;
		}
	}
	public function get_posts($arr){
		$parr = array(); $carr = array();
		$this->load->model('posts_model');
		if(!empty($arr)){
			foreach($arr as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $this->removeTags($rr->desic);
				$carr['url'] = $rr->url;
				$carr['replay_count'] = $this->posts_model->get_replay_count($rr->id);
				$carr['count'] = $rr->count;
				$single = $this->users_model->single_users($rr->user_ref);
				$carr['user_ref'] = $rr->user_ref;
				$carr['user_url'] = $single->url;
				$carr['user_image'] = $this->users_model->profile_image_Check($single->image);
				$carr['created_on'] = $rr->created_on;
				array_push($parr, $carr);
			}
			return $parr;
		}
	}
	public function removeTags($text){
		$bt = str_replace("&nbsp;","",$text);
		return 	strip_tags($bt);
	}
	public function single_posts($id){
		$this->load->model('users_model');
		$arr = array();
		$obj = json_decode(file_get_contents('php://input', true));
		$res = $this->posts_model->single_posts($id);
		if(!empty($res)){
				$arr['id'] = $res->id;
				$arr['title'] = $res->title;
				$arr['desic'] = $res->desic;
				$arr['url'] = $res->url;
				$arr['user_ref'] = $res->user_ref;
				$arr['created_on'] = $res->created_on;
				$arr['count'] = $res->count;
				$single = $this->users_model->single_users($res->user_ref);
				$arr['name'] = $single->name;
				$arr['user_url'] = $single->url;
				$arr['user_image'] = $this->users_model->profile_image_Check($single->image);
				$arr['desig'] = $single->designation;
				$arr['replay_count'] = $this->posts_model->get_replay_count($res->id);
				return $arr;
		}
	}
	
}
