<?php
class Tag_model extends CI_Model{

	function get_all_tag(){
		$result = $this->db->get('tbl_tags');
		return $result; 
	}

	function add_new_row($tag){
		$data = array(
	        'tag_name' => $tag
		);
		$this->db->insert('tbl_tags', $data);
	}

	function edit_row($id,$tag){
		$data = array(
	        'tag_name' => $tag
		);
		$this->db->where('tag_id', $id);
		$this->db->update('tbl_tags', $data);
	}

	function delete_row($id){
		$this->db->where('tag_id', $id);
		$this->db->delete('tbl_tags');
	}


}