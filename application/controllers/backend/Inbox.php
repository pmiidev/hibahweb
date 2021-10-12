<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbox extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/Inbox_model', 'inbox_model');
		error_reporting(0);
		$this->load->helper('text');
	}

	function index()
	{
		$count = $this->db->get_where('tbl_inbox');
		$page = $this->uri->segment(4);
		if (!$page) :
			$offset = 0;
		else :
			$offset = $page;
		endif;
		$limit = 10;
		$config['base_url'] = base_url() . 'backend/inbox/index/';
		$config['total_rows'] = $count->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;

		//Tambahan untuk styling
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next >>';
		$config['prev_link'] = '<< Prev';
		$this->pagination->initialize($config);
		$data['page'] = $this->pagination->create_links();
		$data['data'] = $this->inbox_model->get_all_inbox($offset, $limit);
		$this->load->view('backend/v_inbox', $data);
	}

	function read()
	{
		$inbox_id = htmlspecialchars($this->uri->segment(4), ENT_QUOTES);
		$result = $this->inbox_model->get_inbox_by_id($inbox_id);
		if ($result->num_rows() > 0) {
			$row = $result->row_array();
			$x['name'] = $row['inbox_name'];
			$x['email'] = $row['inbox_email'];
			$x['subject'] = $row['inbox_subject'];
			$x['message'] = $row['inbox_message'];
			$x['date'] = $row['inbox_created_at'];
			$this->inbox_model->update_status_by_id($inbox_id);
			$this->load->view('backend/v_inbox_detail', $x);
		} else {
			redirect('backend/inbox');
		}
	}

	function result()
	{
		$keyword = htmlspecialchars($this->input->get('search_query', TRUE), ENT_QUOTES);
		$data = $this->inbox_model->search_inbox($keyword);
		if ($data->num_rows() > 0) {
			$x['data'] = $data;
			$this->load->view('backend/v_inbox', $x);
		} else {
			$this->session->set_flashdata('msg', 'info');
			redirect('backend/inbox');
		}
	}

	function delete()
	{
		$inbox_id = $this->input->post('id', TRUE);
		$this->inbox_model->delete_inbox($inbox_id);
		$this->session->set_flashdata('msg', 'success');
		redirect('backend/inbox');
	}
}
