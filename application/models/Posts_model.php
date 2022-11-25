<?php
class Posts_model extends CI_Model{
    public function __construct(){
		parent::__construct();
	}


	public function add_posts($arr){
		$this->db->insert('posts', $arr);
		return $this->db->insert_id();
	}

	public function update_posts($arr, $id){
		$this->db->where('id', $id);
		$this->db->update('posts', $arr);
	}
	public function update_url($id, $url){
		$this->db->where('id', $id);
		$this->db->update('posts', array('url'=>$url));
	}
	public function remove_posts($id){
		$this->db->where('id', $id);
		$this->db->update('posts', array('active'=>'NO'));
	}
	public function restore_posts($id){
		$this->db->where('id', $id);
		$this->db->update('posts', array('active'=>'YES'));
	}
	public function get_posts($limit, $ofset){
		$this->db->where('active', 'YES');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $ofset);
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}

	public function getPostAll(){
		$this->db->where('active', 'YES');
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}

	public function get_trash_posts(){
		$this->db->where('active', 'NO');
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}

	public function get_posts_by_cat($cat_id, $limit, $ofset){
		$this->db->where('active', 'YES');
		$this->db->limit($limit, $ofset);
		$this->db->where('cat_ref', $cat_id);
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}

	public function single_posts($id){
		$this->db->where('id', $id);
		$res = $this->db->get('posts');
		if($r = $res->result()){
			foreach($r as $rr){
				return $rr;
			}
		}
	}

	public function add_replay($arr){
		$this->db->insert('replay', $arr);
		$this->db->insert_id();
	}

	public function update_replay($arr, $id){
		$this->db->where('id', $id);
		$this->db->update('replay', $arr);
	}

	public function remove_replay($id){
		$this->db->where('id', $id);
		$this->db->update('replay', array('active'=>'NO'));
	}

	public function get_replay($id){
		$this->db->where('active', 'YES');
		$this->db->where('post_ref', $id);
		$res = $this->db->get('replay');
		if($r = $res->result()){
			return $r;
		}
	}

	public function add_replay_like($user_id, $replay_id, $post_id){
		$res = $this->db->get_where('replay_like', array('user_ref'=>$user_id,'replay_ref'=>$replay_id));
		if(!$r = $res->result()){
			$this->db->insert('replay_like', array('user_ref'=>$user_id,'replay_ref'=>$replay_id,'post_ref' => $post_id));
		}
	}
  public function remove_replay_like($user_id, $replay_id, $post_id){
    $this->db->where('user_ref', $user_id);
    $this->db->where('replay_ref', $replay_id);
    $this->db->delete('replay_like');
  }
	public function is_user_like($user_id, $replay_id){
		$res = $this->db->get_where('replay_like', array('user_ref'=>$user_id,'replay_ref'=>$replay_id));
		if($r = $res->result()){
			return 'yes';
		}else{
			return 'no';
		}
	}
	public function get_replay_count($post){
		$this->db->where('active', 'YES');
		$this->db->where('post_ref', $post);
		$res = $this->db->get('replay')->num_rows();
		return $res;
	}
	public function get_like_count($id){
		$res = $this->db->get_where('replay_like', array('replay_ref'=>$id))->num_rows();
		return $res;
	}
	public function get_related_post($cat_id, $post_id){
		$this->db->where('active', 'YES');
		$this->db->where('cat_ref', $cat_id);
		$this->db->where('id !=', $post_id);
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}
  public function get_id_by_url($url){
    $res = $this->db->get_where('posts', array('url'=>$url));
    if($r = $res->result()){
      foreach($r as $rr){
        return $rr->id;
      }
    }
  }

  public function add_view_count($pid){
    $this->db->where('id', $pid);
    $this->db->set('count', 'count+1', FALSE);
    $this->db->update('posts');
	}
	
	public function search_post($sky){
		$this->db->like('title', $sky);
		$res = $this->db->get('posts');
		if($r = $res->result()){
				return $r;
		}
	}
	public function get_top_posts(){
		$this->db->where('active', 'YES');
		$this->db->order_by('count','desc');
		$this->db->limit(9);
		$res = $this->db->get('posts');
		if($r = $res->result()){
			return $r;
		}
	}
	public function url_check($url){
		$res = $this->db->get_where('posts', array('url' => $url));
		if($r = $res->result()){
			return 'YES';
		}
	  }
	  public function single_replay($id){
	  	  $res = $this->db->get_where('replay', array('id' => $id));	
	  	  if($r = $res->result()){
			 foreach($r as $rr){
			 	return $rr;
			 }
		  }
	  }


}
?>
