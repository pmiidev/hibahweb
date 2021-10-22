<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Visitor_model', 'visitor_model');
		$this->load->model('Home_model', 'home_model');
		$this->load->model('Site_model', 'site_model');
		$this->load->model('Post_model', 'post_model');
		$this->visitor_model->count_visitor();
		$this->load->helper('text');
		error_reporting(0);
	}
	function index()
	{
		$jum = $this->post_model->get_posts();
		$page = $this->uri->segment(3);
		if (!$page) :
			$off = 0;
		else :
			$off = $page;
		endif;
		$limit = 6;
		$offset = $off > 0 ? (($off - 1) * $limit) : $off;
		$config['base_url'] = base_url() . 'post/page/';
		$config['total_rows'] = $jum->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		//Tambahan untuk styling
		$config['full_tag_open']    = '<div class="row"><nav class="page-pagination mt-60"><ul class="page-numbers">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li><span class="page-numbers">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li><span class="page-numbers current">';
		$config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
		$config['next_tag_open']    = '<li><span class="page-numbers">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li><span class="page-numbers">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li><span class="page-numbers">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li><span class="page-numbers">';
		$config['last_tagl_close']  = '</span></li>';

		$config['first_link'] = '<';
		$config['last_link'] = '>';
		$config['next_link'] = '>>';
		$config['prev_link'] = '<<';
		$this->pagination->initialize($config);
		$data['page'] = $this->pagination->create_links();
		$data['data'] = $this->post_model->get_post_perpage($offset, $limit);
		//print_r($this->db->last_query()); 
		// $x['title'] = "Post | Poroz";
		if (empty($this->uri->segment(3))) {
			$next_page = 2;
			$data['canonical'] = site_url('post');
			$data['url_prev'] = "";
		} elseif ($this->uri->segment(3) == '1') {
			$next_page = 2;
			$data['canonical'] = site_url('post');
			$data['url_prev'] = site_url('post');
		} elseif ($this->uri->segment(3) == '2') {
			$next_page = $this->uri->segment(3) + 1;
			$data['canonical'] = site_url('post/page/' . $this->uri->segment(3));
			$data['url_prev'] = site_url('post');
		} else {
			$next_page = $this->uri->segment(3) + 1;
			$prev_page = $this->uri->segment(3) - 1;
			$data['canonical'] = site_url('post/page/' . $this->uri->segment(3));
			$data['url_prev'] = site_url('post/page/' . $prev_page);
		}

		$data['url_next'] = site_url('post/page/' . $next_page);
		$data['populer_post'] = $this->post_model->get_popular_post();

		$site = $this->site_model->get_site_data()->row_array();
		$data['title'] = "Gallery";
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

		$data['testimonial'] = $this->db->get('tbl_testimonial');
		$data['allpost'] = $this->db->get('tbl_post');

		$site_info = $this->db->get('tbl_site', 1)->row();
		$data['logo'] =  $site_info->site_logo_header;
		$data['icon'] = $site_info->site_favicon;
		$data['header'] = $this->load->view('layout/header2', $data, TRUE);
		$data['footer'] = $this->load->view('layout/footer', '', TRUE);
		$this->load->view('gallery_view', $data);
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
