<?php
class Admin_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}
 	public function add_admin($arr){
        $this->db->insert('admin', $arr);
        $this->db->insert_id();
    }

    public function update_admin($arr, $id){
        $this->db->where('id', $id);
        $this->db->update('admin', $arr);
    }

    public function remove_admin($id){
        $this->db->where('id', $id);
        $this->db->update('admin', array('active'=>'NO'));
    }

    public function get_admin(){
        $res = $this->db->get_where('admin', array('active'=>'YES'));
        if($r = $res->result()){
            return $r;
        }
    } 
    public function single_admin(){
      
        $res = $this->db->get('admin');
        $arr = array();
        if($r = $res->result()){
            foreach($r as $rr){
               $arr['name'] = $rr->name;
               $arr['app_title'] = $rr->app_title;
               $arr['email'] = $rr->email;
               $arr['mobile_no'] = $rr->mobile_no;
               $arr['app_logo'] = $this->logoCheck($rr->app_logo);
               $arr['fav_icon'] = $this->favCheck($rr->fav_icon);
               return $arr;
            }
        }
    }
    public function admin_pswd(){
        $res = $this->db->get('admin');
        $arr = array();
        if($r = $res->result()){
            foreach($r as $rr){
              return $rr;
            }
        }
    }
    public function logoCheck($logo){
        if(!empty($logo)){
            if(file_exists('uploads/admin/'.$logo)){
                    return  $logo;
            }else{ return  'logo.png'; }
        }else{ return "logo.png"; }
    }
    public function favCheck($logo){
        if(!empty($logo)){
            if(file_exists('uploads/admin/'.$logo)){
                    return  $logo;
            }else{ return  'fav.png'; }
        }else{ return "fav.png"; }
    }
    public function usernameCheck($id, $name){
        $this->db->where('id !=', $id);
        $this->db->where('username', $name);
        $res = $this->db->get('admin');
         if($r = $res->result()){
            return 'err';
         }else{
            return 'ok';
         }
    }
    public function updatePassword($arr){
        $this->db->update('admin', $arr);
    }
    public function logiCheck($name){
        $this->db->where('username', $name);
        $res = $this->db->get('admin');
         if($r = $res->result()){
            foreach($r as $rr){
                return $rr;
            }
         }else{
            return 'err';
         }
    }
    public function create_reset_link($vcode){
        $this->db->update('admin', array('vcode' => $vcode));
    }
    public function validat_reset_link($vcode){
        $res = $this->db->get_where('admin', array('vcode' => $vcode));
        if($r = $res->result()){
            return 'success';
        }else{
            return 'fail';
        }
    }
}
?>