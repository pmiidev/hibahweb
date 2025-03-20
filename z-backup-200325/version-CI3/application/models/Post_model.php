<?php

class Post_model extends CI_Model
{

	function get_posts()
	{
		$query = $this->db->get('tbl_post');
		return $query;
	}

	function get_all_tags()
	{
		$query = $this->db->get('tbl_tags');
		return $query;
	}

	function get_post_perpage($offset, $limit)
	{
		$this->db->select('tbl_post.*, user_name,user_photo');
		$this->db->from('tbl_post');
		$this->db->join('tbl_user', 'post_user_id=user_id', 'left');
		$this->db->order_by('post_id', 'DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	function get_post_by_slug($slug)
	{
		$query = $this->db->query("SELECT tbl_post.*,user_name,COUNT(comment_id) AS comment_total,tbl_category.* FROM tbl_post 
			LEFT JOIN tbl_user ON post_user_id=user_id
			LEFT JOIN tbl_comment ON post_id=comment_post_id
			LEFT JOIN tbl_category ON post_category_id=category_id
			WHERE post_slug='$slug' GROUP BY post_id LIMIT 1");
		return $query;
	}

	function get_popular_post()
	{
		$this->db->select('tbl_post.*, user_name,user_photo');
		$this->db->from('tbl_post');
		$this->db->join('tbl_user', 'post_user_id=user_id', 'left');
		$this->db->order_by('post_views', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query;
	}

	function get_related_post($category_id, $kode)
	{
		$query = $this->db->query("SELECT * FROM tbl_post LEFT JOIN tbl_user ON post_user_id=user_id 
			WHERE post_category_id='$category_id' AND NOT post_id='$kode' ORDER BY post_views DESC LIMIT 4");
		return $query;
	}

	function count_views($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip = $this->db->query("SELECT * FROM tbl_post_views WHERE view_ip='$user_ip' AND view_post_id='$kode' AND DATE(view_date)=CURDATE()");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_post_views (view_ip,view_post_id) VALUES('$user_ip','$kode')");
			$this->db->query("UPDATE tbl_post SET post_views=post_views+1 where post_id='$kode'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	function show_comments($kode)
	{
		$query = $this->db->query("SELECT * FROM tbl_comment WHERE comment_post_id='$kode' AND comment_status='1' AND comment_parent='0'");
		return $query;
	}

	function save_comment($post_id, $name, $email, $comment)
	{
		$data = array(
			'comment_name' => $name,
			'comment_email' => $email,
			'comment_message' => $comment,
			'comment_post_id' => $post_id,
			'comment_image' => 'user_blank.png'
		);
		$this->db->insert('tbl_comment', $data);
	}

	function search_post($query)
	{
		$result = $this->db->query("SELECT tbl_post.*,user_name,user_photo FROM tbl_post
			LEFT JOIN tbl_user ON post_user_id=user_id
			LEFT JOIN tbl_category ON post_category_id=category_id
			WHERE post_title LIKE '%$query%' OR category_name LIKE '%$query%' OR post_tags LIKE '%$query%' LIMIT 12");
		return $result;
	}
}
