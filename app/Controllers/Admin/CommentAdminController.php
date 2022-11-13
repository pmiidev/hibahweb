<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;

class CommentAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Comments',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'comments' => $this->commentModel->get_all_comment()->getResultArray(),
            'total_all_comments' => $this->commentModel->countAllResults()
        ];

        return view('admin/v_comment', $data);
    }
    public function reply()
    {
        if (!$this->validate([
            'post_id' => ['rules' => 'required|numeric'],
            'comment_id' => ['rules' => 'required|numeric'],
            'comments' => ['rules' => 'required|min_length[3]']
        ])) {
            return redirect()->to('/admin/comment')->with('msg', 'not validated');
        }
        $post_id = htmlspecialchars($this->request->getPost('post_id'));
        $comment_id = htmlspecialchars($this->request->getPost('comment_id'));
        $comment = htmlspecialchars($this->request->getPost('comments'));
        $user_name = $this->akun['user_name'];
        $user_email = $this->akun['user_email'];
        $user_photo = $this->akun['user_photo'];
        $this->commentModel->save([
            'comment_name' => $user_name,
            'comment_email' => $user_email,
            'comment_message' => $comment,
            'comment_status' => 1,
            'comment_parent' => $comment_id,
            'comment_post_id' => $post_id,
            'comment_image' => $user_photo
        ]);
        return redirect()->to('/admin/comment')->with('msg', 'success');
    }
    public function publish()
    {
        $comment_id = htmlspecialchars($this->request->getPost('comment_id4'));
        $this->commentModel->update($comment_id, ['comment_status' => 1]);
        return redirect()->to('/admin/comment')->with('msg', 'success-publish');
    }
    public function edit()
    {
        if (!$this->validate([
            'comment_id2' => ['rules' => 'required|numeric'],
            'comments2' => ['rules' => 'required|min_length[3]']
        ])) {
            return redirect()->to('/admin/comment')->with('msg', 'not validated');
        }
        $comment_id2 = htmlspecialchars($this->request->getPost('comment_id2'));
        $comment = htmlspecialchars($this->request->getPost('comments2'));
        $this->commentModel->update($comment_id2, ['comment_message' => $comment]);
        return redirect()->to('/admin/comment')->with('msg', 'success-edit');
    }
    public function delete()
    {
        $comment_id = $this->request->getPost('comment_id3');
        $this->commentModel->delete($comment_id);
        return redirect()->to('/admin/comment')->with('msg', 'success-delete');
    }
    function unpublish()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Unpublish Comments',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'unpublish' => $this->commentModel->get_all_comment_unpublish()->getResultArray(),
            'total_all_comments' => $this->commentModel->countAllResults()
        ];

        return view('admin/v_comment_unpublish', $data);
    }
}
