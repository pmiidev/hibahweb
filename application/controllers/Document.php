<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Visitor_model', 'visitor_model');
        $this->load->model('Site_model', 'site_model');
        $this->visitor_model->count_visitor();
        $this->load->helper('text');
        error_reporting(0);
    }
    function index()
    {
        $site = $this->site_model->get_site_data()->row_array();
        $data['title'] = "Document";
        $data['site_name'] = $site['site_name'];
        $data['site_title'] = $site['site_title'];
        $data['site_desc'] = $site['site_description'];
        $data['site_image'] = $site['site_logo_big'];
        $data['site_ig'] = $site['site_instagram'];
        $data['site_fb'] = $site['site_facebook'];
        $data['site_twit'] = $site['site_twitter'];
        $data['site_linked'] = $site['site_linkedin'];
        $data['site_wa'] = $site['site_wa'];
        $data['site_mail'] = $site['site_mail'];

        $site_info = $this->db->get('tbl_site', 1)->row();
        $data['logo'] =  $site_info->site_logo_header;
        $data['icon'] = $site_info->site_favicon;
        $data['header'] = $this->load->view('layout/header2', $data, TRUE);
        $data['footer'] = $this->load->view('layout/footer', '', TRUE);
        $this->load->view('document_view', $data);
    }

    function subscribe()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
            $base_url = site_url();
            redirect($base_url);
        } else {
            $email = $this->input->gallery('email', TRUE);
            $url = $this->input->gallery('url', TRUE);
            $checking_email = $this->home_model->checking_email($email);
            if ($checking_email->num_rows() > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-info">Terima kasih telah berlangganan.</div>');
                redirect($url);
            } else {
                $this->home_model->save_subcribe($email);
                $this->session->set_flashdata('msg', '<div class="alert alert-info">Terima kasih telah berlangganan.</div>');
                redirect($url);
            }
        }
    }
}
