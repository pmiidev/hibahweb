<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\UserModel;

class UsersAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Users',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'users' => $this->userModel->findAll()
        ];

        return view('admin/v_users', $data);
    }
    public function insert()
    {
        // Validasi Email
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.user_email]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'inputan harus berformat email',
                    'is_unique' => 'Email sudah terdaftar sebelumnya'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error-email');
        };
        // Validasi password
        if (!$this->validate([
            'password' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'matches' => 'password konfirmasi tidak sama'
                ]
            ],
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error');
        };
        // Validasi foto
        if (!$this->validate([
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error-img');
        };
        // Validasi inputan lainnya
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'level' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Inputan harus berformat angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/users/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }
        $nama = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $email = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
        $pass = htmlspecialchars($this->request->getPost('password'), ENT_QUOTES);
        $level = htmlspecialchars($this->request->getPost('level'), ENT_QUOTES);

        $this->userModel->save([
            'user_name' => $nama,
            'user_email' => $email,
            'user_password' => password_hash($pass, PASSWORD_DEFAULT),
            'user_level' => $level,
            'user_status' => 1,
            'user_photo' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/users')->with('msg', 'success');
    }
    public function update()
    {
        // Validasi Email
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[tbl_user.user_email]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'inputan harus berformat email',
                    'is_not_unique' => 'Email tidak ditemukan'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error-email');
        };
        // Validasi foto
        if (!$this->validate([
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error-img');
        };
        // Validasi inputan lainnya
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'level' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Inputan harus berformat angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error');
        }
        $user_id = htmlspecialchars($this->request->getPost('user_id'), ENT_QUOTES);
        $nama = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $email = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
        $level = htmlspecialchars($this->request->getPost('level'), ENT_QUOTES);
        // Cek Foto
        $user = $this->userModel->find($user_id);
        $fotoAwal = $user['user_photo'];
        $fileFoto = $this->request->getFile('filefoto');
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/users/', $namaFotoUpload);
        }

        if ($this->request->getPost('password')) {
            $this->userModel->update($user_id, [
                'user_name' => $nama,
                'user_email' => $email,
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'user_level' => $level,
                'user_photo' => $namaFotoUpload
            ]);
        } else {
            $this->userModel->update($user_id, [
                'user_name' => $nama,
                'user_email' => $email,
                'user_level' => $level,
                'user_photo' => $namaFotoUpload
            ]);
        }
        return redirect()->to('/admin/users')->with('msg', 'info');
    }
    public function delete()
    {
        $user_id = $this->request->getPost('kode');
        $this->userModel->delete($user_id);
        return redirect()->to('/admin/users')->with('msg', 'success-delete');
    }
    public function activate($user_id)
    {
        $this->userModel->update($user_id, ['user_status' => 1]);
        return redirect()->to('/admin/users')->with('msg', 'success-activate');
    }
    public function deactivate($user_id)
    {
        $this->userModel->update($user_id, ['user_status' => 0]);
        return redirect()->to('/admin/users')->with('msg', 'success-deactivate');
    }
}
