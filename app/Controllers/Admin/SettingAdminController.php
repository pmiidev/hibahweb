<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\SiteModel;

class SettingAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->siteModel = new SiteModel();
    }
    public function web()
    {

        $data = [
            'akun' => $this->akun,
            'title' => 'Website Setting',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),

            'sites' => $this->siteModel->first(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/v_setting-web', $data);
    }
    public function web_update()
    {
        // Validasi
        if (!$this->validate([
            'site_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'facebook' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'twitter' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'linkedin' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'instagram' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'pinterest' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'wa' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Iputan harus angka'
                ]
            ],
            'mail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Iputan harus email'
                ]
            ],
            'logo_icon' => [
                'rules' => 'max_size[logo_icon,2048]|is_image[logo_icon]|mime_in[logo_icon,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'logo_header' => [
                'rules' => 'max_size[logo_icon,2048]|is_image[logo_icon]|mime_in[logo_icon,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ], 'logo_big' => [
                'rules' => 'max_size[logo_icon,2048]|is_image[logo_icon]|mime_in[logo_icon,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to("/admin/setting/web")->with('msg', 'error');
        }
        // Inisiasi
        $site_id = strip_tags(htmlspecialchars($this->request->getPost('site_id'), ENT_QUOTES));
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
        $description = strip_tags(htmlspecialchars($this->request->getPost('description'), ENT_QUOTES));
        $facebook = strip_tags(htmlspecialchars($this->request->getPost('facebook'), ENT_QUOTES));
        $instagram = strip_tags(htmlspecialchars($this->request->getPost('instagram'), ENT_QUOTES));
        $twitter = strip_tags(htmlspecialchars($this->request->getPost('twitter'), ENT_QUOTES));
        $linkedin = strip_tags(htmlspecialchars($this->request->getPost('linkedin'), ENT_QUOTES));
        $pinterest = $this->request->getPost('pinterest');
        $wa = strip_tags(htmlspecialchars($this->request->getPost('wa'), ENT_QUOTES));
        $mail = strip_tags(htmlspecialchars($this->request->getPost('mail'), ENT_QUOTES));

        // Cek Foto
        $data = $this->siteModel->find($site_id);
        $logoIconAwal = $data['site_favicon'];
        $logoHeaderAwal = $data['site_logo_header'];
        $logoBigAwal = $data['site_logo_big'];
        $fileLogoIcon = $this->request->getFile('logo_icon');
        $fileLogoHeader = $this->request->getFile('logo_header');
        $fileLogoBig = $this->request->getFile('logo_big');
        if ($fileLogoIcon->getName() == '') {
            $namaLogoIcon = $logoIconAwal;
        } else {
            $namaLogoIcon = $fileLogoIcon->getRandomName();
            $fileLogoIcon->move('assets/frontend/images/', $namaLogoIcon);
        }
        if ($fileLogoHeader->getName() == '') {
            $namaLogoHeader = $logoHeaderAwal;
        } else {
            $namaLogoHeader = $fileLogoHeader->getRandomName();
            $fileLogoHeader->move('assets/frontend/images/', $namaLogoHeader);
        }
        if ($fileLogoBig->getName() == '') {
            $namaLogoBig = $logoBigAwal;
        } else {
            $namaLogoBig = $fileLogoBig->getRandomName();
            $fileLogoBig->move('assets/frontend/images/', $namaLogoBig);
        }
        // Simpan ke database
        $this->siteModel->update($site_id, [
            'site_name' => $name,
            'site_title' => $title,
            'site_description' => $description,
            'site_favicon' => $namaLogoIcon,
            'site_logo_header' => $namaLogoHeader,
            'site_logo_big' => $namaLogoBig,
            'site_facebook' => $facebook,
            'site_twitter' => $twitter,
            'site_instagram' => $instagram,
            'site_linkedin' => $linkedin,
            'site_pinterest' => $pinterest,
            'site_wa' => $wa,
            'site_mail' => $mail,
        ]);
        return redirect()->to('/admin/setting/web')->with('msg', 'success');
    }
}
