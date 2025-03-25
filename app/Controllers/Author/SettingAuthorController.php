<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\UserModel;

class SettingAuthorController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function profile()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Profile Setting',
            'active' => $this->active,
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
        ];

        return view('author/v_set_profile', $data);
    }
    public function profile_update()
    {
        $user_name = $this->request->getPost('user_name');
        $user_email = $this->request->getPost('user_email');
        $user_photo = $this->request->getFile('user_photo');
        $user_password = $this->request->getPost('user_password');

        // Validasi password lama sebelum update
        if (!password_verify($user_password, $this->akun['user_password'])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notfound');
        }

        // Validasi data
        $rules = [
            'user_name' => 'required|alpha_space',
            'user_email' => 'required|valid_email',
            'user_photo' => 'max_size[user_photo,2048]|is_image[user_photo]|mime_in[user_photo,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error');
        }

        // Cek apakah ada file yang diunggah
        if ($user_photo && $user_photo->isValid() && !$user_photo->hasMoved()) {
            $namaUserPhoto = $user_photo->getRandomName();
            $user_photo->move('assets/lte4/img/users', $namaUserPhoto);
        } else {
            $namaUserPhoto = $this->akun['user_photo']; // Gunakan foto lama jika tidak ada upload baru
        }

        // Simpan ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_photo' => $namaUserPhoto
        ]);

        return redirect()->to('/author/setting/profile')->with('msg', 'success-update');
    }

    public function profile_password()
    {
        $old_password = $this->request->getPost('old_password');
        $new_password = $this->request->getPost('new_password');
        $conf_password = $this->request->getPost('conf_password');

        // Cek apakah password lama sesuai
        if (!password_verify($old_password, $this->akun['user_password'])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notfound');
        }

        // Validasi input
        $rules = [
            'new_password' => 'required|min_length[6]|matches[conf_password]',
            'conf_password' => 'required|min_length[6]|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notmatch');
        }

        // Update password ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_password' => password_hash($new_password, PASSWORD_DEFAULT)
        ]);

        return redirect()->to("/author/setting/profile")->with('msg', 'success');
    }


}