<?php
class Login_model extends CI_Model{

    function validasi_username($username){
    	$result = $this->db->query("SELECT * FROM tbl_user WHERE user_email='$username' LIMIT 1");
        return $result;
    }

    function validasi_password($username,$password){
    	$result = $this->db->query("SELECT * FROM tbl_user WHERE user_email='$username' AND user_password=MD5('$password') LIMIT 1");
        return $result;
    }

} 