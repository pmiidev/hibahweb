<?php

class Visimisi_setting extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Setting_model','setting_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}

	function index(){
		$data = $this->setting_model->get_visimisi_data()->row();
		$x['visimisi_id'] = $data->visimisi_id;
		$x['visimisi_img'] = $data->visimisi_image;
		$x['visimisi_desc'] = $data->visimisi_description;
		$this->load->view('backend/v_visimisi_setting',$x);
	}

	function update(){
		$visimisi_id = htmlspecialchars($this->input->post('visimisi_id',TRUE),ENT_QUOTES);
		$description = $this->input->post('description',TRUE);
		
		$config['upload_path'] = './theme/images/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
	    $config['encrypt_name'] = FALSE;

	    $this->upload->initialize($config);
	    if(!empty($_FILES['img_visimisi']['name'])){
	    	if ($this->upload->do_upload('img_visimisi')){
	            $img_visimisi = $this->upload->data();
	            $image=$img_visimisi['file_name'];
	        }
	        $this->setting_model->update_information_visimisi($visimisi_id,$description,$image);
	        $this->session->set_flashdata('msg','success');
	        redirect('backend/visimisi_setting');

	    }else{
	    	$this->setting_model->update_information_visimisi_noimg($visimisi_id,$description);
	        $this->session->set_flashdata('msg','success');
	        redirect('backend/visimisi_setting');
	    }
	}

}