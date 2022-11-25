<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

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
		   $this->load->model('posts_model');
		   $this->load->model('category_model');
    }

	public function add_posts(){
		$arr = array();
		$uid = $this->session->userdata('uid');
		$this->load->helper('typography');
		$text = $this->input->post('desic');
		$arr['title'] = $this->input->post('title');
		$arr['desic'] =  $text;
		$arr['user_ref'] = $uid;
		$arr['cat_ref'] = $this->input->post('cat_ref');
		$id = $this->posts_model->add_posts($arr);
		$url = $this->create_url($id, $arr['title']);
		header('Location:'.base_url().'post/'.$url);
	}
	public function create_url($id, $name){
			$to_low = strtolower($name);
			$string = str_replace(' ','-',$to_low);
			$url = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			$res = $this->posts_model->url_check($url);
			if($res == 'YES'){
					$unic_string = date('y-m-d:H:m:s');
					$url = $url.'-'.$unic_string;
			}
			$this->posts_model->update_url($id, $url);
			return $url;
	}
	public function image_upload(){
		$config['upload_path'] = './upload/post';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file')){
				//	$error = array('error' => $this->upload->display_errors());
				//	print_r($error);
				echo 'error';
		}else{
			$data =  $this->upload->data();
		echo base_url().'upload/post/'.$data['file_name'];
		}
	}

	public function update_posts(){
		$arr = array();
		$this->load->helper('typography');
		$uid = $this->session->userdata('uid');
		$text = $this->input->post('desic');
		$arr['title'] = $this->input->post('title');
		$arr['desic'] =  $text;
		$arr['cat_ref'] = $this->input->post('cat_ref');
		$post_id = $this->input->post('pid');
		$single = $this->posts_model->single_posts($post_id);
		if($single->user_ref == $uid){
			$this->posts_model->update_posts($arr, $post_id);
			header('Location:'.base_url().'post/'.$single->url);
		}else{
			header('Location:'.base_url().'404');
		}
		
	}

	public function remove_posts(){
		$obj = json_decode(file_get_contents('php://input', true));
		$post_id = $obj->id;
		$this->posts_model->remove_posts($post_id);
	}

	public function restore_posts(){
		$obj = json_decode(file_get_contents('php://input', true));
		$post_id = $obj->id;
		$this->posts_model->restore_posts($post_id);
	}

	public function get_posts(){
		$parr = array(); 
		$this->load->model('posts_model');
		$this->load->model('users_model');
		$res = $this->posts_model->getPostAll();
		$co = 0;
		if(!empty($res)){
			foreach($res as $rr){
				$co++;
				$url = base_url().'post/'.$rr->url;
				$edit ="<button onclick='removeTable($rr->id)' class='btn btn-xs btn-danger'> <i class='fas fa-times'></i> </button>";
				$edit .="<a href='$url' target='_blank' class='btn btn-xs btn-primary'> <i class='fas fa-info'></i> </a>";
				$single = $this->users_model->single_users($rr->user_ref);
				$replay_count = $this->posts_model->get_replay_count($rr->id);
				$view_count = $rr->count;
				$carr = array($co, $rr->title, $single->name, $replay_count, $view_count, $edit);
				array_push($parr, $carr);
				
			}
			echo json_encode($parr);
		}
	}
	public function removeTags($text){
		$bt = str_replace("&nbsp;","",$text);
		return 	strip_tags($text);
	}
	public function get_posts_by_cat(){
		$parr = array(); $carr = array();
		$this->load->model('posts_model');
		$cat_id = 1;
		$res = $this->posts_model->get_posts_by_cat($cat_id);
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $rr->desic;
				$carr['image'] = $rr->image;
				$carr['user_ref'] = $rr->user_ref;
				$carr['created_on'] = $rr->created_on;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	public function single_posts(){
		$obj = json_decode(file_get_contents('php://input', true));
		$res = $this->posts_model->single_posts($obj->id);
		if(!empty($res)){
			echo json_encode($res);
		}
	}

	public function add_replay(){
		$obj = json_decode(file_get_contents('php://input', true));
		$uid = $this->session->userdata('uid');
		$arr = array();
		$arr['user_ref'] = $uid;
		$arr['post_ref'] = $obj->pid;
		$arr['replay'] = $obj->text;
		$this->posts_model->add_replay($arr);

		$this->load->model('notification_model');
		$this->load->model('posts_model');
		$this->load->model('users_model');
		$arr_n = array();
		$single_post =  $this->posts_model->single_posts($obj->pid);
		$single_user = $this->users_model->single_users($uid);
		$arr_n['icon'] = '<i class="fas fa-retweet"></i>';
		$arr_n['text'] = $single_user->name.' add reply to your post';
		$arr_n['user_ref'] =  $single_post->user_ref;
		$this->notification_model->add_notification($arr_n);
		$this->load->model('email_model');
		$message = $arr_n['text'];
		$reciver = $this->users_model->single_users($single_post->user_ref);
		$email = $reciver->email_address;
		$this->load->model('settings_model');
		$setting = $this->settings_model->get_settings();
		if($setting->replay == 1){
			$this->email_model->send_notification_email($message, $email, $reciver->name);
		}
		
	}

	public function update_replay(){
		$obj = json_decode(file_get_contents('php://input', true));
		$arr = array();
		$id = $obj->id;
		$arr['replay'] = $obj->text;
		$this->load->model('posts_model');
		$this->posts_model->update_replay($arr, $id);
	}

	public function remove_replay(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('posts_model');
		$id = $obj->id;
		$this->posts_model->remove_replay($id);
	}

	public function get_replay(){
		$obj = json_decode(file_get_contents('php://input', true));
		$parr = array(); $carr = array();
		$this->load->model('posts_model');
		$post_id = $obj->id;
		$res = $this->posts_model->get_replay($post_id);
		$user_id = $this->session->userdata('uid');
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['user_ref'] = $rr->user_ref;
				$carr['post_ref'] = $rr->post_ref;
				$carr['replay'] = $rr->replay;
				$carr['time'] = $rr->time;
				$this->load->model('users_model');
				$single = $this->users_model->single_users($rr->user_ref);
				if(!empty($single)){
					$carr['name'] = $single->name;
					$carr['lik_count'] = $this->posts_model->get_like_count($rr->id);
					$carr['is'] = $this->posts_model->is_user_like($user_id, $rr->id);
					if($rr->user_ref == $user_id){
						$carr['edit'] = 1;
					}else{
						$carr['edit'] = 0;
					}
					
					array_push($parr, $carr);
				}
				
			}
			echo json_encode($parr);
		}
	}
	public function add_replay_like(){
		$obj = json_decode(file_get_contents('php://input', true));
		$uid = $this->session->userdata('uid');
		$user_id = $uid; $replay_id = $obj->rid; $post_id = $obj->pid;
		$this->posts_model->add_replay_like($user_id, $replay_id, $post_id);

		$this->load->model('notification_model');
		$this->load->model('posts_model');
		$this->load->model('users_model');
		$arr_n = array();
		$single_reply =  $this->posts_model->single_replay($obj->rid);
		$replay_user = $this->users_model->single_users($single_reply->user_ref);
		$like_user = $this->users_model->single_users($uid);

		$arr_n['icon'] = '<i class="far fa-heart"></i>';
		$arr_n['text'] = $like_user->name.' like your replay';
		$arr_n['user_ref'] =  $replay_user->id;
		$this->notification_model->add_notification($arr_n);
		$this->load->model('email_model');
		$message = $arr_n['text'];
		$email = $replay_user->email_address;
		$this->load->model('settings_model');
		$setting = $this->settings_model->get_settings();
		if($setting->like == 1){
			$this->email_model->send_notification_email($message, $email, $replay_user->name);
		}
	}
	public function remove_replay_like(){
		$obj = json_decode(file_get_contents('php://input', true));
		$uid = $this->session->userdata('uid');
		$user_id = $uid; $replay_id = $obj->rid; $post_id = $obj->pid;
		$this->posts_model->remove_replay_like($user_id, $replay_id, $post_id);
	}
	public function is_user_like(){
		$user_id = 2; $replay_id = 1;
		$res = $this->posts_model->is_user_like($user_id, $replay_id);
	}
	public function get_replay_count(){
		$post_id = 5;
		$res = $this->posts_model->get_replay_count($post_id);
		echo $res;
	}
	public function get_like_count($replay_id){
		$res = $this->posts_model->get_like_count($replay_id);
		echo $res;
	}
	public function get_related_post(){
		$parr = array(); $carr = array();
		$cat_id = 1; $post_id = 4;
		$res = $this->posts_model->get_related_post($cat_id, $post_id);
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $rr->desic;
				$carr['image'] = $rr->image;
				$carr['user_ref'] = $rr->user_ref;
				$carr['created_on'] = $rr->created_on;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}
	public function get_my_like(){
		$parr = array(); $carr = array();
		$this->load->model('posts_model');
		$res = $this->posts_model->get_top_posts();
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $this->removeTags($rr->desic);
				$carr['image'] = $rr->image;
				$carr['url'] = $rr->url;
				$carr['replay_count'] = $this->posts_model->get_replay_count($rr->id);
				$carr['count'] = $rr->count;
				$carr['user_ref'] = $rr->user_ref;
				$carr['created_on'] = $rr->created_on;
				array_push($parr, $carr);
			}
			return $parr;
		}
	}
	public function search_post(){
		$parr = array(); $carr = array();
		$obj = json_decode(file_get_contents('php://input', true));
		$res = $this->posts_model->search_post($obj->sk);
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $this->removeTags($rr->desic);
				$carr['url'] = base_url().'post/'.$rr->url;
				$carr['user_ref'] = $rr->user_ref;
				$carr['created_on'] = $rr->created_on;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}
	public function get_top_posts(){
		$parr = array(); $carr = array();
		$this->load->model('posts_model');
		$res = $this->posts_model->get_top_posts();
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $rr->desic;
				$carr['image'] = $rr->image;
				$carr['user_ref'] = $rr->user_ref;
				$carr['created_on'] = $rr->created_on;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}
	public function get_trash_posts(){
		$parr = array(); 
		$this->load->model('posts_model');
		$this->load->model('users_model');
		$res = $this->posts_model->get_trash_posts();
		$co = 0;
		if(!empty($res)){
			foreach($res as $rr){
				$co++;
				$url = base_url().'post/'.$rr->url;
				$edit ="<button onclick='restorePost($rr->id)' class='btn btn-xs btn-danger'> <i class='fas fa-sync-alt'></i> </button>";
				$edit .="<a target='_blank' href='$url' class='btn btn-xs btn-primary'> <i class='fas fa-info'></i> </a>";
				$single = $this->users_model->single_users($rr->user_ref);
				$replay_count = $this->posts_model->get_replay_count($rr->id);
				$view_count = $rr->count;
				$carr = array($co, $rr->title, $single->name, $replay_count, $view_count, $edit);
				array_push($parr, $carr);
				
			}
			echo json_encode($parr);
		}
	}
}
