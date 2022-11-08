<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CategoryModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/post');
        }
        $posts = $this->categoryModel->get_post_by_category($slug);
        if ($posts->getNumRows() < 1) {
            $posts = $posts->getResultArray();
            $keyword = "Category '$slug' tidak ditemukan";
        } else {
            $posts = $posts->getResultArray();
            $keyword = "Category: $slug ";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Category',
            'keyword' => $keyword,
            'posts' => $posts,
            'active' => 'Post'
        ];
        return view('post_category', $data);
    }
}
