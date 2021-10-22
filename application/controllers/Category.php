<?php
class Category extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
		$this->load->model('Visitor_model', 'visitor_model');
		$this->load->model('Post_model', 'post_model');
		$this->load->model('Site_model', 'site_model');
		$this->visitor_model->count_visitor();
		$this->load->helper('text');
		error_reporting(0);
	}

	function index()
	{
		redirect('post');
	}

	function detail($slug)
	{
		$data = $this->category_model->get_post_by_category($slug);
		if ($data->num_rows() > 0) {
			$q = $data->row_array();
			$category_id = $q['category_id'];
			$kategori_nama = $q['category_name'];
			$jum = $data;
			$page = $this->uri->segment(3);
			if (!$page) :
				$off = 0;
			else :
				$off = $page;
			endif;
			$limit = 9;
			$offset = $off > 0 ? (($off - 1) * $limit) : $off;
			$config['base_url'] = base_url() . 'category/' . $slug . '/';
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
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
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
			$x['data'] = $this->category_model->post_category_perpage($category_id, $offset, $limit);
			$x['title'] = $kategori_nama;
			$x['description'] = "Kumpulan artikel " . $kategori_nama . " yang bermanfaat untuk menambah wawasan Anda.";
			if (empty($this->uri->segment(3))) {
				$next_page = 2;
				$x['canonical'] = site_url('category/' . $slug);
				$x['url_prev'] = "";
			} elseif ($this->uri->segment(3) == '1') {
				$next_page = 2;
				$x['canonical'] = site_url('category/' . $slug);
				$x['url_prev'] = site_url('category/' . $slug);
			} elseif ($this->uri->segment(3) == '2') {
				$next_page = $this->uri->segment(3) + 1;
				$x['canonical'] = site_url('category/' . $slug . '/' . $this->uri->segment(3));
				$x['url_prev'] = site_url('category/' . $slug);
			} else {
				$next_page = $this->uri->segment(3) + 1;
				$prev_page = $this->uri->segment(3) - 1;
				$x['canonical'] = site_url('category/' . $slug . '/' . $this->uri->segment(3));
				$x['url_prev'] = site_url('category/' . $slug . '/' . $prev_page);
			}

			$x['url_next'] = site_url('category/' . $slug . '/' . $next_page);
			$x['populer_post'] = $this->post_model->get_popular_post();
			$site_info = $this->db->get('tbl_site', 1)->row();
			$x['logo'] =  $site_info->site_logo_header;
			$x['icon'] = $site_info->site_favicon;
			$x['site_image'] = $site_info->site_logo_big;
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
			$this->load->view('post_category', $x);
		} else {
			redirect('post');
		}
	}
}
