<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\SubscribeModel;

class SubscriberAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->subscribeModel = new SubscribeModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Subscriber',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(5),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),

            'subscribers' => $this->subscribeModel->findAll()
        ];

        return view('admin/v_subscriber', $data);
    }
    public function increase(Int $id)
    {
        $data = $this->subscribeModel->find($id);
        $rating = $data['subscribe_rating'];
        $result = $rating + 1;
        $this->subscribeModel->update($id, ['subscribe_rating' => $result]);
        return redirect()->to('admin/subscriber')->with('msg', 'success-increase');
    }
    public function decrease(Int $id)
    {
        $data = $this->subscribeModel->find($id);
        $rating = $data['subscribe_rating'];
        $result = $rating - 1;
        $this->subscribeModel->update($id, ['subscribe_rating' => $result]);
        return redirect()->to('admin/subscriber')->with('msg', 'success-decrease');
    }
    public function delete()
    {
        $this->subscribeModel->delete($this->request->getPost('id'));

        return redirect()->to('admin/subscriber')->with('msg', 'success-delete');
    }
}
