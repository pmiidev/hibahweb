<?php

class Team extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Team_model','team_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}

	function index(){
		$x['data'] = $this->team_model->get_team();
		$this->load->view('backend/v_team',$x);
	}

	function insert(){
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$jabatan=htmlspecialchars($this->input->post('jabatan',TRUE),ENT_QUOTES);
		$content=htmlspecialchars($this->input->post('content',TRUE),ENT_QUOTES);
        $twitter=htmlspecialchars($this->input->post('twitter',TRUE),ENT_QUOTES);
        $facebook=htmlspecialchars($this->input->post('facebook',TRUE),ENT_QUOTES);
        $instagram=htmlspecialchars($this->input->post('instagram',TRUE),ENT_QUOTES);
        $linked=htmlspecialchars($this->input->post('linked',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images/team'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    
    	if(!empty($_FILES['filefoto']['name'])){
	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/backend/images/team/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '80%';
                $config['width']= 600;
                $config['height']= 600;
                $config['new_image']= './assets/backend/images/team/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

	            $gambar=$gbr['file_name'];		
				$this->team_model->insert_team($nama,$jabatan,$content,$gambar,$twitter,$facebook,$instagram,$linked);
				echo $this->session->set_flashdata('msg','success');
				redirect('backend/team');
			}else{
	            echo $this->session->set_flashdata('msg','error-img');
	            redirect('backend/team');
	    	}
	                 
	    }
	}

	function update(){
		$id=htmlspecialchars($this->input->post('team_id',TRUE),ENT_QUOTES);
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$jabatan=htmlspecialchars($this->input->post('jabatan',TRUE),ENT_QUOTES);
		$content=htmlspecialchars($this->input->post('content',TRUE),ENT_QUOTES);
        $twitter=htmlspecialchars($this->input->post('twitter',TRUE),ENT_QUOTES);
        $facebook=htmlspecialchars($this->input->post('facebook',TRUE),ENT_QUOTES);
        $instagram=htmlspecialchars($this->input->post('instagram',TRUE),ENT_QUOTES);
        $linked=htmlspecialchars($this->input->post('linked',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images/team'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    
    	if(!empty($_FILES['filefoto']['name'])){
	        if ($this->upload->do_upload('filefoto')){
	            $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/backend/images/team/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '80%';
                $config['width']= 600;
                $config['height']= 600;
                $config['new_image']= './assets/backend/images/team/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

	            $gambar=$gbr['file_name'];		
				$this->team_model->update_team($id,$nama,$jabatan,$content,$gambar,$twitter,$facebook,$instagram,$linked);
				echo $this->session->set_flashdata('msg','info');
				redirect('backend/team');
			}else{
	            echo $this->session->set_flashdata('msg','error-img');
	            redirect('backend/team');
	    	}
	                 
	    }else{
	    	$this->team_model->update_team_noimg($id,$nama,$jabatan,$content,$twitter,$facebook,$instagram,$linked);
			echo $this->session->set_flashdata('msg','info');
			redirect('backend/team');
	    }
	}


	function delete(){
		$team_id=$this->input->post('kode',TRUE);
		$this->team_model->delete_team($team_id);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('backend/team');
	}

}