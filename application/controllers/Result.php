<?php

class Result extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model', 'post_model');
		$this->load->model('Site_model', 'site_model');
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
		$x['logo'] =  $site_info->site_logo_header;
		$x['icon'] = $site_info->site_favicon;
		$site = $this->site_model->get_site_data()->row_array();
		$x['site_name'] = $site['site_name'];
		$x['site_title'] = $site['site_title'];
		$x['site_ig'] = $site['site_instagram'];
		$x['site_fb'] = $site['site_facebook'];
		$x['site_twit'] = $site['site_twitter'];
		$x['site_linked'] = $site['site_linkedin'];
		$x['site_wa'] = $site['site_wa'];
		$x['site_mail'] = $site['site_mail'];
		$x['site_twitter'] = $site['site_twitter'];
		$x['header'] = $this->load->view('layout/header3', $x, TRUE);
		$x['footer'] = $this->load->view('layout/footer2', '', TRUE);
		$this->load->view('post_search', $x);
	}
}
