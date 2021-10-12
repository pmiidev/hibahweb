<?php

class Testimonial extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Testimonial_model','testimonial_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}

	function index(){
		$x['data'] = $this->testimonial_model->get_testimonial();
		$this->load->view('backend/v_testimonial',$x);
	}

	function insert(){
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$jabatan=htmlspecialchars($this->input->post('jabatan',TRUE),ENT_QUOTES);
		$content=htmlspecialchars($this->input->post('content',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images/testi'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    
    	if(!empty($_FILES['filefoto']['name'])){
	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/backend/images/testi/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '60%';
                $config['width']= 100;
                $config['height']= 100;
                $config['new_image']= './assets/backend/images/testi/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

	            $gambar=$gbr['file_name'];		
				$this->testimonial_model->insert_testimonial($nama,$jabatan,$content,$gambar);
				echo $this->session->set_flashdata('msg','success');
				redirect('backend/testimonial');
			}else{
	            echo $this->session->set_flashdata('msg','error-img');
	            redirect('backend/testimonial');
	    	}
	                 
	    }
	}

	function update(){
		$id=htmlspecialchars($this->input->post('testimonial_id',TRUE),ENT_QUOTES);
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$jabatan=htmlspecialchars($this->input->post('jabatan',TRUE),ENT_QUOTES);
		$content=htmlspecialchars($this->input->post('content',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images/testi'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    
    	if(!empty($_FILES['filefoto']['name'])){
	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/backend/images/testi/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '60%';
                $config['width']= 100;
                $config['height']= 100;
                $config['new_image']= './assets/backend/images/testi/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

	            $gambar=$gbr['file_name'];		
				$this->testimonial_model->update_testimonial($id,$nama,$jabatan,$content,$gambar);
				echo $this->session->set_flashdata('msg','info');
				redirect('backend/testimonial');
			}else{
	            echo $this->session->set_flashdata('msg','error-img');
	            redirect('backend/testimonial');
	    	}
	                 
	    }else{
	    	$this->testimonial_model->update_testimonial_noimg($id,$nama,$jabatan,$content);
			echo $this->session->set_flashdata('msg','info');
			redirect('backend/testimonial');
	    }
	}


	function delete(){
		$testimonial_id=$this->input->post('kode',TRUE);
		$this->testimonial_model->delete_testimonial($testimonial_id);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('backend/testimonial');
	}

}