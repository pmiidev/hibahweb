<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PostModel;
use App\Models\TagModel;

class PostAdminController extends BaseController
{
    public function __construct()
    {
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
            'title' => 'All Posts',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'posts' => $this->postModel->get_all_post(),
        ];

        return view('admin/v_post', $data);
    }

    public function add_new()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Add New Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(5),
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
        ];

        return view('admin/v_add_post', $data);
    }

    public function publish()
    {
        $payload = [
            'title' => htmlspecialchars(strip_tags($this->request->getPost('title')), ENT_QUOTES),
            'slug' => htmlspecialchars(strip_tags($this->request->getPost('slug')), ENT_QUOTES),
            'contents' => $this->request->getPost('contents'),
            'filefoto' => $this->request->getFile('filefoto'),
            'category' => htmlspecialchars(strip_tags($this->request->getPost('category')), ENT_QUOTES),
            'tag' => $this->request->getPost('tag'),
            'description' => htmlspecialchars(strip_tags($this->request->getPost('description')), ENT_QUOTES),
        ];

        $rules = [
            'title' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_numeric_space' => 'Input tidak boleh mengandung karakter aneh',
                ],
            ],
            'slug' => [
                'rules' => 'required|alpha_dash',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'Input harus berupa alphabet dan strip',
                ],
            ],
            'contents' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                ],
            ],
            'filefoto' => [
                'rules' => 'permit_empty|max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ],
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Input harus angka',
                ],
            ],
            'tag' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                ],
            ],
        ];

        if (!$this->validateData($payload, $rules)) {
            return redirect()->to('/admin/post/add_new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoUpload = $payload['filefoto'];
        if ($fotoUpload && $fotoUpload->isValid() && !$fotoUpload->hasMoved()) {
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/lte4/img/posts/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'default-post.png';
        }

        $slug = $payload['slug'];
        if ($this->postModel->where('post_slug', $slug)->countAllResults() > 0) {
            $slug = $slug . '-' . rand(1, 999);
        }

        $tagInput = $payload['tag'];
        $tags = is_array($tagInput) ? implode(',', $tagInput) : $tagInput;

        $this->postModel->save([
            'post_title' => $payload['title'],
            'post_description' => $payload['description'],
            'post_contents' => $payload['contents'],
            'post_image' => $namaFotoUpload,
            'post_category_id' => $payload['category'],
            'post_tags' => $tags,
            'post_slug' => $slug,
            'post_status' => 1,
            'post_views' => 0,
            'post_user_id' => session('id'),
        ]);

        return redirect()->to('/admin/post')->with('msg', 'success');
    }

    public function edit($id)
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            return redirect()->to('/admin/post')->with('msg', 'success-delete');
        }

        $post_tags = explode(',', $post['post_tags']);
        $data = [
            'akun' => $this->akun,
            'title' => 'Edit Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
            'post' => $post,
            'post_tags' => $post_tags,
        ];

        return view('admin/v_edit_post', $data);
    }

    public function update()
    {
        $payload = [
            'post_id' => $this->request->getPost('post_id'),
            'title' => htmlspecialchars(strip_tags($this->request->getPost('title'), ENT_QUOTES)),
            'slug' => htmlspecialchars(strip_tags($this->request->getPost('slug'), ENT_QUOTES)),
            'contents' => $this->request->getPost('contents'),
            'filefoto' => $this->request->getFile('filefoto'),
            'category' => htmlspecialchars(strip_tags($this->request->getPost('category'), ENT_QUOTES)),
            'tag' => $this->request->getPost('tag'),
            'description' => htmlspecialchars(strip_tags($this->request->getPost('description'), ENT_QUOTES)),
        ];

        $rules = [
            'post_id' => [
                'rules' => 'required|is_natural_no_zero|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'is_natural_no_zero' => 'Input harus angka dan tidak boleh nol atau negatif',
                    'numeric' => 'Input harus angka',
                ],
            ],
            'title' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_numeric_space' => 'Input tidak boleh mengandung karakter aneh',
                ],
            ],
            'slug' => [
                'rules' => 'required|alpha_dash',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'Input harus berupa alphabet dan strip',
                ],
            ],
            'contents' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                ],
            ],
            'filefoto' => [
                'rules' => 'permit_empty|max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ],
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Input harus angka',
                ],
            ],
            'tag' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                ],
            ],
            'description' => [
                'rules' => 'permit_empty',
            ],
        ];

        if (!$this->validateData($payload, $rules)) {
            return redirect()->to("/admin/post/{$payload['post_id']}/edit")->withInput()->with('errors', $this->validator->getErrors());
        }

        $post_id = $payload['post_id'];
        $slug = $payload['slug'];
        if ($this->postModel->where('post_slug', $slug)->where('post_id !=', $post_id)->countAllResults() > 0) {
            $slug = $slug . '-' . rand(1, 999);
        }

        $tagInput = $payload['tag'];
        $tags = is_array($tagInput) ? implode(',', $tagInput) : $tagInput;

        $postAwal = $this->postModel->find($post_id);
        $namaFotoUpload = $postAwal['post_image'];
        $fileFoto = $payload['filefoto'];
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            if ($namaFotoUpload !== 'default-post.png' && file_exists('assets/lte4/img/posts/' . $namaFotoUpload)) {
                unlink('assets/lte4/img/posts/' . $namaFotoUpload);
            }
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/lte4/img/posts/', $namaFotoUpload);
        }

        $this->postModel->save([
            'post_id' => $post_id,
            'post_title' => $payload['title'],
            'post_description' => $payload['description'],
            'post_contents' => $payload['contents'],
            'post_image' => $namaFotoUpload,
            'post_category_id' => $payload['category'],
            'post_tags' => $tags,
            'post_slug' => $slug,
            'post_status' => 1,
            'post_user_id' => session('id'),
        ]);

        return redirect()->to('/admin/post')->with('msg', 'info');
    }

    public function delete()
    {
        $post_id = $this->request->getPost('id');
        $post = $this->postModel->find($post_id);
        if ($post && $post['post_image'] !== 'default-post.png' && file_exists('assets/lte4/img/posts/' . $post['post_image'])) {
            unlink('assets/lte4/img/posts/' . $post['post_image']);
        }
        $this->postModel->delete($post_id);

        return redirect()->to('/admin/post')->with('msg', 'success-delete');
    }

    public function upload_image()
    {
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('assets/lte4/img/posts/', $newName);
            $url = base_url('assets/lte4/img/posts/' . $newName);
            return $this->response->setJSON(['url' => $url]);
        }
        return $this->response->setJSON(['error' => 'Upload failed']);
    }
}
