<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class CategoryAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Category',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->categoryModel->findAll()
        ];

        return view('admin/v_category', $data);
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

        return redirect()->to('admin/category')->with('msg', 'success');
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
        return redirect()->to('admin/category')->with('msg', 'info');
    }
    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->categoryModel->delete($id);

        return redirect()->to('admin/category')->with('msg', 'success-delete');
    }
}
