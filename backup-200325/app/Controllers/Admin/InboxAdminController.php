<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use Inbox;

class InboxAdminController extends BaseController
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
            'title' => 'All Inbox',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'inbox_all' => $this->inboxModel->orderBy('inbox_status', 'ASC')->findAll(),
            'total_inboxs' => $this->inboxModel->get()->getNumRows()
        ];

        return view('admin/v_inbox', $data);
    }
    public function read($id)
    {
        $inbox = $this->inboxModel->find($id);
        if (is_null($inbox)) {
            return redirect()->to('admin/inbox')->with('msg', 'warning');
        }
        if ($inbox['inbox_status'] == 0) {
            $this->inboxModel->update($id, ['inbox_status' => 1]);
        }
        $data = [
            'akun' => $this->akun,
            'title' => 'Inbox Detail',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'inbox' => $this->inboxModel->find($id)
        ];

        return view('admin/v_inbox_detail', $data);
    }
    public function delete()
    {
        $inbox_id = $this->request->getPost('id');
        $this->inboxModel->delete($inbox_id);
        return redirect()->to('/admin/inbox')->with('msg', 'success-delete');
    }
}
