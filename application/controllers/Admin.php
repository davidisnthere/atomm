<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('admin_model');
        $this->page_detail = $this->admin_model->single_admin();
    }
    
	public function index()
	{
        
		$this->vue = array('vue/home_vue.js');
        $data['main_content'] = 'admin/home/index';
        $this->load->view('admin/template', $data);
	}
	public function category(){
		$this->vue = array('vue/category_vue.js');
		$data['main_content'] = 'admin/category/index';
		$this->load->view('admin/template', $data);
	}
	public function view_posts(){
		$this->vue = array('vue/post_vue.js');
		$data['main_content'] = 'admin/posts/index';
		$this->load->view('admin/template', $data);
	}
	public function view_users(){
        $this->vue = array('vue/user_vue.js');
		$data['main_content'] = 'admin/users/index';
		$this->load->view('admin/template', $data);
	}
	public function visitors(){
		$this->ctrl = array('ctrla/homeCtrl.js');
		$data['main_content'] = 'admin/visitors/index';
		$this->load->view('admin/template', $data);
	}
	public function visitors_by_country(){
		$this->ctrl = array('ctrla/homeCtrl.js');
		$data['main_content'] = 'admin/visitors/visitors_by_country';
		$this->load->view('admin/template', $data);
	}
	public function visitors_by_device(){
		$this->ctrl = array('ctrla/homeCtrl.js');
		$data['main_content'] = 'admin/visitors/visitors_by_device';
		$this->load->view('admin/template', $data);
	}
	public function trash_users(){
        $this->vue = array('vue/trashuser_vue.js');
		$data['main_content'] = 'admin/trash/trash_users';
		$this->load->view('admin/template', $data);
	}
	public function trash_posts(){
        $this->vue = array('vue/trashpost_vue.js');
		$data['main_content'] = 'admin/trash/trash_posts';
		$this->load->view('admin/template', $data);
	}
	public function user_settings(){
		$this->vue = array('vue/settings_vue.js');
		$data['main_content'] = 'admin/settings/index';
		$this->load->view('admin/template', $data);
	}
	public function password_setings(){
		$this->vue = array('vue/settings_vue.js');
		$data['main_content'] = 'admin/settings/password_setings';
		$this->load->view('admin/template', $data);
    }
    public function app_setings(){
        $this->load->model('settings_model');
        $this->vue = array('vue/settings_vue.js');
        $data['setting'] = $this->settings_model->get_settings();
        $data['main_content'] = 'admin/settings/app_setings';
        $this->load->view('admin/template', $data);
    }


    public function reset_password($err = 0){
        $this->err = $err;
        $this->load->view('admin/reset_password');    
    }
    public function login($err = 0)
    {
        $this->err = $err;
        $this->load->view('admin/login');
    }
	public function log_out(){
        $this->session->sess_destroy();
        header('Location:'.base_url().'admin');
    }
    public function validat_reset_link($vcode = 'xxxxxx'){
       $res = $this->admin_model->validat_reset_link($vcode);
       if($res == 'success'){
            $this->session->set_userdata('auth', 5);
            $this->load->view('admin/new_password');
       }else{
           header('Location:'.base_url().'404');
       }
    }
    public function reset_request(){
        $name = $this->input->post('name');
        $rr = $this->admin_model->logiCheck($name);
        if($rr == 'err'){
            header('Location:'.base_url().'admin/reset_password/err');
        }else{
            $vcode = $this->generateRandomString(15);
            $this->admin_model->create_reset_link($vcode);
            $this->load->model('email_model');
            $this->email_model->admin_reset_email($vcode, $rr->name);
        }
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
	public function logincheck(){
		$this->load->model('admin_model');
		$name = $this->input->post('name');
		$pswd = $this->input->post('pswd');
		$this->load->library('encryption');
		$rr = $this->admin_model->logiCheck($name);
        if($rr == 'err'){
            header('location:'.base_url().'admin/login/err');
        }else{
            $dec = $this->encryption->decrypt($rr->pswd);
            if($pswd == $dec){
                $this->session->set_userdata('admin', $rr->id);
                header('location:'.base_url().'admin');
            }else{
               header('location:'.base_url().'admin/login/err');
            }
        }
	}
	public function changePassword(){
        $arr = array();
        $obj = json_decode(file_get_contents('php://input', true));
        $old_pswd = $obj->old;
        $new_pswd = $obj->pswd;
        $this->load->model('admin_model');
        $this->load->library('encryption');
        $res = $this->admin_model->admin_pswd();
        $dec = $this->encryption->decrypt($res->pswd);
        if($old_pswd == $dec){
            $arr['pswd'] = $this->encryption->encrypt($new_pswd);
            $this->admin_model->updatePassword($arr);
            echo 'ok';
        }else{
            echo 'err';
        }

  }
  public function change_password_val(){
        $new_pswd = $this->input->post('pswd');
        $this->load->model('admin_model');
        $this->load->library('encryption');
        $arr['pswd'] = $this->encryption->encrypt($new_pswd);
        $auth = $this->session->userdata('auth');
        if($auth == 5){
            $this->admin_model->updatePassword($arr);
            header('Location:'.base_url().'admin/login');
        }else{
            header('Location:'.base_url().'404');
        }          
  }
  public function getPassword(){
        $arr = array();
        $this->load->library('encryption');
        $this->load->model('admin_model');
        $admin_id = $this->session->userdata('admin');
        $res = $this->admin_model->single_admin($admin_id);
        if(!empty($res)){
            $arr['id'] = $res->id;
            $arr['username'] = $res->username;
            if(!empty($res->pswd)){
                $dec = $this->encryption->decrypt($res->pswd);
                $arr['pswd'] = $dec;
            }else{
                $arr['pswd'] = '';
            }
            echo json_encode($arr);
        }
  }
  public function getSingle(){
        $arr = array();
        $this->load->model('admin_model');
        $uid = $this->session->userdata('uid');
        $res = $this->admin_model->single_users($uid);
        if(!empty($res)){
            $arr['id'] = $res->id;
            $arr['name'] = $res->name;
            $arr['mobile'] = $res->mobile;
            $arr['email'] = $res->email;
            $arr['role'] = $res->role;
            $arr['address'] = $res->address;
            echo json_encode($arr);
        }
  }
  public function updatedetails(){
        $config['upload_path'] = './upload/admin';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        $admin = $this->session->userdata('admin');
        $arr = array();
        if ( ! $this->upload->do_upload('app-logo'))
        {
   
         }else{
            $data =  $this->upload->data();
            $image = $data['file_name'];
            $arr['app_logo'] = $image;
        }
        if ( ! $this->upload->do_upload('fav-icon'))
        {
   
         }else{
            $data =  $this->upload->data();
            $image = $data['file_name'];
            $arr['fav_icon'] = $image;
        }
        $arr['name'] = $this->input->post('app-name');
        $arr['app_title'] = $this->input->post('app-title');
        $arr['email'] = $this->input->post('email-address');
        $arr['mobile_no'] = $this->input->post('mobile-no');
        $this->load->model('admin_model');
        $this->admin_model->update_admin($arr, $admin);
        header('location:'.base_url().'admin/user_settings');
    }
}
