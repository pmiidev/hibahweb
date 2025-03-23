<?php

class Navbar extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Navbar_model','navbar_model');
		$this->load->helper('text');
	}

	function index(){
		$x['data'] = $this->navbar_model->get_navbar();
		$this->load->view('backend/v_navbar',$x);
	}

	function insert(){
		$name = htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$slug = htmlspecialchars(trim($this->input->post('slug',TRUE)),ENT_QUOTES);
		$this->navbar_model->insert_navbar($name,$slug);
		echo $this->session->set_flashdata('msg','success');
		redirect('backend/navbar');
	}

	function update(){
		$id = $this->input->post('navbar_id',TRUE);
		$name = htmlspecialchars($this->input->post('name_edit',TRUE),ENT_QUOTES);
		$slug = htmlspecialchars(trim($this->input->post('slug_edit',TRUE)),ENT_QUOTES);
		$this->navbar_model->update_navbar($id,$name,$slug);
		echo $this->session->set_flashdata('msg','info');
		redirect('backend/navbar');
	}

	function delete(){
		$id = $this->input->post('id_delete',TRUE);
		$this->navbar_model->delete_navbar($id);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('backend/navbar');
	}

	function insert_submenu(){
		$id = $this->input->post('id_submenu',TRUE);
		$name = htmlspecialchars($this->input->post('name_submenu',TRUE),ENT_QUOTES);
		$slug = htmlspecialchars(trim($this->input->post('slug_submenu',TRUE)),ENT_QUOTES);
		$this->navbar_model->insert_subnavbar($name,$slug,$id);
		echo $this->session->set_flashdata('msg','success');
		redirect('backend/navbar');
	}

}