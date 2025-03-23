<?php
class Changepass_model extends CI_Model{
	
	function checking_old_password($user_id,$old_pass){
		$this->db->where('user_id', $user_id);
		$this->db->where('user_password', $old_pass);
		$query = $this->db->get('tbl_user');
		return $query;
	}

	function change_password($user_id,$new_pass){
		$this->db->set('user_password', $new_pass);
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user');
	}
}