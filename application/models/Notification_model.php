<?php
class Notification_model extends CI_Model{
    

	public function add_notification($arr){
		$this->db->insert('notification', $arr);
		$this->db->insert_id();
	}

	

	public function remove_notification($id){
		$this->db->where('id', $id);
		$this->db->update('notification', array('active'=>'NO'));
	}

	public function get_notification($uid){
		$this->db->where('active', 'YES');
		$this->db->where('user_ref', $uid);
		$res = $this->db->get('notification');
		if($r = $res->result()){
			return $r;
		}
	}

	public function add_admin_notification($arr){
		$this->db->insert('admin_notification', $arr);
		$this->db->insert_id();
	}

	public function remove_admin_notification($id){
		$this->db->where('id', $id);
		$this->db->delete('admin_notification');
	}

	public function get_admin_notification(){
		$this->db->where('active', 'YES');
		$res = $this->db->get('admin_notification');
		if($r = $res->result()){
			return $r;
		}
	}
	public function clear_all_notiy($uid){
		$this->db->where('user_ref', $uid);
		$this->db->delete('notification');
	}
 	
}
?>