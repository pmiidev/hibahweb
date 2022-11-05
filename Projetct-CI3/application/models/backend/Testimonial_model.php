<?php

class Testimonial_model extends CI_Model{
	
	function get_testimonial(){
		$query = $this->db->get('tbl_testimonial');
		return $query;
	}

	function insert_testimonial($nama,$jabatan,$content,$gambar){
		$data = array(
			'testimonial_name' => $nama,
			'testimonial_org' => $jabatan,
			'testimonial_content' => $content, 
			'testimonial_image' => $gambar,
		);
		$this->db->insert('tbl_testimonial',$data);
	}

	function update_testimonial($id,$nama,$jabatan,$content,$gambar){
		$this->db->set('testimonial_name',$nama);
		$this->db->set('testimonial_org',$jabatan);
		$this->db->set('testimonial_content',$content);
		$this->db->set('testimonial_image',$gambar);
		$this->db->where('testimonial_id',$id);
		$this->db->update('tbl_testimonial');
	}

	function update_testimonial_noimg($id,$nama,$jabatan,$content){
		$this->db->set('testimonial_name',$nama);
		$this->db->set('testimonial_org',$jabatan);
		$this->db->set('testimonial_content',$content);
		$this->db->where('testimonial_id',$id);
		$this->db->update('tbl_testimonial');
	}

	function delete_testimonial($testimonial_id){
		$this->db->where('testimonial_id',$testimonial_id);
		$this->db->delete('tbl_testimonial');
	}
}