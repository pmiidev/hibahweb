<?php

class Result extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model', 'post_model');
		$this->load->model('Visitor_model', 'visitor_model');
		$this->visitor_model->count_visitor();
		$this->load->helper('text');
		error_reporting(0);
	}
	function index()
	{
		redirect('post');
	}

	function search()
	{
		// $site = $this->site_model->get_site_data()->row_array();
		// $data['title'] = "Result";
		// $data['site_name'] = $site['site_name'];
		// $data['site_title'] = $site['site_title'];
		// $data['site_desc'] = $site['site_description'];
		// $data['site_image'] = $site['site_logo_big'];
		// $data['site_ig'] = $site['site_instagram'];
		// $data['site_fb'] = $site['site_facebook'];
		// $data['site_twit'] = $site['site_twitter'];
		// $data['site_linked'] = $site['site_linkedin'];
		// $data['site_wa'] = $site['site_wa'];
		// $data['site_mail'] = $site['site_mail'];

		$query = strip_tags(htmlspecialchars($this->input->get('search_query', TRUE), ENT_QUOTES));
		$result = $this->post_model->search_post($query);
		if ($result->num_rows() > 0) {
			$x['data'] = $result;
			$x['title'] = 'Search result:' . ' "' . $query . '"';
		} else {
			$x['data'] = $result;
			$x['title'] = 'Search result: "Tidak Temukan"';
		}
		$x['populer_post'] = $this->post_model->get_popular_post();
		$site_info = $this->db->get('tbl_site', 1)->row();
		$v['logo'] =  $site_info->site_logo_header;
		$x['icon'] = $site_info->site_favicon;
		$x['header'] = $this->load->view('layout/header2', $v, TRUE);
		$x['footer'] = $this->load->view('layout/footer2', '', TRUE);
		$this->load->view('post_search', $x);
	}
}
