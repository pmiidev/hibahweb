<?php
class Tag extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Tag_model','tag_model');
		$this->load->helper('text');
	}

	function index(){
		$x['data'] = $this->tag_model->get_all_tag();
		$this->load->view('backend/v_tag',$x);
		$this->load->helper('text');
	}

	function save(){
		$tag = strip_tags(htmlspecialchars($this->input->post('tag',TRUE),ENT_QUOTES));
		$this->tag_model->add_new_row($tag);
		$this->session->set_flashdata('msg','success');
		redirect('backend/tag');
	}

	function edit(){
		$id		 = $this->input->post('kode',TRUE);
		$tag 	 = strip_tags(htmlspecialchars($this->input->post('tag2',TRUE),ENT_QUOTES));
		$this->tag_model->edit_row($id,$tag);
		$this->session->set_flashdata('msg','info');
		redirect('backend/tag');
	}

	function delete(){
		$id = $this->input->post('id',TRUE);
		$this->tag_model->delete_row($id);
		$this->session->set_flashdata('msg','success-delete');
		redirect('backend/tag');
	}
}