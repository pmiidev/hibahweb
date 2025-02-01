<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\InboxModel;
use App\Models\SiteModel;

class ContactController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->inboxModel = new InboxModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Contact',
            'active' => 'Contact'
        ];
        return view('contact_view', $data);
    }
    public function inbox()
    {
        $data = [
            'inbox_name' => htmlspecialchars(strip_tags($this->request->getPost('inbox_name')), ENT_QUOTES),
            'inbox_email' => htmlspecialchars(strip_tags($this->request->getPost('inbox_email')), ENT_QUOTES),
            'inbox_subject' => htmlspecialchars(strip_tags($this->request->getPost('inbox_subject')), ENT_QUOTES),
            'inbox_message' => htmlspecialchars(strip_tags($this->request->getPost('inbox_message')), ENT_QUOTES),
        ];
        $rules = [
            'inbox_name' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_numeric_space' => 'Inputan tidak boleh berisi karakter aneh'
                ]
            ],
            'inbox_email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Inputan harus berformat email'
                ]
            ],
            'inbox_subject' => [
                'rules' => 'required|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_numeric_punct' => 'Inputan tidak boleh berisi karakter aneh'
                ]
            ],
            'inbox_message' => [
                'rules' => 'required|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_numeric_punct' => 'Inputan tidak boleh berisi karakter aneh'
                ]
            ]
        ];
        if (!$this->validateData($data, $rules)) {
            return redirect()->to("/contact#message-box")->with('danger', 'Pesan gagal dikirim karena penginputan tidak sesuai.');
        }

        $validData = $this->validator->getValidated();
        $inbox_name = $validData['inbox_name'];
        $inbox_email = $validData['inbox_email'];
        $inbox_subject = $validData['inbox_subject'];
        $inbox_message = $validData['inbox_message'];

        // Save ke database
        $this->inboxModel->save([
            'inbox_name' => $inbox_name,
            'inbox_email' => $inbox_email,
            'inbox_subject' => $inbox_subject,
            'inbox_message' => $inbox_message,
            'inbox_status' => 0,
        ]);
        return redirect()->to("/contact#message-box")->with('success', 'Pesan berhasil dikirim');
    }
}
