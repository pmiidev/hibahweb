<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubscribeModel;

class SubscribeController extends BaseController
{
    public function index()
    {
        $data = [
            'email' => htmlspecialchars($this->request->getPost('email')),
        ];
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Inputan {field} harus email!'
                ]
            ]
        ];
        if (!$this->validateData($data, $rules)) {
            session()->setFlashdata('peringatan', 'Inputan harus berformat email. silakan coba lagi.');
            return redirect()->to('#footer');
        }
        $validData = $this->validator->getValidated();
        $email = $validData['email'];
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
}
