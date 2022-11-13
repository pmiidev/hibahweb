<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class CategoryAuthorController extends BaseController
{
    public function __construct()
    {
        $this->commentModel = new CommentModel();

        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Category',
            'active' => $this->active,
            'total_comment' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getResultArray(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->categoryModel->findAll()
        ];

        return view('author/v_category', $data);
    }
    public function save()
    {
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->categoryModel->save([
            'category_name' => $category,
            'category_slug' => $slug
        ]);

        return redirect()->to('author/category')->with('msg', 'success');
    }
    public function edit()
    {
        $id          = $this->request->getPost('kode');
        $category = strip_tags(htmlspecialchars($this->request->getPost('category2'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->categoryModel->save([
            'category_id' => $id,
            'category_name' => $category,
            'category_slug' => $slug
        ]);
        return redirect()->to('author/category')->with('msg', 'info');
    }
    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->categoryModel->delete($id);

        return redirect()->to('author/category')->with('msg', 'success-delete');
    }
}
