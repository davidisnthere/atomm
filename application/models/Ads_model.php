<?php
class Ads_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}
 	public function new_ad($arr, $id){
        $this->db->where('pos', $id);
        $this->db->update('ad', $arr);
    }
    public function add_ads(){
        $res = $this->db->get('ad');
        if($r = $res->result()){
            return $r;
        }
    }

    public function get_footer_script(){
        $res = $this->db->get('script_header');
        if($r = $res->result()){
            foreach($r as $rr){
                return $rr->txt;
            }
        }
    }
    public function add_header_script($arr){
        $this->db->where('id', 1);
        $this->db->update('script_header', $arr);
    }
}
?>