<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PostModel;
use App\Models\TagModel;
use App\Models\VisitorModel;

class PostAdminController extends BaseController
{
    public function __construct()
    {
        $this->visitorModel = new VisitorModel();
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(5),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),

            'posts' => $this->postModel->get_all_post()->getResultArray()
        ];

        return view('admin/v_post', $data);
    }
    function delete()
    {
        $post_id = $this->request->getPost('id');
        $this->postModel->delete($post_id);
        return redirect()->to('/admin/post')->with('msg', 'success-delete');
    }
}
