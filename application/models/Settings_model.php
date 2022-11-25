<?php
class Settings_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}
 	
	public function update_setting($arr){
		$this->db->update('settings', $arr);
	}
	public function get_settings(){
		$res = $this->db->get('settings');
		if($r = $res->result()){
			foreach($r as $rr){
				return $rr;
			}
		}
	}
	
}
?>