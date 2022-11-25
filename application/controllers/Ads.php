<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {

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
           
    }

	public function new_ad(){
        $status = $this->input->post('status');
        $type = $this->input->post('type');
        $pos = $this->input->post('pos');
        $arr = array();
        $arr['status'] = $status;
        $arr['type'] = $type;
        if($type == 'image'){
            $config['upload_path'] = './upload/ad';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload()){
                    	//$error = array('error' => $this->upload->display_errors());
                    	//print_r($error);
                    //echo 'error';
                 $arr['link'] = $this->input->post('link');
            }else{
                $data =  $this->upload->data();
                $arr['image'] = $data['file_name'];
                $arr['link'] = $this->input->post('link');
            }
        }
        else if($type == 'script'){
            $arr['script'] = $this->input->post('script');
        }
       $this->load->model('ads_model');
       $this->ads_model->new_ad($arr, $pos);
       header('Location:'.base_url().'admin/new_ad');
    }
    public function header_script(){
         
        $arr = array();
        $arr['txt'] = $this->input->post('txt');
        $this->load->model('ads_model');
        $this->ads_model->add_header_script($arr);
        header('Location:'.base_url().'admin/new_ad');
    }
}
