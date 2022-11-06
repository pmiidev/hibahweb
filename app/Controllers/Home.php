<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\CommentModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;
use App\Models\SubscribeModel;
use App\Models\TagModel;
use App\Models\TeamModel;
use App\Models\TestimonialModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->testimonialModel = new TestimonialModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        $this->teamModel = new TeamModel();
        $this->tagModel = new TagModel();
        $this->commentModel = new CommentModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'testimonials' => $this->testimonialModel->findAll(),
            'validation' => \Config\Services::validation(),
            'title' => 'Home'
        ];
        return view('home_view', $data);
    }
    function subscribe()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Inputan {field} harus email!'
                ]
            ]
        ])) {
            session()->setFlashdata('peringatan', 'Inputan harus berformat email. silakan coba lagi.');
            return redirect()->to('#footer');
        }

        $email = $this->request->getPost('email');
        $subscribeModel = new SubscribeModel();
        if ($subscribeModel->where('subscribe_email', $email)->countAllResults() < 1) {
            $subscribeModel->save([
                'subscribe_email' => $email,
                'subscribe_status' => 1,
                'subscribe_rating' => 0
            ]);
            session()->setFlashdata('pesan', 'Email berhasil didaftarkan. Terima Kasih.');
            return redirect()->to('#footer');
        } else {
            session()->setFlashdata('pesan', 'Email telah terdaftar sebelumnya. Terima Kasih.');
            return redirect()->to('#footer');
        }
    }
    function gallery()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'posts' => $this->postModel->findAll(),
            'title' => 'Gallery'
        ];
        return view('gallery_view', $data);
    }
    function team()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'teams' => $this->teamModel->findAll(),
            'title' => 'Team'
        ];
        return view('team_view', $data);
    }
    function post($slug = null)
    {
        if ($slug == null) {
            $data = [
                'site' => $this->siteModel->find(1),
                'home' => $this->homeModel->find(1),
                'about' => $this->aboutModel->find(1),
                'posts' => $this->postModel->findAll(),
                'title' => 'Post'
            ];
            return view('post_view', $data);
        } else {
            $post = $this->postModel->get_post_by_slug($slug)->getRowArray();
            $post_id = $post['post_id'];
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
                'tags' => $this->tagModel->findAll(),
                'comments' => $this->commentModel->show_comments($post_id)->getResultArray(),
                'title' => 'Post'
            ];
            return view('post_detail', $data);
        }
    }
    function send_comment()
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
            'comment_image' => 'avatar (5).png'
        ]);
        session()->setFlashdata('msg', '<div class="alert alert-info">Terima kasih atas respon Anda, komentar Anda akan tampil setelah moderasi</div>');
        return redirect()->back();
    }
}
