<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('v_login', ['validation' => \Config\Services::validation()]);
    }
    public function validasi()
    {
        $data = [
            'email' => htmlspecialchars($this->request->getPost('email')),
            'password' => htmlspecialchars($this->request->getPost('password'))
        ];
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Kolom {field} harus berformat email'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/login')->with('pesan', 'email atau password salah');
        }

        $validData = $this->validator->getValidated();
        $email = $validData['email'];
        $password = $validData['password'];

        $userModel = new UserModel();
        $user = $userModel->where('user_email', $email)->first();
        // Jika user terdaftar
        if ($user) {
            // Jika user aktif
            if ($user['user_status'] == 1) {
                // Cek password
                if (password_verify($password, $user['user_password'])) {
                    // Cek role
                    if ($user['user_level'] == '1') {
                        $this->setAdminSession($user);
                        return redirect()->to('/admin');
                    } else if ($user['user_level'] == '2') {
                        $this->setUserSession($user);
                        return redirect()->to('/author');
                    } else {
                        return redirect()->to('/');
                    }
                } else {
                    return redirect()->to('/login')->with('pesan', 'email atau password salah');
                }
            } else {
                return redirect()->to('/login')->with('pesan', 'akun belum aktif');
            }
        } else {
            return redirect()->to('/login')->with('pesan', 'email atau password salah');
        }
    }

    public function setAdminSession($user)
    {
        $data = [
            'id' => $user['user_id'],
            'nama' => $user['user_name'],
            'email' => $user['user_email'],
            'photo' => $user['user_photo'],
            'role' => 'admin'
        ];
        session()->set($data);  
        return true;
    }

    public function setUserSession($user)
    {
        $data = [
            'id' => $user['user_id'],
            'nama' => $user['user_name'],
            'email' => $user['user_email'],
            'photo' => $user['user_photo'],
            'role' => 'author'
        ];
        session()->set($data);
        return true;
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('');
    }
}
