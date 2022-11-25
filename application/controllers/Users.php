<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		  $this->load->model('users_model');
		  $this->load->model('admin_model');
		  $uid = $this->session->userdata('uid');
		  if(!empty($uid)){
			  $this->single = $this->users_model->single_users($uid);
			  $this->single->image = $this->users_model->profile_image_Check($this->single->image);
			  
		  }
		$this->page_detail = $this->admin_model->single_admin();
		$this->title = $this->page_detail['app_title'];
  }

	public function dashboard(){
		$this->vue = array('vue/user_vue.js');
		$data['main_content'] ='users/dashboard';
		$this->load->view('template_user', $data);
	}
	public function my_post(){
		$this->vue = array('vue/user_vue.js');
		$data['main_content'] ='users/my_post';
		$this->load->view('template_user', $data);
	}
	public function my_replay(){
		$this->vue = array('vue/user_vue.js');
		$data['main_content'] ='users/my_replay';
		$this->load->view('template_user', $data);
	}
	public function settings(){
		$this->vue = array('vue/user_vue.js');
		$data['main_content'] ='users/settings';
		$this->load->view('template_user', $data);
	}
	public function edit_post($id){
		$this->vue = array('vue/post_vue.js');
		$this->load->model('category_model');
		$this->load->model('posts_model');
		$data['category'] = $this->category_model->get_category();
		$data['single'] = $this->posts_model->single_posts($id);
		$uid = $this->session->userdata('uid');
		$data['main_content'] ='pages/edit_post';
		$this->load->view('template', $data);	
	}

	public function index(){
		//$this->session->set_userdata('uid', 1);
	}

	public function add_users(){
		$arr = array();
		$this->load->library('encryption');
		$arr['name'] = $this->input->post('name');
		$arr['designation'] = $this->input->post('designation');
		$arr['email_address'] = $this->input->post('email_address');
		$password = $this->input->post('password');
		$arr['password'] = $this->encryption->encrypt($password);
		$this->load->model('users_model');
		$id = $this->users_model->add_users($arr);
		$this->session->set_userdata('t_uid', $id);
		$this->create_url($id, $arr['name']);
		$vcode = $this->create_verrify_link($id);
		$this->load->model('email_model');
		$this->email_model->send_welcome_mail($arr['email_address'], $vcode);
		echo '<script>window.location.href="'.base_url().'pages/verification"</script>';
	}
	public function create_url($id, $name){
		$to_low = strtolower($name);
		$string = str_replace(' ','-',$to_low);
		$url = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		$res = $this->users_model->url_check($url);
		if($res == 'YES'){
				$unic_string = date('y-m-d:H:m:s');
				$url = $url.'-'.$unic_string;
		}
		$this->users_model->update_url($id, $url);
	}

	public function update_users(){
		$obj = json_decode(file_get_contents('php://input', true));
		$arr = array();
		$arr['name'] = $obj->name;
		$arr['mobile_number'] = $obj->mobile;
		$arr['designation'] = $obj->desig;
		$arr['address'] = $obj->address;
		$id = $this->session->userdata('uid');
		$this->load->model('users_model');
		$this->users_model->update_users($arr, $id);
	}

	public function remove_users(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('users_model');
		$user_id = $obj->id;
		$this->users_model->remove_users($user_id);
	}

	public function restore_users(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('users_model');
		$user_id = $obj->id;
		$this->users_model->restore_users($user_id);
	}

	public function delete_users(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('users_model');
		$user_id = $obj->id;
		$this->users_model->delete_users($user_id);
	}

	public function get_users(){
		$parr = array(); $carr = array();
		$this->load->model('users_model');
		$res = $this->users_model->get_users();
		$co = 0;
		if(!empty($res)){
			foreach($res as $rr){
				$co++;
				$url = base_url().'user/'.$rr->url;
				$edit ="<button onclick='removeUser($rr->id)' class='btn btn-xs btn-danger'> <i class='fas fa-times'></i> </button>";
				$edit .="<a target='_blank' href='$url' class='btn btn-xs btn-primary'> <i class='fas fa-info'></i> </a>";
				$post = $this->users_model->my_post_count($rr->id);
				$replay = $this->users_model->my_replay_count($rr->id);
				$carr = array($co, $rr->name, $rr->designation, $rr->email_address, $post, $replay, $edit);
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	public function user_count(){
			$arr = array();
			$uid = $this->session->userdata('uid');
			$arr['tot_post'] = $this->users_model->my_post_count($uid);
			$arr['tot_replay'] = $this->users_model->my_replay_count($uid);
			$arr['tot_like'] = $this->users_model->my_like_count($uid);
			echo json_encode($arr);
	}

	public function single_users(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('users_model');
		//$user_id = $obj->id;
		$user_id = 3;
		$res = $this->users_model->single_users($user_id);
		if(!empty($res)){
			echo json_encode($res);
		}
	}

	public function single_user_login(){
		$this->load->model('users_model');
		$user_id = $this->session->userdata('uid');
		$res = $this->users_model->single_users($user_id);
		if(!empty($res)){
			echo json_encode($res);
		}
	}

	public function login_check(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->library('encryption');
		$email = $obj->name;
		$password = $obj->pswd;
		$this->load->model('users_model');
		$this->load->model('settings_model');
		$setting = $this->settings_model->get_settings();
		$res = $this->users_model->login_check($email, $setting->activation);
		if($res == 'err'){
			echo 'error';
		}else{
			 $decode = $this->encryption->decrypt($res->password);
			if($decode == $password){
				$this->session->set_userdata('uid', $res->id);
				echo 'success';
			}else{
				echo 'error';
			}
		}

	}

	public function change_password(){
		$this->load->model('users_model');
		$this->load->library('encryption');
		$obj = json_decode(file_get_contents('php://input', true));
		$user_id = $this->session->userdata('uid');
		$res = $this->users_model->single_users($user_id);
		$new_password = $obj->pswd;
		$old_password = $obj->old;
		$decrypt = $this->encryption->decrypt($res->password);
		if($decrypt == $old_password){
			$new_ency = $this->encryption->encrypt($new_password);
			$this->users_model->update_users(array('password' => $new_ency,'verify' => 1), $user_id);
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function change_password_reset(){
		$this->load->model('users_model');
		$this->load->library('encryption');
		$obj = json_decode(file_get_contents('php://input', true));
		$user_id = $this->session->userdata('reset_id');
		$res = $this->users_model->single_users($user_id);
		$new_password = $obj->pswd;
		$new_ency = $this->encryption->encrypt($new_password);
		$this->users_model->update_users(array('password' => $new_ency), $user_id);
		$this->session->set_userdata('uid', $user_id);
		echo 'success';
	}

	public function create_verrify_link($id){
		$v_code = $this->generateRandomString(15);
		$nvc = $v_code.'0'.$id;
		$this->users_model->create_verrify_link($nvc, $id);
		return $nvc;
	}

	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;

	}

	public function verify_account($vcode = 'xxx'){
		$res = $this->users_model->verify_account($vcode);
		if($res != 'error'){
			$this->users_model->update_users(array('verify' => 1), $res->user_ref);
			$this->users_model->delete_verification_link($res->id);
			$this->session->set_userdata('uid', $res->user_ref);
			header('Location:'.base_url().'pages/verified');
		}else{
			header('Location:'.base_url().'404');
		}
	}

	public function reset_password_link(){
		$this->load->model('email_model');
		$obj = json_decode(file_get_contents('php://input', true));
		$res = $this->users_model->login_check($obj->email, 0);
		if($res == 'err'){
			echo 'err';
		}else{
			$uid = $res->id;
			$v_code = $this->generateRandomString(15);
			$nvc = $v_code.'x'.$uid;
			$this->users_model->create_reset_link($nvc, $uid);
			$this->email_model->send_reset_link($res->email_address, $nvc, $res->name);
			echo 'success';
		}
	}

	public function validat_reset_link($vcode){
		$res = $this->users_model->validat_reset_link($vcode);
		if($res != 'error'){
			$this->users_model->delete_reset_link($res->id);
			$this->session->set_userdata('reset_id', $res->user_ref);
			header('Location:'.base_url().'pages/reset_password');
		}else{
			header('Location:'.base_url().'404');
		}
	}

	public function get_trash_users(){
		$parr = array(); $carr = array();
		$res = $this->users_model->get_trash_users();
		$co = 0;
		if(!empty($res)){
			foreach($res as $rr){
				$co++;
				$url = base_url().'user/'.$rr->url;
				$edit ="<button onclick='restoreUser($rr->id)' class='btn btn-xs btn-danger'> <i class='fas fa-sync-alt'></i> Restore </button>";
				$edit .="<a target='_blank' href='$url' class='btn btn-xs btn-primary'> <i class='fas fa-info'></i> </a>";
				$post = $this->users_model->my_post_count($rr->id);
				$replay = $this->users_model->my_replay_count($rr->id);
				$carr = array($co, $rr->name, $rr->designation, $rr->email_address, $post, $replay, $edit);
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	public function get_my_post(){
		$this->load->model('posts_model');
		$obj = json_decode(file_get_contents('php://input', true));
		$parr = array(); $carr = array();
		$uid = $this->session->userdata('uid');
		$res = $this->users_model->get_my_post($uid, $obj->limit);
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['title'] = $rr->title;
				$carr['desic'] = $this->removeTags($rr->desic);
				$carr['image'] = $rr->image;
				$carr['user_ref'] = $rr->user_ref;
				$carr['created_on'] = $rr->created_on;
				$carr['url'] = base_url().'post/edit/'.$rr->id;
				$carr['co'] = $this->posts_model->get_replay_count($rr->id);
				$carr['count'] = $rr->count;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	public function get_my_replay(){
		$obj = json_decode(file_get_contents('php://input', true));
		$this->load->model('posts_model');
		$parr = array(); $carr = array();
		$uid = $this->session->userdata('uid');
		$res = $this->users_model->get_my_replay($uid, $obj->limit);
		if(!empty($res)){
			foreach($res as $rr){
				$single = $this->posts_model->single_posts($rr->post_ref);
				$carr['id'] = $rr->id;
				$carr['title'] = $single->title;
				$carr['desic'] = $this->removeTags($single->desic);
				$carr['image'] = $single->image;
				$carr['user_ref'] = $single->user_ref;
				$carr['created_on'] = $single->created_on;
				$carr['replay'] = $this->removeTags($rr->replay);
				$carr['like'] = $this->posts_model->get_like_count($rr->id);
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}
	public function removeTags($text){
		$bt = str_replace("&nbsp;","",$text);
		return 	strip_tags($bt);
	}
	public function get_my_log(){
		$parr = array(); $carr = array();
		$uid = $this->session->userdata('uid');
		$res = $this->users_model->get_my_log($uid);
		if(!empty($res)){
			foreach($res as $rr){
				$carr['id'] = $rr->id;
				$carr['country'] = $rr->country;
				$carr['date'] = $rr->date;
				$carr['device'] = $rr->device;
				$carr['city'] = $rr->city;
				$carr['tim'] = $rr->tim;
				$carr['visitor'] = $rr->visitor;
				$carr['count'] = $rr->count;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}

	public function get_my_like(){
		$this->load->model('posts_model');
		$parr = array(); $carr = array();
		$uid = $this->session->userdata('uid');
		$res = $this->users_model->get_my_like($uid);
		if(!empty($res)){
			foreach($res as $rr){
				$single = $this->posts_model->single_posts($rr->post_ref);
				$carr['id'] = $rr->id;
				$carr['title'] = $single->title;
				$carr['desic'] = $single->desic;
				$carr['image'] = $single->image;
				$carr['user_ref'] = $single->user_ref;
				$carr['created_on'] = $single->created_on;
				array_push($parr, $carr);
			}
			echo json_encode($parr);
		}
	}
	public function log_out(){
		$this->session->sess_destroy();
        header('Location:'.base_url());
	}
	public function profileupload(){
        $config['upload_path'] = './upload/user';
		$config['allowed_types'] = 'gif|jpg|png';
		$sid = $this->input->post('studentid');
		if(!empty($sid)){
			$this->session->set_userdata('addsid', $sid);
		}
		

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			//print_r($error);
			echo'0';
			
		}
		else
		{
			$data =  $this->upload->data();
			if($data['file_size'] > 500){
				$save = $data['file_name']; 
				$src = 'upload/user/'.$data['file_name'];
				$config = array(
					'source_image' => 'upload/user/'.$save,
					'new_image' => './upload/user/',
					'maintain_ration'=> true,
					'width'=>500,
					'height'=>600,
				);
				$this->load->library('image_lib',$config);
				$this->image_lib->resize();
			}else{
				$src = 'upload/user/'.$data['file_name'];
			}
			
			$this->session->set_userdata('croptype', $data['image_type']);
			$this->session->set_userdata('cropimg', $data['file_name']);
			$this->session->set_userdata('cropwidth', $data['image_width']);
			$this->session->set_userdata('cropheight', $data['image_height']);
			echo base_url().$src;
		}
    }
	public function cropeimage(){
        $type = $this->session->userdata('croptype'); 
		$id = $this->session->userdata('uid');
		$image = $this->session->userdata('cropimg'); 
		$newimg = $id.$image;
		$src = 'upload/user/'.$image;
		$save = 'upload/users/'.$newimg;
		 $x = $this->input->post('x');
		 $y = $this->input->post('y');
		 $w = $this->input->post('w');
		 $h = $this->input->post('h');
		$targ_w =200; $targ_h = 200;
		$jpeg_quality = 90;
		if($type=="jpeg"){
			
			$img_r = imagecreatefromjpeg($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );

			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
			$targ_w,$targ_h,$w,$h);

			imagejpeg($dst_r, $save);
			$this->users_model->updateImage($id, $newimg);
			@unlink($src);
			echo base_url().$save;
		}else if($type=="png"){
			
			$img_r = imagecreatefrompng($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );

			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
			$targ_w,$targ_h,$w,$h);

			imagepng($dst_r, $save);
			$this->users_model->updateImage($id, $newimg);
			@unlink($src);
			echo base_url().$save;
		}else if($type=="gif"){
			
			$img_r = imagecreatefromgif($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );

			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
			$targ_w,$targ_h,$w,$h);

			imagegif($dst_r, $save);
			$this->users_model->updateImage($id, $newimg);
			@unlink($src);
			echo base_url().$save;
		}
    }
    public function is_exist(){
    	$obj = json_decode(file_get_contents('php://input', true));
    	echo $this->users_model->is_exist($obj->suemail);
    }

}
