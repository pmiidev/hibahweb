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
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'teams' => $this->teamModel->findAll()
        ];

        return view('admin/v_team', $data);
    }
    public function insert()
    {
        $data = [
            'nama' => htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES),
            'jabatan' => htmlspecialchars($this->request->getPost('jabatan'), ENT_QUOTES),
            'twitter' => htmlspecialchars($this->request->getPost('twitter'), ENT_QUOTES),
            'facebook' => htmlspecialchars($this->request->getPost('facebook'), ENT_QUOTES),
            'instagram' => htmlspecialchars($this->request->getPost('instagram'), ENT_QUOTES),
            'linked' => htmlspecialchars($this->request->getPost('linked'), ENT_QUOTES),
            'filefoto' => $this->request->getFile('filefoto')
        ];
        $rules = [
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
        ];
        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/admin/team')->with('msg', 'error');
        }
        $validData = $this->validator->getValidated();
        $nama = $validData['nama'];
        $jabatan = $validData['jabatan'];
        $twitter = $validData['twitter'];
        $facebook = $validData['facebook'];
        $instagram = $validData['instagram'];
        $linked = $validData['linked'];
        $filefoto = $validData['filefoto'];
        // Cek foto
        if ($filefoto->isValid()) {
            // Ambil File foto
            $fotoUpload = $filefoto;
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/team/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.jpg';
        }
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
        $data = [
            'team_id' => htmlspecialchars(strip_tags($this->request->getPost('team_id'), ENT_QUOTES)),
            'nama' => htmlspecialchars(strip_tags($this->request->getPost('nama'), ENT_QUOTES)),
            'jabatan' => htmlspecialchars(strip_tags($this->request->getPost('jabatan'), ENT_QUOTES)),
            'twitter' => htmlspecialchars(strip_tags($this->request->getPost('twitter'), ENT_QUOTES)),
            'facebook' => htmlspecialchars(strip_tags($this->request->getPost('facebook'), ENT_QUOTES)),
            'instagram' => htmlspecialchars(strip_tags($this->request->getPost('instagram'), ENT_QUOTES)),
            'linked' => htmlspecialchars(strip_tags($this->request->getPost('linked'), ENT_QUOTES)),
            'filefoto' => $this->request->getFile('filefoto')
        ];
        $rules = [
            'team_id' => [
                'rules' => 'required|is_natural_no_zero|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'is_natural_no_zero' => 'inputan harus angka dan tidak boleh nol atau negatif',
                    'numeric' => 'inputan harus angka'
                ]
            ],
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
        ];
        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/admin/team')->with('msg', 'error');
        }
        $validData = $this->validator->getValidated();
        $team_id = $validData['team_id'];
        $nama = $validData['nama'];
        $jabatan = $validData['jabatan'];
        $twitter = $validData['twitter'];
        $facebook = $validData['facebook'];
        $instagram = $validData['instagram'];
        $linked = $validData['linked'];
        $fileFoto = $validData['filefoto'];
        // Cek Foto
        $team = $this->teamModel->find($team_id);
        $fotoAwal = $team['team_image'];
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
