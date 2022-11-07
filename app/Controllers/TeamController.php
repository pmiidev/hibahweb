<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;
use App\Models\TeamModel;

class TeamController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        $this->teamModel = new TeamModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'teams' => $this->teamModel->findAll(),
            'title' => 'Team'
        ];
        return view('team_view', $data);
    }
}
