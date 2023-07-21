<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CommentModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;
use App\Models\TagModel;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        $this->tagModel = new TagModel();
        $this->commentModel = new CommentModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            $data = [
                'site' => $this->siteModel->find(1),
                'home' => $this->homeModel->find(1),
                'about' => $this->aboutModel->find(1),
                // 'posts' => $this->postModel->findAll(),
                'posts' => $this->postModel->paginate(3, 'posts'),
                'pager' => $this->postModel->pager,
                'title' => 'Post',
                'active' => 'Post'
            ];
            return view('post_view', $data);
        }
        if (!$this->postModel->get_post_by_slug($slug)->getRowArray()) {
            return redirect()->to('post');
        }
        $post = $this->postModel->get_post_by_slug($slug)->getRowArray();
        $post_tags = explode(',', $post['post_tags']);
        $post_id = $post['post_id'];
        $category_id = $post['category_id'];
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $cek_ip = $this->postModel->query("SELECT * FROM tbl_post_views WHERE view_ip='$user_ip' AND view_post_id='$post_id' AND DATE(view_date)=CURDATE()")->getNumRows();
        if ($cek_ip < 1) {
            $this->postModel->count_views($user_ip, $post_id);
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'post' => $post,
            'post_tags' => $post_tags,
            'related_post' => $this->postModel->get_related_post($category_id, $post_id)->getResultArray(),
            'tags' => $this->tagModel->findAll(),
            'comments' => $this->commentModel->show_comments($post_id)->getResultArray(),
            'title' => 'Post',
            'active' => 'Post'
        ];
        return view('post_detail', $data);
    }
    public function search()
    {
        $query = $this->request->getGet('search_query');
        if (!$query) {
            return redirect()->to('/post');
        }
        $result = $this->postModel->search_post($query);
        if ($result->getNumRows() < 1) {
            $posts = $result->getResultArray();
            $keyword = "Keyword '$query' tidak ditemukan";
        } else {
            $posts = $result->getResultArray();
            $keyword = "Keyword: $query ";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Search',
            'keyword' => $keyword,
            'posts' => $posts,
            'active' => 'Post'
        ];
        return view('post_search', $data);
    }
    public function send_comment()
    {
        if (!$this->validate([
            'post_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Inputan {field} harus angka!'
                ]
            ],
            'name' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'Inputan {field} harus huruf!',
                    'min_length[3]' => 'panjang karakter minimal 3 digit'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|min_length[3]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Inputan {field} harus email!',
                    'min_length[3]' => 'panjang karakter minimal 3 digit'
                ]
            ],
            'message' => [
                'rules' => 'required|alpha_numeric_punct|min_length[3]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_numeric_punct' => 'Inputan {field} tidak boleh aneh-aneh!',
                    'min_length[3]' => 'panjang karakter minimal 3 digit'
                ]
            ]
        ])) {
            session()->setFlashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
            return redirect()->back();
        }
        $this->commentModel->save([
            'comment_name' => htmlspecialchars($this->request->getPost('name')),
            'comment_email' => htmlspecialchars($this->request->getPost('email')),
            'comment_message' => htmlspecialchars($this->request->getPost('message')),
            'comment_post_id' => htmlspecialchars($this->request->getPost('post_id')),
            'comment_image' => 'user_blank.png'
        ]);
        session()->setFlashdata('msg', '<div class="alert alert-info">Terima kasih atas respon Anda, komentar Anda akan tampil setelah moderasi</div>');
        return redirect()->back();
    }
    public function tag($tag)
    {
        $posts = $this->tagModel->get_post_by_tags($tag);
        if ($posts->getNumRows() < 1) {
            $posts = $posts->getResultArray();
            $keyword = "Tag $tag tidak ditemukan";
        } else {
            $posts = $posts->getResultArray();
            $keyword = "Tag: $tag";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Tags',
            'keyword' => $keyword,
            'posts' => $posts,
            'active' => 'Post'
        ];
        return view('post_tag', $data);
    }
    public function author($user_id)
    {
        $posts = $this->postModel->where('post_user_id', $user_id)->get();
        if ($posts->getNumRows() < 1) {
            $posts = $posts->getResultArray();
            $keyword = "Postingan Author tidak ditemukan";
        } else {
            $posts = $posts->getResultArray();
            $keyword = "Author: $user_id";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => "Author $user_id",
            'keyword' => $keyword,
            'posts' => $posts,
            'active' => 'Post'
        ];
        return view('post_author', $data);
    }
}
