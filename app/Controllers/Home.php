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
        $site = $this->siteModel->find(1);
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
        $data['logo'] = $site['site_logo_header'];
        $data['icon'] = $site['site_favicon'];

        $data['post_header'] = $this->homeModel->get_post_header();
        $data['post_header_2'] = $this->homeModel->get_post_header_2();
        $data['post_header_3'] = $this->homeModel->get_post_header_3();
        $data['latest_post'] = $this->homeModel->get_latest_post();
        $data['popular_post'] = $this->homeModel->get_popular_post();

        $home = $this->homeModel->find(1);
        $data['caption_1'] = $home['home_caption_1'];
        $data['caption_2'] = $home['home_caption_2'];
        $data['bg_header'] = $home['home_bg_heading'];
        $data['bg_testimoni'] = $home['home_bg_testimonial'];
        $data['bg_testimoni2'] = $home['home_bg_testimonial2'];

        $data['testimonial'] = $this->testimonialModel->findAll();

        $about = $this->aboutModel->find(1);
        $data['about_img'] = $about['about_image'];
        $data['about_desc'] = $about['about_description'];

        $data['header'] = view('layout/header', $data);
        $data['footer'] = view('layout/footer');
        return view('home_view', $data);
    }
}
