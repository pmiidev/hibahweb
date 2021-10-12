<?php

class Navbar_model extends CI_Model{
	
	function get_navbar(){
		$query = $this->db->get_where('tbl_navbar', array('navbar_parent_id' => '0'));
		return $query;
	}

	function insert_navbar($name,$slug){
		$data = array(
			'navbar_name' => $name,
			'navbar_slug' => $slug 
		);
		$this->db->insert('tbl_navbar',$data);
	}

	function update_navbar($id,$name,$slug){
		$this->db->set('navbar_name',$name);
		$this->db->set('navbar_slug',$slug);
		$this->db->where('navbar_id',$id);
		$this->db->update('tbl_navbar');
	}

	function delete_navbar($id){
		$this->db->trans_start();
		$this->db->query("DELETE FROM tbl_navbar WHERE navbar_parent_id='$id'");
		$this->db->query("DELETE FROM tbl_navbar WHERE navbar_id='$id'");
		$this->db->trans_complete();
	}

	function insert_subnavbar($name,$slug,$id){
		$data = array(
			'navbar_name' => $name,
			'navbar_slug' => $slug,
			'navbar_parent_id' => $id 
		);
		$this->db->insert('tbl_navbar',$data);
	}
}