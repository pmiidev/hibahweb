<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;

class DocumentController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Document',
            'active' => 'Document'
        ];
        return view('document_view', $data);
    }
}
