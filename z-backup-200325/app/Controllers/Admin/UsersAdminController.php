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
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'password2' => $this->request->getPost('password2'),
            'nama' => htmlspecialchars(strip_tags($this->request->getPost('nama')), ENT_QUOTES),
            'level' => htmlspecialchars(strip_tags($this->request->getPost('level')), ENT_QUOTES),
            'filefoto' => $this->request->getFile('filefoto')
        ];
        $rules = [
            'email' => 'required|valid_email|is_unique[tbl_user.user_email]',
            'password' => 'required|matches[password2]',
            'password2' => 'required|matches[password]',
            'nama' => 'required|alpha_space',
            'level' => 'required|numeric',
            'filefoto' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]'
        ];
        // Validasi Email
        if (!$this->validateData($data, $rules)) {
            $msg = '';
            if ($this->validator->hasError('email')) {
                $msg = 'error-email';
            } elseif ($this->validator->hasError('password')) {
                $msg = 'error';
            } elseif ($this->validator->hasError('filefoto')) {
                $msg = 'error-img';
            } else {
                $msg = 'error';
            }
            return redirect()->to('/admin/users')->with('msg', $msg);
        };
        $validData = $this->validator->getValidated();
        $email = $validData['email'];
        $password = $validData['password'];
        $nama = $validData['nama'];
        $level = $validData['level'];
        $filefoto = $validData['filefoto'];
        // Cek foto
        if ($filefoto->isValid()) {
            // Ambil File foto
            $namaFotoUpload = $filefoto->getRandomName();
            $filefoto->move('assets/backend/images/users/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }

        $this->userModel->save([
            'user_name' => $nama,
            'user_email' => $email,
            'user_password' => password_hash($password, PASSWORD_DEFAULT),
            'user_level' => $level,
            'user_status' => 1,
            'user_photo' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/users')->with('msg', 'success');
    }
    public function update()
    {
        $user_id = htmlspecialchars(strip_tags($this->request->getPost('user_id')), ENT_QUOTES);
        $data = [
            'user_id' => $user_id,
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nama' => htmlspecialchars(strip_tags($this->request->getPost('nama')), ENT_QUOTES),
            'level' => htmlspecialchars(strip_tags($this->request->getPost('level')), ENT_QUOTES),
            'filefoto' => $this->request->getFile('filefoto')
        ];
        $rules = [
            'user_id' => 'required|is_natural_no_zero|numeric',
            'email' => "required|valid_email|is_unique[tbl_user.user_email,user_id,{$user_id}]",
            'password' => 'permit_empty',
            'nama' => 'required|alpha_space',
            'level' => 'required|numeric',
            'filefoto' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]'
        ];
        // Validasi Email
        if (!$this->validateData($data, $rules)) {
            $msg = '';
            if ($this->validator->hasError('email')) {
                $msg = 'error-email';
            } elseif ($this->validator->hasError('password')) {
                $msg = 'error';
            } elseif ($this->validator->hasError('filefoto')) {
                $msg = 'error-img';
            } else {
                $msg = 'error';
            }
            return redirect()->to('/admin/users')->with('msg', $msg);
        };
        $validData = $this->validator->getValidated();
        $user_id = $validData['user_id'];
        $email = $validData['email'];
        $password = $validData['password'];
        $nama = $validData['nama'];
        $level = $validData['level'];
        $fileFoto = $validData['filefoto'];
        // Cek Foto
        $user = $this->userModel->find($user_id);
        $fotoAwal = $user['user_photo'];
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/users/', $namaFotoUpload);
        }

        if ($password) {
            $this->userModel->update($user_id, [
                'user_name' => $nama,
                'user_email' => $email,
                'user_password' => password_hash($password, PASSWORD_DEFAULT),
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
