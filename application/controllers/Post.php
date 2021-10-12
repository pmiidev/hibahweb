<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model', 'post_model');
		$this->load->model('Visitor_model', 'visitor_model');
		$this->load->model('Home_model', 'home_model');
		$this->load->model('Site_model', 'site_model');
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
		$x['page'] = $this->pagination->create_links();
		$x['data'] = $this->post_model->get_post_perpage($offset, $limit);
		//print_r($this->db->last_query()); 
		$x['title'] = "Post | Poroz";
		if (empty($this->uri->segment(3))) {
			$next_page = 2;
			$x['canonical'] = site_url('post');
			$x['url_prev'] = "";
		} elseif ($this->uri->segment(3) == '1') {
			$next_page = 2;
			$x['canonical'] = site_url('post');
			$x['url_prev'] = site_url('post');
		} elseif ($this->uri->segment(3) == '2') {
			$next_page = $this->uri->segment(3) + 1;
			$x['canonical'] = site_url('post/page/' . $this->uri->segment(3));
			$x['url_prev'] = site_url('post');
		} else {
			$next_page = $this->uri->segment(3) + 1;
			$prev_page = $this->uri->segment(3) - 1;
			$x['canonical'] = site_url('post/page/' . $this->uri->segment(3));
			$x['url_prev'] = site_url('post/page/' . $prev_page);
		}

		$x['url_next'] = site_url('post/page/' . $next_page);
		$x['populer_post'] = $this->post_model->get_popular_post();
		$site_info = $this->db->get('tbl_site', 1)->row();
		$v['logo'] =  $site_info->site_logo_header;
		$x['icon'] = $site_info->site_favicon;
		$x['site_image'] = $site_info->site_logo_big;
		$site = $this->site_model->get_site_data()->row_array();
		$x['site_name'] = $site['site_name'];
		$x['site_twitter'] = $site['site_twitter'];
		$query = $this->db->query("SELECT GROUP_CONCAT(category_name) AS category_name FROM tbl_category")->row_array();
		$x['meta_description'] = $query['category_name'];
		$x['header'] = $this->load->view('layout/header4', $v, TRUE);
		$x['footer'] = $this->load->view('layout/footer', '', TRUE);
		$this->load->view('post_view', $x);
	}


	function detail($slug)
	{
		$data = $this->post_model->get_post_by_slug($slug);
		if ($data->num_rows() > 0) {
			$q = $data->row_array();
			$kode = $q['post_id'];
			$x['title'] = $q['post_title'];
			if (empty($q['post_description'])) {
				$x['description'] = strip_tags(word_limiter($q['post_contents'], 25));
			} else {
				$x['description'] = $q['post_description'];
			}
			$x['image'] = $q['post_image'];
			$x['slug'] = $q['post_slug'];
			$x['content'] = $q['post_contents'];
			$x['views'] = $q['post_views'];
			$x['comment'] = $q['comment_total'];
			$x['author'] = $q['user_name'];
			$author_info = $this->db->get('tbl_user')->row();
			$x['photo'] = $author_info->user_photo;
			$x['category'] = $q['category_name'];
			$x['category_slug'] = $q['category_slug'];
			$x['date'] = $q['post_date'];
			$x['tags'] = $q['post_tags'];
			$x['post_id'] = $kode;
			$category_id = $q['category_id'];
			$this->post_model->count_views($kode);
			$x['related_post']  = $this->post_model->get_related_post($category_id, $kode);
			$x['data'] = $this->post_model->get_post_perpage($offset, $limit);
			$x['show_comments'] = $this->post_model->show_comments($kode);
			$site_info = $this->db->get('tbl_site', 1)->row();
			$v['logo'] =  $site_info->site_logo_header;
			$x['icon'] = $site_info->site_favicon;
			$site = $this->site_model->get_site_data()->row_array();
			$x['site_name'] = $site['site_name'];
			$x['site_twitter'] = $site['site_twitter'];
			$x['site_facebook'] = $site['site_facebook'];
			$x['header'] = $this->load->view('layout/header3', $v, TRUE);
			$x['footer'] = $this->load->view('layout/footer2', '', TRUE);
			$x['all_tags'] = $this->post_model->get_all_tags();
			$this->load->view('post_detail', $x);
		} else {
			redirect('post');
		}
	}


	function submit_komentar()
	{
		$post_id = htmlspecialchars($this->input->post('post_id', TRUE), ENT_QUOTES);
		$slug = htmlspecialchars($this->input->post('slug', TRUE), ENT_QUOTES);
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[40]|htmlspecialchars');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
			redirect('post/' . $slug);
		} else {
			$name = $this->input->post('name', TRUE);
			$email = $this->input->post('email', TRUE);
			$comment = htmlspecialchars($this->input->post('comment', TRUE), ENT_QUOTES);
			$this->post_model->save_comment($post_id, $name, $email, $comment);
			$this->session->set_flashdata('msg', '<div class="alert alert-info">Terima kasih atas respon Anda, komentar Anda akan tampil setelah moderasi</div>');
			redirect('post/' . $slug);
		}
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
			$email = $this->input->post('email', TRUE);
			$url = $this->input->post('url', TRUE);
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
