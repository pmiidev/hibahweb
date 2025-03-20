<?php

class Subscribe_model extends CI_Model{
	
	function get_subscribers(){
		$query = $this->db->get('tbl_subscribe');
		return $query;
	}

	function update_status($id){
		$this->db->set('subscribe_status','1');
		$this->db->where('subscribe_id',$id);
		$this->db->update('tbl_subscribe');
	}

	function delete_email($id){
		$this->db->where('subscribe_id', $id);
		$this->db->delete('tbl_subscribe');
	}

	function decrease_rating($id){
		$this->db->set('subscribe_rating','subscribe_rating-1',FALSE);
		$this->db->where('subscribe_id',$id);
		$this->db->update('tbl_subscribe');
	}

	function increase_rating($id){
		$this->db->set('subscribe_rating','subscribe_rating+1',FALSE);
		$this->db->where('subscribe_id',$id);
		$this->db->update('tbl_subscribe');
	}
}