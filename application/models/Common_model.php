<?php
class Common_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}
 	

	public function get_user_count(){
		$res = $this->db->get('users')->num_rows();
		return $res;
	}
	public function get_cat_count(){
		$res = $this->db->get('category')->num_rows();
		return $res;
	}
	public function get_post_count(){
		$this->db->where('active', 'YES');
		$res = $this->db->get('posts')->num_rows();
		return $res;
	}
	public function get_post_bu_cat_count($cid){
		$this->db->where('cat_ref', $cid);
		$this->db->where('active', 'YES');
		$res = $this->db->get('posts')->num_rows();
		return $res;
	}
	public function get_latest_post(){
		$this->db->where('active', 'YES');
		$this->db->limit(5);
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}
	public function get_todays_visitor($date){
		$this->db->where('date', $date);
		$res = $this->db->get('visitors')->num_rows();
		return $res;
	}
	public function get_replay_count(){
		$this->db->where('active', 'YES');
		$res = $this->db->get('replay')->num_rows();
		return $res;
	}
	public function get_visitor_count(){
		
	}
	public function get_post_by_dat($dat){
		$stdat = $dat.' 00:00:00';
		$endat = $dat.' 23:59:59';
		$this->db->where('created_on >=', $stdat);
		$this->db->where('created_on <=', $endat);
		return $this->db->get('posts')->num_rows();
	}
}
?>