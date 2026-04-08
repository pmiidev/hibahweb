<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\TagModel;

class TagAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->tagModel = new TagModel();
    }

    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Tags',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'tags' => $this->tagModel->findAll(),
            'errors' => session('errors'),
        ];

        return view('admin/v_tag', $data);
    }

    public function save()
    {
        $tag = strip_tags(htmlspecialchars($this->request->getPost('tag'), ENT_QUOTES));

        $this->tagModel->save([
            'tag_name' => $tag,
        ]);

        return redirect()->to('admin/tag')->with('msg', 'success');
    }

    public function edit()
    {
        $id = $this->request->getPost('kode');
        $tag = strip_tags(htmlspecialchars($this->request->getPost('tag2'), ENT_QUOTES));

        $this->tagModel->save([
            'tag_id' => $id,
            'tag_name' => $tag,
        ]);

        return redirect()->to('admin/tag')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->tagModel->delete($id);

        return redirect()->to('admin/tag')->with('msg', 'success-delete');
    }
}
