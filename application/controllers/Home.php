<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['header'] = $this->load->view('layout/header', '', TRUE);
        $data['footer'] = $this->load->view('layout/footer', '', TRUE);
        $this->load->view('home_view', $data);
    }
}
