<?php
class Login extends CI_Controller
{
	function __construct()
	{
		
		parent::__construct();
		$this->load->model('backend/Login_model', 'login_model');
		error_reporting(0);
	}

	function index()
	{
		$this->load->view('backend/v_login');
		$this->load->helper('text');
	}

	function auth()
	{ 
		$username = str_replace("'", "", htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES));
		$password = str_replace("'", "", htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES));
		$validate_us = $this->login_model->validasi_username($username);
		if ($validate_us->num_rows() > 0) {
			$validate_ps = $this->login_model->validasi_password($username, $password);
			if ($validate_ps->num_rows() > 0) {
				$this->session->set_userdata('logged', TRUE);
				$this->session->set_userdata('user', $u);
				$x = $validate_ps->row_array();

				if ($x['user_level'] == '1') { //Administrator
					$this->session->set_userdata('access', '1');
					$id = $x['user_id'];
					$name = $x['user_name'];
					$this->session->set_userdata('id', $id);
					$this->session->set_userdata('name', $name);
					redirect('backend/dashboard');
				} else { //Others User 
					$this->session->set_userdata('access', '2');
					$id = $x['user_id'];
					$name = $x['user_name'];
					$this->session->set_userdata('id', $id);
					$this->session->set_userdata('name', $name);
					redirect('backend/dashboard');
				}
			} else {
				$url = base_url('administrator');
				echo $this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button> Password Salah</div>');
				redirect($url);
			}
		} else {
			$url = base_url('administrator');
			echo $this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button> Username Salah</div>');
			redirect($url);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$url = base_url('login');
		redirect($url);
	}
}
