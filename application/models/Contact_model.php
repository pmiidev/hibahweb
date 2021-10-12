<?php

class Contact_model extends CI_Model
{

	function save_message($name, $email, $subject, $message)
	{
		$data = array(
			'inbox_name' => $name,
			'inbox_email' => $email,
			'inbox_subject' => $subject,
			'inbox_message' => $message
		);
		$this->db->insert('tbl_inbox', $data);
	}
}
