<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubscribeModel;

class SubscribeController extends BaseController
{
    public function index()
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
        $email = htmlspecialchars($this->request->getPost('email'));
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
