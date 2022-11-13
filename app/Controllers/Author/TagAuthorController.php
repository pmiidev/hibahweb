<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\TagModel;
use App\Models\CommentModel;

class TagAuthorController extends BaseController
{
    public function __construct()
    {
        $this->commentModel = new CommentModel();

        $this->tagModel = new TagModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Tag',
            'active' => $this->active,
            'total_comment' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getResultArray(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'tags' => $this->tagModel->findAll()
        ];

        return view('author/v_tag', $data);
    }
    public function save()
    {
        $tag = strip_tags(htmlspecialchars($this->request->getPost('tag'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $tag);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->tagModel->save([
            'tag_name' => $tag,
            'tag_slug' => $slug
        ]);

        return redirect()->to('author/tag')->with('msg', 'success');
    }
    public function edit()
    {
        $id          = $this->request->getPost('kode');
        $tag = strip_tags(htmlspecialchars($this->request->getPost('tag2'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $tag);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->tagModel->save([
            'tag_id' => $id,
            'tag_name' => $tag,
            'tag_slug' => $slug
        ]);
        return redirect()->to('author/tag')->with('msg', 'info');
    }
    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->tagModel->delete($id);

        return redirect()->to('author/tag')->with('msg', 'success-delete');
    }
}
