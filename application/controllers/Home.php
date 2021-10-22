<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{

		parent::__construct();
		$this->load->model('Visitor_model', 'visitor_model');
		$this->load->model('Home_model', 'home_model');
		$this->load->model('Site_model', 'site_model');
		// $this->load->model('Testimonial_model', 'testimonial_model');
		$this->visitor_model->count_visitor();
		$this->load->helper('text');
	}
	function index()
	{

		//$this->output->enable_profiler(TRUE);
		$site = $this->site_model->get_site_data()->row_array();
		$data['site_name'] = $site['site_name'];
		$data['site_title'] = $site['site_title'];
		$data['site_desc'] = $site['site_description'];
		$data['site_image'] = $site['site_logo_big'];
		$data['site_ig'] = $site['site_instagram'];
		$data['site_fb'] = $site['site_facebook'];
		$data['site_twit'] = $site['site_twitter'];
		$data['site_linked'] = $site['site_linkedin'];
		$data['site_wa'] = $site['site_wa'];
		$data['site_mail'] = $site['site_mail'];

		$data['post_header'] = $this->home_model->get_post_header();
		$data['post_header_2'] = $this->home_model->get_post_header_2();
		$data['post_header_3'] = $this->home_model->get_post_header_3();
		$data['latest_post'] = $this->home_model->get_latest_post();
		$data['popular_post'] = $this->home_model->get_popular_post();
		$home = $this->db->get('tbl_home', 1)->row();
		$data['caption_1'] = $home->home_caption_1;
		$data['caption_2'] = $home->home_caption_2;
		$data['bg_header'] = $home->home_bg_heading;
		$data['bg_testimoni'] = $home->home_bg_testimonial;
		$data['bg_testimoni2'] = $home->home_bg_testimonial2;
		$data['testimonial'] = $this->db->get('tbl_testimonial');
		$data['member'] = $this->db->get('tbl_member');
		$site_info = $this->db->get('tbl_site', 1)->row();
		$data['logo'] =  $site_info->site_logo_header;
		$data['icon'] = $site_info->site_favicon;

		$about = $this->db->get('tbl_about', 1)->row();
		$data['about_img'] = $about->about_image;
		$data['about_desc'] = $about->about_description;
		$data['header'] = $this->load->view('layout/header', $data, TRUE);
		$data['footer'] = $this->load->view('layout/footer', '', TRUE);
		$this->load->view('home_view', $data);
	}

	function subscribe()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
			$base_url = site_url();
			redirect($base_url);
		} else {
			$email = $this->input->gallery('email', TRUE);
			$url = $this->input->gallery('url', TRUE);
			$checking_email = $this->home_model->checking_email($email);
			if ($checking_email->num_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-info">Terima kasih telah berlangganan.</div>');
				redirect($url);
			} else {
				$this->home_model->save_subcribe($email);
				$this->session->set_flashdata('msg', '<div class="alert alert-info">Terima kasih telah berlangganan.</div>');
				redirect($url);
			}
		}
	}
}
