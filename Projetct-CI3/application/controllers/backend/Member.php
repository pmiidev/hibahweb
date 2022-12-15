<?php

class Member extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Member_model','member_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}

	function index(){
		$x['data'] = $this->member_model->get_member();
		$this->load->view('backend/v_member',$x);
	}

	function insert(){
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$link=htmlspecialchars($this->input->post('link',TRUE),ENT_QUOTES);
		$desc=htmlspecialchars($this->input->post('desc',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images/member'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    
    	if(!empty($_FILES['filefoto']['name'])){
	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/backend/images/member/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '70%';
                $config['width']= 400;
                $config['height']= 173;
                $config['new_image']= './assets/backend/images/member/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

	            $gambar=$gbr['file_name'];		
				$this->member_model->insert_member($nama,$link,$desc,$gambar);
				echo $this->session->set_flashdata('msg','success');
				redirect('backend/member');
			}else{
	            echo $this->session->set_flashdata('msg','error-img');
	            redirect('backend/member');
	    	}
	                 
	    }
	}

	function update(){
		$id=htmlspecialchars($this->input->post('member_id',TRUE),ENT_QUOTES);
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$link=htmlspecialchars($this->input->post('link',TRUE),ENT_QUOTES);
		$desc=htmlspecialchars($this->input->post('desc',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images/member'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    
    	if(!empty($_FILES['filefoto']['name'])){
	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/backend/images/member/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '70%';
                $config['width']= 400;
                $config['height']= 173;
                $config['new_image']= './assets/backend/images/member/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

	            $gambar=$gbr['file_name'];		
				$this->member_model->update_member($id,$nama,$link,$desc,$gambar);
				echo $this->session->set_flashdata('msg','info');
				redirect('backend/member');
			}else{
	            echo $this->session->set_flashdata('msg','error-img');
	            redirect('backend/member');
	    	}
	                 
	    }else{
	    	$this->member_model->update_member_noimg($id,$nama,$link,$desc);
			echo $this->session->set_flashdata('msg','info');
			redirect('backend/member');
	    }
	}


	function delete(){
		$member_id=$this->input->post('kode',TRUE);
		$this->member_model->delete_member($member_id);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('backend/member');
	}

}