<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\TeamModel;

class TeamAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->teamModel = new TeamModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Team',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'teams' => $this->teamModel->findAll()
        ];

        return view('admin/v_team', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'jabatan' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'twitter' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'facebook' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'instagram' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'linked' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/team')->with('msg', 'error');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/team/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.jpg';
        }
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $jabatan = strip_tags(htmlspecialchars($this->request->getPost('jabatan'), ENT_QUOTES));
        $twitter = strip_tags(htmlspecialchars($this->request->getPost('twitter'), ENT_QUOTES));
        $facebook = strip_tags(htmlspecialchars($this->request->getPost('facebook'), ENT_QUOTES));
        $instagram = strip_tags(htmlspecialchars($this->request->getPost('instagram'), ENT_QUOTES));
        $linked = strip_tags(htmlspecialchars($this->request->getPost('linked'), ENT_QUOTES));
        // Simpan ke database
        $this->teamModel->save([
            'team_name' => $nama,
            'team_jabatan' => $jabatan,
            'team_twitter' => $twitter,
            'team_facebook' => $facebook,
            'team_instagram' => $instagram,
            'team_linked' => $linked,
            'team_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/team')->with('msg', 'success');
    }
    public function update()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'jabatan' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'twitter' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'facebook' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'instagram' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'linked' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'Inputan harus berformat url'
                ]
            ],
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/team')->with('msg', 'error');
        }
        $team_id = strip_tags(htmlspecialchars($this->request->getPost('team_id'), ENT_QUOTES));
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $jabatan = strip_tags(htmlspecialchars($this->request->getPost('jabatan'), ENT_QUOTES));
        $twitter = strip_tags(htmlspecialchars($this->request->getPost('twitter'), ENT_QUOTES));
        $facebook = strip_tags(htmlspecialchars($this->request->getPost('facebook'), ENT_QUOTES));
        $instagram = strip_tags(htmlspecialchars($this->request->getPost('instagram'), ENT_QUOTES));
        $linked = strip_tags(htmlspecialchars($this->request->getPost('linked'), ENT_QUOTES));
        // Cek Foto
        $team = $this->teamModel->find($team_id);
        $fotoAwal = $team['team_image'];
        $fileFoto = $this->request->getFile('filefoto');
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/team/', $namaFotoUpload);
        }
        // Simpan ke database
        $this->teamModel->update($team_id, [
            'team_name' => $nama,
            'team_jabatan' => $jabatan,
            'team_twitter' => $twitter,
            'team_facebook' => $facebook,
            'team_instagram' => $instagram,
            'team_linked' => $linked,
            'team_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/team')->with('msg', 'info');
    }
    public function delete()
    {
        $team_id = $this->request->getPost('kode');
        $this->teamModel->delete($team_id);
        return redirect()->to('/admin/team')->with('msg', 'success-delete');
    }
}
