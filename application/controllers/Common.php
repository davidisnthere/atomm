<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

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
       	$this->load->model('common_model');         
    }

	public function index()
	{
		echo '';
	}

	public function get_common_count()
	{
		$arr = array();
		$arr['user_count'] =  $this->common_model->get_user_count();
		$arr['cat_count'] =  $this->common_model->get_cat_count();
		$arr['post_count'] =  $this->common_model->get_post_count();
		$arr['visit_count'] =  $this->common_model->get_visitor_count();
		$arr['replay_count'] =  $this->common_model->get_replay_count();
		echo json_encode($arr);
	}
	public function get_latest_post(){
		$parr = array(); $carr = array();
		$res = $this->common_model->get_latest_post();
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
	public function get_todays_visitor(){
		$dat = date('Y-m-d');
		echo $this->common_model->get_todays_visitor($dat);
	}
	public function get_last_week_post(){
		$lablearr = array(); $valarr = array();
		$this->load->model('common_model');
		$dat = date('Y-m-d');

		$fdat = date( "Y-m-d", strtotime( "$dat -6 day" ) );
		array_push($lablearr, $fdat);
		$val = $this->common_model->get_post_by_dat($fdat);
		array_push($valarr, $val);

		$fdat = date( "Y-m-d", strtotime( "$dat -5 day" ) );
		array_push($lablearr, $fdat);
		$val = $this->common_model->get_post_by_dat($fdat);
		array_push($valarr, $val);

		$fdat = date( "Y-m-d", strtotime( "$dat -4 day" ) );
		array_push($lablearr, $fdat);
		$val = $this->common_model->get_post_by_dat($fdat);
		array_push($valarr, $val);

		$fdat = date( "Y-m-d", strtotime( "$dat -3 day" ) );
		array_push($lablearr, $fdat);
		$val = $this->common_model->get_post_by_dat($fdat);
		array_push($valarr, $val);

		$fdat = date( "Y-m-d", strtotime( "$dat -2 day" ) );
		array_push($lablearr, $fdat);
		$val = $this->common_model->get_post_by_dat($fdat);
		array_push($valarr, $val);

		$fdat = date( "Y-m-d", strtotime( "$dat -1 day" ) );
		array_push($lablearr, $fdat);
		$val = $this->common_model->get_post_by_dat($fdat);
		array_push($valarr, $val);

		
	
		
		array_push($lablearr, $dat);
		$val = $this->common_model->get_post_by_dat($dat);
		array_push($valarr, $val);

		$new_arr = array('label' => $lablearr, 'val' => $valarr);
		echo json_encode($new_arr);
	}
	public function get_post_by_cat(){
		$labelarr = array(); $valarr = array();
		$this->load->model('category_model');
		$res = $this->category_model->get_category();
		if(!empty($res)){
			foreach($res as $rr){
				$label = $rr->name;
				$post = $this->category_model->total_post_by_cat($rr->id);
				array_push($labelarr, $label);
				array_push($valarr, $post);
			}
			$new_arr = array('label' => $labelarr, 'val' => $valarr);
			echo json_encode($new_arr);
		}
	}
	
}
