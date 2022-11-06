<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\TestimonialModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->testimonialModel = new TestimonialModel();
        $this->aboutModel = new AboutModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'testimonial' => $this->testimonialModel->findAll(),
            'about' => $this->aboutModel->find(1)
        ];
        return view('home_view', $data);
    }
}
