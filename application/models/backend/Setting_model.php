<?php

class Setting_model extends CI_Model
{

	function get_home_data()
	{
		$query = $this->db->get('tbl_home', 1);
		return $query;
	}

	function update_information($home_id, $caption1, $caption2, $bg_heading, $bg_testimoni, $bg_testimoni2)
	{
		$this->db->set('home_caption_1', $caption1);
		$this->db->set('home_caption_2', $caption2);
		$this->db->set('home_bg_heading', $bg_heading);
		$this->db->set('home_bg_testimonial', $bg_testimoni);
		$this->db->set('home_bg_testimonial2', $bg_testimoni2);
		$this->db->where('home_id', $home_id);
		$this->db->update('tbl_home');
	}

	function update_information_heading($home_id, $caption1, $caption2, $bg_heading)
	{
		$this->db->set('home_caption_1', $caption1);
		$this->db->set('home_caption_2', $caption2);
		$this->db->set('home_bg_heading', $bg_heading);
		$this->db->where('home_id', $home_id);
		$this->db->update('tbl_home');
	}

	function update_information_testimoni($home_id, $caption1, $caption2, $bg_testimoni)
	{
		$this->db->set('home_caption_1', $caption1);
		$this->db->set('home_caption_2', $caption2);
		$this->db->set('home_bg_testimonial', $bg_testimoni);
		$this->db->where('home_id', $home_id);
		$this->db->update('tbl_home');
	}

	function update_information_testimoni2($home_id, $caption1, $caption2, $bg_testimoni2)
	{
		$this->db->set('home_caption_1', $caption1);
		$this->db->set('home_caption_2', $caption2);
		$this->db->set('home_bg_testimonial2', $bg_testimoni2);
		$this->db->where('home_id', $home_id);
		$this->db->update('tbl_home');
	}

	function update_information_noimg($home_id, $caption1, $caption2)
	{
		$this->db->set('home_caption_1', $caption1);
		$this->db->set('home_caption_2', $caption2);
		$this->db->where('home_id', $home_id);
		$this->db->update('tbl_home');
	}

	// about information

	function get_about_data()
	{
		$query = $this->db->get('tbl_about', 1);
		return $query;
	}

	function update_information_about($about_id, $description, $image)
	{
		$this->db->set('about_image', $image);
		$this->db->set('about_description', $description);
		$this->db->where('about_id', $about_id);
		$this->db->update('tbl_about');
	}

	function update_information_about_noimg($about_id, $description)
	{
		$this->db->set('about_description', $description);
		$this->db->where('about_id', $about_id);
		$this->db->update('tbl_about');
	}

	// visimisi information

	// function get_visimisi_data(){
	// 	$query = $this->db->get('tbl_visimisi',1);
	// 	return $query;
	// }

	// function update_information_visimisi($visimisi_id,$description,$image){
	// 	$this->db->set('visimisi_image',$image);
	// 	$this->db->set('visimisi_description',$description);
	// 	$this->db->where('visimisi_id',$visimisi_id);
	// 	$this->db->update('tbl_visimisi');
	// }

	// function update_information_visimisi_noimg($visimisi_id,$description){
	// 	$this->db->set('visimisi_description',$description);
	// 	$this->db->where('visimisi_id',$visimisi_id);
	// 	$this->db->update('tbl_visimisi');
	// }
}
