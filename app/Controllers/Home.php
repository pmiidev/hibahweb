<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\SubscribeModel;
use App\Models\TestimonialModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->testimonialModel = new TestimonialModel();
        $this->aboutModel = new AboutModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'testimonial' => $this->testimonialModel->findAll(),
            'about' => $this->aboutModel->find(1),
            'validation' => \Config\Services::validation()
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
            return redirect()->to('/#footer');
            // Redirect memunculkan garis bawah merah dikarenakan dia membaca redirect di CI3
            // Aslinya mah ga eror.
        }

        $email = $this->request->getPost('email');
        $subscribeModel = new SubscribeModel();
        if ($subscribeModel->where('subscribe_email', $email)->countAllResults() != 1) {
            $subscribeModel->save([
                'subscribe_email' => $email,
                'subscribe_status' => 1,
                'subscribe_rating' => 0
            ]);
            session()->setFlashdata('pesan', 'Email berhasil didaftarkan. Terima Kasih.');
            return redirect()->to('/#footer');
        } else {
            session()->setFlashdata('pesan', 'Email telah terdaftar sebelumnya. Terima Kasih.');
            return redirect()->to('/#footer');
        }
    }
}
