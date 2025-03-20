<?php
class Comment_model extends CI_Model{

	function get_all_comment($offset,$limit){
		$result = $this->db->query("SELECT comment_id,DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,comment_name,comment_email,comment_status,comment_message,comment_image,post_id,post_title,post_slug FROM tbl_comment JOIN tbl_post ON comment_post_id=post_id WHERE comment_parent='0' ORDER BY comment_id DESC LIMIT $offset,$limit");
		return $result;
	}

	function get_all_comment_unpublish($offset,$limit){
		$result = $this->db->query("SELECT comment_id,DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,comment_name,comment_email,comment_status,comment_message,comment_image,post_id,post_title,post_slug FROM tbl_comment JOIN tbl_post ON comment_post_id=post_id WHERE comment_status='0' ORDER BY comment_id DESC LIMIT $offset,$limit");
		return $result;
	}

	function reply_comment($post_id,$comment_id,$comments,$user_id,$user_name,$user_email){

        $user_id=$this->session->userdata('id');
        $query=$this->db->get_where('tbl_user', array('user_id' => $user_id));
        if($query->num_rows() > 0){
        	$row = $query->row_array();
        	$image = $row['user_photo'];
    	}else{
    		$image = 'user_blank.png';
    	}
    
		$data = array(
	        'comment_name' 	  => $user_name,
	        'comment_email'   => $user_email,
	        'comment_message' => $comments,
	        'comment_status'  => 1,
	        'comment_parent'  => $comment_id,
	        'comment_post_id' => $post_id,
	        'comment_image' => $image
		);

		$this->db->insert('tbl_comment', $data);
	}

	function edit_comment($comment_id,$comments){
		$this->db->set('comment_message', $comments);
		$this->db->where('comment_id', $comment_id);
		$this->db->update('tbl_comment');
	}

	function publish_comment($comment_id){
		$this->db->set('comment_status', '1');
		$this->db->where('comment_id', $comment_id);
		$this->db->update('tbl_comment');
	}

	function delete_comment($comment_id){
		$this->db->trans_start();
			$this->db->query("DELETE FROM tbl_comment WHERE comment_parent='$comment_id'");
			$this->db->query("DELETE FROM tbl_comment WHERE comment_id='$comment_id'");
		$this->db->trans_complete();
	}

	function change_image($id,$name,$email,$image){
		$this->db->set('comment_name', $name);
		$this->db->set('comment_email', $email);
		$this->db->set('comment_image', $image);
		$this->db->where('comment_id', $id);
		$this->db->update('tbl_comment');
	}

	function search_comment($keyword){
		$hsl=$this->db->query("SELECT comment_id,DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,
			comment_name,comment_email,comment_status,comment_message,comment_image,
			post_id,post_title,post_slug FROM tbl_comment LEFT JOIN tbl_post ON comment_post_id=post_id 
			WHERE (comment_name LIKE '%$keyword%' OR post_title LIKE '%$keyword%') AND comment_parent='0' ORDER BY comment_id DESC LIMIT 10");
		return $hsl;
	}
}