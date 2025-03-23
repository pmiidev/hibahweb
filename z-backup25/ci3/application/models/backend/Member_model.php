<?php

class Member_model extends CI_Model{
	
	function get_member(){
		$query = $this->db->get('tbl_member');
		return $query;
	}

	function insert_member($nama,$link,$desc,$gambar){
		$data = array(
			'member_name' => $nama,
			'member_link' => $link,
			'member_desc' => $desc, 
			'member_image' => $gambar,
		);
		$this->db->insert('tbl_member',$data);
	}

	function update_member($id,$nama,$link,$desc,$gambar){
		$this->db->set('member_name',$nama);
		$this->db->set('member_link',$link);
		$this->db->set('member_desc',$desc);
		$this->db->set('member_image',$gambar);
		$this->db->where('member_id',$id);
		$this->db->update('tbl_member');
	}

	function update_member_noimg($id,$nama,$link,$desc){
		$this->db->set('member_name',$nama);
		$this->db->set('member_link',$link);
		$this->db->set('member_desc',$desc);
		$this->db->where('member_id',$id);
		$this->db->update('tbl_member');
	}

	function delete_member($member_id){
		$this->db->where('member_id',$member_id);
		$this->db->delete('tbl_member');
	}
}