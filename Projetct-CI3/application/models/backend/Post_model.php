<?php
class Post_model extends CI_Model
{

	//BACKEND
	function get_all_post()
	{
		$result = $this->db->query("SELECT post_id,post_title,post_image,DATE_FORMAT(post_date,'%d %M %Y') AS post_date,category_name,post_tags,post_status,post_views FROM tbl_post JOIN tbl_category ON post_category_id=category_id");
		return $result;
	}

	function get_post_by_id($post_id)
	{
		$result = $this->db->query("SELECT * FROM tbl_post WHERE post_id='$post_id'");
		return $result;
	}

	function save_post($title, $contents, $category, $slug, $image, $tags, $description)
	{
		$data = array(
			'post_title' 	   => $title,
			'post_description' => $description,
			'post_contents'    => $contents,
			'post_image' 	   => $image,
			'post_category_id' => $category,
			'post_tags' 	   => $tags,
			'post_slug' 	   => $slug,
			'post_status' 	   => 1,
			'post_user_id'	   => $this->session->userdata('id')
		);
		$this->db->insert('tbl_post', $data);
	}

	function edit_post_with_img($id, $title, $contents, $category, $slug, $image, $tags, $description)
	{
		$this->db->set('post_title', $title);
		$this->db->set('post_description', $description);
		$this->db->set('post_contents', $contents);
		$this->db->set('post_category_id', $category);
		$this->db->set('post_tags', $tags);
		$this->db->set('post_slug', $slug);
		$this->db->set('post_image', $image);
		$this->db->where('post_id', $id);
		$this->db->update('tbl_post');
	}

	function edit_post_no_img($id, $title, $contents, $category, $slug, $tags, $description)
	{
		$this->db->set('post_title', $title);
		$this->db->set('post_description', $description);
		$this->db->set('post_contents', $contents);
		$this->db->set('post_category_id', $category);
		$this->db->set('post_tags', $tags);
		$this->db->set('post_slug', $slug);
		$this->db->where('post_id', $id);
		$this->db->update('tbl_post');
	}

	function delete_post($post_id)
	{
		$this->db->where('post_id', $post_id);
		$this->db->delete('tbl_post');
	}

	//END BACKEND

}
