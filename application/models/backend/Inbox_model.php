<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_model extends CI_Model{
	
	function get_all_inbox($offset,$limit){
		$query = $this->db->get('tbl_inbox', $offset,$limit);
		return $query;
	}

	function get_inbox_by_id($inbox_id){
		$query = $this->db->get_where('tbl_inbox', array('inbox_id' => $inbox_id));
		return $query;
	}

	function search_inbox($keyword){
		$this->db->like('inbox_name', $keyword);
		$this->db->or_like('inbox_subject', $keyword);
		$query = $this->db->get('tbl_inbox');
		return $query;
	}

	function update_status_by_id($inbox_id){
		$data = array(
		        'inbox_status' => 1
		);
		$this->db->where('inbox_id', $inbox_id);
		$this->db->update('tbl_inbox', $data);
	}

	function delete_inbox($inbox_id){
		$this->db->where('inbox_id', $inbox_id);
		$this->db->delete('tbl_inbox');
	}
}