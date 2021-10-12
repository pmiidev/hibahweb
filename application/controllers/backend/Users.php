<?php
class Users extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('backend/Users_model','users_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}

	function index(){
		$x['data']=$this->users_model->get_users();
		$this->load->view('backend/v_users',$x);
		$this->load->helper('text');
	}

	function insert(){
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
		$pass=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		$pass2=htmlspecialchars($this->input->post('password2',TRUE),ENT_QUOTES);
		$level=htmlspecialchars($this->input->post('level',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    $cek_email = $this->users_model->validasi_email($email);
	    if($cek_email->num_rows() > 0){
	    	echo $this->session->set_flashdata('msg','error-email');
			redirect('backend/users');
	    }else{
	    	if($pass == $pass2){
		    	if(!empty($_FILES['filefoto']['name'])){
			        if ($this->upload->do_upload('filefoto')){
			            $gbr = $this->upload->data();
		                //Compress Image
		                $config['image_library']='gd2';
		                $config['source_image']='./assets/backend/images/'.$gbr['file_name'];
		                $config['create_thumb']= FALSE;
		                $config['maintain_ratio']= FALSE;
		                $config['quality']= '60%';
		                $config['width']= 100;
		                $config['height']= 100;
		                $config['new_image']= './assets/backend/images/'.$gbr['file_name'];
		                $this->load->library('image_lib', $config);
		                $this->image_lib->resize();

			            $gambar=$gbr['file_name'];		
						$this->users_model->insert_user($nama,$email,$pass,$level,$gambar);
						echo $this->session->set_flashdata('msg','success');
						redirect('backend/users');
					}else{
			            echo $this->session->set_flashdata('msg','error-img');
			            redirect('backend/users');
			    	}
			                 
			    }else{
					$this->users_model->insert_user_noimg($nama,$email,$pass,$level);
					echo $this->session->set_flashdata('msg','success');
					redirect('backend/users');
				}
		    }else{
		    	echo $this->session->set_flashdata('msg','error');
				redirect('backend/users');
		    }
	    }
		    
	}

	function update(){
		$userid=$this->input->post('user_id',TRUE);
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
		$pass=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		$pass2=htmlspecialchars($this->input->post('password2',TRUE),ENT_QUOTES);
		$level=htmlspecialchars($this->input->post('level',TRUE),ENT_QUOTES);
		
		$config['upload_path'] = './assets/backend/images'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    $cek_email = $this->users_model->validasi_email($email);
	    if($cek_email->num_rows() > 0){
	    	$row = $cek_email->row();
	    	$user_id = $row->user_id;
	    	if($user_id <> $userid){
	    		echo $this->session->set_flashdata('msg','error-email');
				redirect('backend/users');
	    	}else{
			    if(empty($pass) || empty($pass2)){
			    	if(!empty($_FILES['filefoto']['name'])){
				        if ($this->upload->do_upload('filefoto')){
				            $gbr = $this->upload->data();
			                //Compress Image
			                $config['image_library']='gd2';
			                $config['source_image']='./assets/backend/images/'.$gbr['file_name'];
			                $config['create_thumb']= FALSE;
			                $config['maintain_ratio']= FALSE;
			                $config['quality']= '60%';
			                $config['width']= 100;
			                $config['height']= 100;
			                $config['new_image']= './assets/backend/images/'.$gbr['file_name'];
			                $this->load->library('image_lib', $config);
			                $this->image_lib->resize();

				            $gambar=$gbr['file_name'];		
							$this->users_model->update_user_nopass($userid,$nama,$email,$level,$gambar);
							echo $this->session->set_flashdata('msg','info');
							redirect('backend/users');
						}else{
				            echo $this->session->set_flashdata('msg','error-img');
				            redirect('backend/users');
				    	}
				                 
				    }else{
						$this->users_model->update_user_nopassimg($userid,$nama,$email,$level);
						echo $this->session->set_flashdata('msg','info');
						redirect('backend/users');
					}
			    }else{
			    	if($pass == $pass2){
				    	if(!empty($_FILES['filefoto']['name'])){
					        if ($this->upload->do_upload('filefoto')){
					            $gbr = $this->upload->data();
				                //Compress Image
				                $config['image_library']='gd2';
				                $config['source_image']='./assets/backend/images/'.$gbr['file_name'];
				                $config['create_thumb']= FALSE;
				                $config['maintain_ratio']= FALSE;
				                $config['quality']= '60%';
				                $config['width']= 100;
				                $config['height']= 100;
				                $config['new_image']= './assets/backend/images/'.$gbr['file_name'];
				                $this->load->library('image_lib', $config);
				                $this->image_lib->resize();

					            $gambar=$gbr['file_name'];		
								$this->users_model->update_user($userid,$nama,$email,$pass,$level,$gambar);
								echo $this->session->set_flashdata('msg','info');
								redirect('backend/users');
							}else{
					            echo $this->session->set_flashdata('msg','error-img');
					            redirect('backend/users');
					    	}
					                 
					    }else{
							$this->users_model->update_user_noimg($userid,$nama,$email,$pass,$level);
							echo $this->session->set_flashdata('msg','info');
							redirect('backend/users');
						}
				    }else{
				    	echo $this->session->set_flashdata('msg','error');
						redirect('backend/users');
				    }
			    }
			}
	    	
	    }else{
		    if(empty($pass) || empty($pass2)){
		    	if(!empty($_FILES['filefoto']['name'])){
			        if ($this->upload->do_upload('filefoto')){
			            $gbr = $this->upload->data();
		                //Compress Image
		                $config['image_library']='gd2';
		                $config['source_image']='./assets/backend/images/'.$gbr['file_name'];
		                $config['create_thumb']= FALSE;
		                $config['maintain_ratio']= FALSE;
		                $config['quality']= '60%';
		                $config['width']= 100;
		                $config['height']= 100;
		                $config['new_image']= './assets/backend/images/'.$gbr['file_name'];
		                $this->load->library('image_lib', $config);
		                $this->image_lib->resize();

			            $gambar=$gbr['file_name'];		
						$this->users_model->update_user_nopass($userid,$nama,$email,$level,$gambar);
						echo $this->session->set_flashdata('msg','info');
						redirect('backend/users');
					}else{
			            echo $this->session->set_flashdata('msg','error-img');
			            redirect('backend/users');
			    	}
			                 
			    }else{
					$this->users_model->update_user_nopassimg($userid,$nama,$email,$level);
					echo $this->session->set_flashdata('msg','info');
					redirect('backend/users');
				}
		    }else{
		    	if($pass == $pass2){
			    	if(!empty($_FILES['filefoto']['name'])){
				        if ($this->upload->do_upload('filefoto')){
				            $gbr = $this->upload->data();
			                //Compress Image
			                $config['image_library']='gd2';
			                $config['source_image']='./assets/backend/images/'.$gbr['file_name'];
			                $config['create_thumb']= FALSE;
			                $config['maintain_ratio']= FALSE;
			                $config['quality']= '60%';
			                $config['width']= 100;
			                $config['height']= 100;
			                $config['new_image']= './assets/backend/images/'.$gbr['file_name'];
			                $this->load->library('image_lib', $config);
			                $this->image_lib->resize();

				            $gambar=$gbr['file_name'];		
							$this->users_model->update_user($userid,$nama,$email,$pass,$level,$gambar);
							echo $this->session->set_flashdata('msg','info');
							redirect('backend/users');
						}else{
				            echo $this->session->set_flashdata('msg','error-img');
				            redirect('backend/users');
				    	}
				                 
				    }else{
						$this->users_model->update_user_noimg($userid,$nama,$email,$pass,$level);
						echo $this->session->set_flashdata('msg','info');
						redirect('backend/users');
					}
			    }else{
			    	echo $this->session->set_flashdata('msg','error');
					redirect('backend/users');
			    }
		    }
		}

	}

	function lock(){
		$user_id=$this->uri->segment(4);
		$this->users_model->lock_user($user_id);
		redirect('backend/users');
	}

	function unlock(){
		$user_id=$this->uri->segment(4);
		$this->users_model->unlock_user($user_id);
		redirect('backend/users');
	}

	function delete(){
		$userid=$this->input->post('kode',TRUE);
		$this->users_model->delete_user($userid);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('backend/users');
	}


}