<?php
class Users_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}


	public function add_users($arr){
		$this->db->insert('users', $arr);
		return $this->db->insert_id();
	}

	public function update_users($arr, $id){
		$this->db->where('id', $id);
		$this->db->update('users', $arr);
	}
	public function update_url($id, $url){
		$this->db->where('id', $id);
		$this->db->update('users', array('url'=>$url));
	}
	public function updateImage($id, $imag){
		$this->db->where('id', $id);
		$this->db->update('users', array('image'=> $imag));
	}

	public function remove_users($id){
		$this->db->where('id', $id);
		$this->db->update('users', array('active'=>'NO'));
	}
	public function restore_users($id){
		$this->db->where('id', $id);
		$this->db->update('users', array('active'=>'YES'));
	}
	public function get_users(){
		$this->db->where('active', 'YES');
		$res = $this->db->get('users');
		if($r = $res->result()){
			return $r;
		}
	}

	public function single_users($id){
		$this->db->where('id', $id);
		$res = $this->db->get('users');
		if($r = $res->result()){
			foreach($r as $rr){
				return $rr;
			}
		}
	}
	public function profile_image_Check($logo){
        if(!empty($logo)){
            if(file_exists('upload/users/'.$logo)){
                    return  $logo;
            }else{ return  'dummy.jpg'; }
        }else{ return "dummy.jpg"; }
	}
	
	public function delete_users($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
	public function login_check($email, $activaton){
		$this->db->where('active', 'YES');
		if($activaton == 1){
			$res = $this->db->get_where('users', array('email_address' => $email,'verify'=>1));
		}else{
			$res = $this->db->get_where('users', array('email_address' => $email));
		}
		
		if($r = $res->result()){
			foreach($r as $rr){
				return $rr;
			}
		}else{
			return 'err';
		}
	}
	public function create_verrify_link($vcode, $id){
		$arr = array('v_code' => $vcode,'user_ref' => $id);
		$this->db->insert('verification_link', $arr);
	}
	public function verify_account($vcode){
		$res = $this->db->get_where('verification_link', array('v_code' => $vcode));
		if($r = $res->result()){
			foreach($r as $rr){
				return $rr;
			}
		}else{
			return 'error';
		}
	}
	public function delete_verification_link($id){
		$this->db->where('id', $id);
		$this->db->delete('verification_link');
	}
	public function create_reset_link($vcode, $id){
		$arr = array('v_code' => $vcode,'user_ref' => $id);
		$this->db->insert('reset_link', $arr);
	}
	public function validat_reset_link($vcode){
		$res = $this->db->get_where('reset_link', array('v_code' => $vcode));
		if($r = $res->result()){
			foreach($r as $rr){
				return $rr;
			}
		}else{
			return 'error';
		}
	}
	public function delete_reset_link($id){
		$this->db->where('id', $id);
		$this->db->delete('reset_link');
	}
	public function get_trash_users(){
		$this->db->where('active', 'NO');
		$res = $this->db->get('users');
		if($r = $res->result()){
			return $r;
		}
	}
	public function get_my_post($uid, $limit){
    $this->db->limit($limit);
    $this->db->order_by('id', 'desc');
		$res = $this->db->get_where('posts', array('user_ref' => $uid,'active'=>'YES'));
		if($r = $res->result()){
			return $r;
		}
	}
	public function get_my_replay($uid, $limit){
		$this->db->limit($limit);
		$this->db->order_by('id', 'desc');
		$res = $this->db->get_where('replay', array('user_ref' => $uid));
		if($r = $res->result()){
			return $r;
		}
	}
	public function get_my_log($uid){
		$res = $this->db->get_where('visitors', array('visitor' => $uid));
		if($r = $res->result()){
			return $r;
		}
	}
	public function get_my_like($uid){
		$res = $this->db->get_where('replay_like', array('user_ref' => $uid));
		if($r = $res->result()){
			return $r;
		}
	}
  public function my_post_count($id){
    $res = $this->db->get_where('posts', array('user_ref'=>$id, 'active'=>'YES'))->num_rows();
    return $res;
  }
  public function my_replay_count($id){
    $res = $this->db->get_where('replay', array('user_ref'=>$id))->num_rows();
    return $res;
  }
  public function my_like_count($id){
    $res = $this->db->get_where('replay_like', array('user_ref'=>$id))->num_rows();
    return $res;
  }
  public function get_id_by_url($url){
	$arr = array();
	$res = $this->db->get_where('users', array('url' => $url));
	if($r = $res->result()){
		foreach($r as $rr){
			$arr['id'] = $rr->id;
			$arr['name'] = $rr->name;
			$arr['email_address'] = $rr->email_address;
			$arr['designation'] = $rr->designation;
			$arr['image'] = $this->profile_image_Check($rr->image);
		}
	}	
	return $arr;	
  }
  public function url_check($url){
    $res = $this->db->get_where('users', array('url' => $url));
    if($r = $res->result()){
        return 'YES';
    }
  }
  	public function is_exist($email){
  		$res = $this->db->get_where('users', array('email_address' => $email,'verify'=>1));
  		if($r = $res->result()){
  			return 'yes';
  		}else{
  			return 'no';
  		}
  	}
}
?>
