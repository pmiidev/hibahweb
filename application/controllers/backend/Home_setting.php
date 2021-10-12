<?php

class Home_setting extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/Setting_model', 'setting_model');
		$this->load->library('upload');
		$this->load->helper('text');
	}

	function index()
	{
		$data = $this->setting_model->get_home_data()->row();
		$x['home_id'] = $data->home_id;
		$x['caption_1'] = $data->home_caption_1;
		$x['caption_2'] = $data->home_caption_2;
		$x['image_heading'] = $data->home_bg_heading;
		$x['image_testimonial'] = $data->home_bg_testimonial;
		$x['image_testimonial2'] = $data->home_bg_testimonial2;
		$this->load->view('backend/v_home_setting', $x);
	}

	function update()
	{
		$home_id = htmlspecialchars($this->input->post('home_id', TRUE), ENT_QUOTES);
		$caption1 = htmlspecialchars($this->input->post('caption1', TRUE), ENT_QUOTES);
		$caption2 = htmlspecialchars($this->input->post('caption2', TRUE), ENT_QUOTES);

		$config['upload_path'] = './assets/frontend/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = FALSE;

		$this->upload->initialize($config);
		if (!empty($_FILES['img_heading']['name']) && !empty($_FILES['img_testimonial']['name'])) {
			if ($this->upload->do_upload('img_heading')) {
				$img_heading = $this->upload->data();
				$bg_heading = $img_heading['file_name'];
			}
			if ($this->upload->do_upload('img_testimonial')) {
				$img_testimoni = $this->upload->data();
				$bg_testimoni = $img_testimoni['file_name'];
			}
			$this->setting_model->update_information($home_id, $caption1, $caption2, $bg_heading, $bg_testimoni, $bg_testimoni2);
			$this->session->set_flashdata('msg', 'success');
			redirect('backend/home_setting');
		} elseif (!empty($_FILES['img_heading']['name']) && empty($_FILES['img_testimonial']['name']) && empty($_FILES['img_testimonial2']['name'])) {
			if ($this->upload->do_upload('img_heading')) {
				$img_heading = $this->upload->data();
				$bg_heading = $img_heading['file_name'];
			}
			$this->setting_model->update_information_heading($home_id, $caption1, $caption2, $bg_heading);
			$this->session->set_flashdata('msg', 'success');
			redirect('backend/home_setting');
		} elseif (empty($_FILES['img_heading']['name']) && !empty($_FILES['img_testimonial']['name']) && empty($_FILES['img_testimonial2']['name'])) {
			if ($this->upload->do_upload('img_testimonial')) {
				$img_testimoni = $this->upload->data();
				$bg_testimoni = $img_testimoni['file_name'];
			}
			$this->setting_model->update_information_testimoni($home_id, $caption1, $caption2, $bg_testimoni);
			$this->session->set_flashdata('msg', 'success');
			redirect('backend/home_setting');
		} elseif (empty($_FILES['img_heading']['name']) && empty($_FILES['img_testimonial']['name']) && !empty($_FILES['img_testimonial2']['name'])) {
			if ($this->upload->do_upload('img_testimonial2')) {
				$img_testimoni2 = $this->upload->data();
				$bg_testimoni2 = $img_testimoni2['file_name'];
			}
			$this->setting_model->update_information_testimoni2($home_id, $caption1, $caption2, $bg_testimoni2);
			$this->session->set_flashdata('msg', 'success');
			redirect('backend/home_setting');
		} else {
			$this->setting_model->update_information_noimg($home_id, $caption1, $caption2);
			$this->session->set_flashdata('msg', 'success');
			redirect('backend/home_setting');
		}
	}
}
