<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Contact_model', 'contact_model');
		$this->load->model('Site_model', 'site_model');
		$this->load->model('Visitor_model', 'visitor_model');
		$this->visitor_model->count_visitor();
	}
	function index()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['title'] = $site['site_title'];
		$data['desc'] = $site['site_description'];
		$data['site_name'] = $site['site_name'];
		$data['site_image'] = $site['site_logo_big'];
		$data['site_twitter'] = $site['site_twitter'];

		$site_info = $this->db->get('tbl_site', 1)->row();
		$data['logo'] =  $site_info->site_logo_header;
		$data['icon'] = $site_info->site_favicon;
		$data['header'] = $this->load->view('layout/header', $data, TRUE);
		$data['footer'] = $this->load->view('layout/footer', '', TRUE);
		$this->load->view('contact_view', $data);
	}

	function send()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[40]|htmlspecialchars');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'required|min_length[3]|max_length[100]|htmlspecialchars');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
			redirect('#contact');
		} else {
			$name = $this->input->post('name', TRUE);
			$email = $this->input->post('email', TRUE);
			$subject = $this->input->post('subject', TRUE);
			$message = strip_tags(htmlspecialchars($this->input->post('message', TRUE), ENT_QUOTES));
			$this->contact_model->save_message($name, $email, $subject, $message);
			$this->session->set_flashdata('msg', '<div class="alert alert-info">Terima kasih telah menghubungi kami, pesan Anda akan segera kami proses.</div>');
			redirect('#contact');
		}
	}
}
