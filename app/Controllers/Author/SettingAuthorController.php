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
    public function profile_password()
    {
        $data = [
            'new_password' => $this->request->getPost('new_password'),
            'conf_password' => $this->request->getPost('conf_password'),
            'old_password' => $this->request->getPost('old_password')
        ];
        $rules = [
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
            ],
            'old_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ];
        // Validasi
        if (!$this->validateData($data, $rules)) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notmatch');
        }
        $validData = $this->validator->getValidated();
        $old_password = $validData['old_password'];
        $new_password = $validData['new_password'];

        // $old_password = strip_tags(htmlspecialchars($this->request->getPost('old_password'), ENT_QUOTES));
        // $conf_password = strip_tags(htmlspecialchars($this->request->getPost('conf_password'), ENT_QUOTES));
        if (!password_verify($old_password, $this->akun['user_password'])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notfound');
        }
        // Save ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_password' => password_hash($new_password, PASSWORD_DEFAULT)
        ]);
        return redirect()->to("/author/setting/profile")->with('msg', 'success');
    }
    public function profile_update()
    {
        $data = [
            'user_name' => $this->request->getPost('user_name'),
            'user_email' => $this->request->getPost('user_email'),
            'user_photo' => $this->request->getFile('user_photo')
        ];
        $rules = [
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
        ];
        // Validasi
        if (!$this->validateData($data, $rules)) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error');
        }
        $validData = $this->validator->getValidated();
        $user_name = $validData['user_name'];
        $user_email = $validData['user_email'];
        $user_photo = $validData['user_photo'];

        $user_password = $this->request->getPost('user_password');
        if (!password_verify($user_password, $this->akun['user_password'])) {
            return redirect()->to("/author/setting/profile")->with('msg', 'error-notfound');
        }
        // Cek Foto
        $user = $this->akun;
        $userPhotoAwal = $user['user_photo'];
        if ($user_photo->getName() == '') {
            $namaUserPhoto = $userPhotoAwal;
        } else {
            $namaUserPhoto = $user_photo->getRandomName();
            $user_photo->move('assets/backend/images/users', $namaUserPhoto);
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
