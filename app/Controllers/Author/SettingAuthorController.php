<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CommentModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\UserModel;

class SettingAuthorController extends BaseController
{
    public function __construct()
    {
        $this->commentModel = new CommentModel();

        $this->userModel = new UserModel();
    }
    public function profile()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Profile Setting',
            'active' => $this->active,
            'total_comment' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getResultArray(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
        ];

        return view('author/v_setting-profile', $data);
    }
    public function profile_password()
    {
        // Validasi
        if (!$this->validate([
            'new_password' => [
                'rules' => 'required|matches[conf_password]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'matches' => 'Konfirmasi password tidak sesuai'
                ]
            ],
            'conf_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'matches' => 'Konfirmasi password tidak sesuai'
                ]
            ]
        ])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notmatch');
        }
        $old_password = strip_tags(htmlspecialchars($this->request->getPost('old_password'), ENT_QUOTES));
        $conf_password = strip_tags(htmlspecialchars($this->request->getPost('conf_password'), ENT_QUOTES));
        if (!password_verify($old_password, $this->akun['user_password'])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notfound');
        }
        // Save ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_password' => password_hash($conf_password, PASSWORD_DEFAULT)
        ]);
        return redirect()->to("/author/setting/profile")->with('msg', 'success');
    }
    public function profile_update()
    {
        // Validasi
        if (!$this->validate([
            'user_name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'user_email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Iputan harus email'
                ]
            ],
            'user_photo' => [
                'rules' => 'max_size[user_photo,2048]|is_image[user_photo]|mime_in[user_photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error');
        }
        $user_name = strip_tags(htmlspecialchars($this->request->getPost('user_name'), ENT_QUOTES));
        $user_email = strip_tags(htmlspecialchars($this->request->getPost('user_email'), ENT_QUOTES));
        $user_password = strip_tags(htmlspecialchars($this->request->getPost('user_password'), ENT_QUOTES));
        if (!password_verify($user_password, $this->akun['user_password'])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notfound');
        }
        // Cek Foto
        $data = $this->akun;
        $userPhotoAwal = $data['user_photo'];
        $fileUserPhoto = $this->request->getFile('user_photo');
        if ($fileUserPhoto->getName() == '') {
            $namaUserPhoto = $userPhotoAwal;
        } else {
            $namaUserPhoto = $fileUserPhoto->getRandomName();
            $fileUserPhoto->move('assets/backend/images/users', $namaUserPhoto);
        }
        // Simpan ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_photo' => $namaUserPhoto
        ]);
        return redirect()->to('/author/setting/profile')->with('msg', 'success-update');
    }
}
