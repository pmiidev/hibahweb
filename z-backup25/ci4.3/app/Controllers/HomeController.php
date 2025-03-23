<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\TestimonialModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->testimonialModel = new TestimonialModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'testimonials' => $this->testimonialModel->findAll(),
            'validation' => \Config\Services::validation(),
            'title' => 'Home',
            'active' => 'Home'
        ];
        return view('home_view', $data);
    }
}
