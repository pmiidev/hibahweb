<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\MemberModel;

class MemberAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->memberModel = new MemberModel();
    }
    public function index()
    {

        $data = [
            'akun' => $this->akun,
            'title' => 'All Member',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'members' => $this->memberModel->findAll()
        ];

        return view('admin/v_member', $data);
    }
    public function insert()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'link' => $this->request->getPost('link'),
            'desc' => $this->request->getPost('desc'),
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
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
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
            return redirect()->to('/admin/member')->with('msg', 'error');
        }
        $validData = $this->validator->getValidated();
        $nama = $validData['nama'];
        $link = $validData['link'];
        $desc = $validData['desc'];
        $filefoto = $validData['filefoto'];
        // Cek foto
        if ($filefoto->isValid()) {
            // Ambil File foto
            $namaFotoUpload = $filefoto->getRandomName();
            $filefoto->move('assets/backend/images/member/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }

        // Simpan ke database
        $this->memberModel->save([
            'member_name' => $nama,
            'member_link' => $link,
            'member_desc' => $desc,
            'member_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/member')->with('msg', 'success');
    }
    public function update()
    {
        $data = [
            'member_id' => $this->request->getPost('member_id'),
            'nama' => $this->request->getPost('nama'),
            'link' => $this->request->getPost('link'),
            'desc' => $this->request->getPost('desc'),
            'filefoto' => $this->request->getFile('filefoto')
        ];
        $rules = [
            'member_id' => [
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
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
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
            return redirect()->to('/admin/member')->with('msg', 'error');
        }

        $validData = $this->validator->getValidated();
        $member_id = $validData['member_id'];
        $nama = $validData['nama'];
        $link = $validData['link'];
        $desc = $validData['desc'];

        // Cek Foto
        $member = $this->memberModel->find($member_id);
        $fotoAwal = $member['member_image'];
        $fileFoto = $this->request->getFile('filefoto');
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/member/', $namaFotoUpload);
        }
        // Simpan ke database
        $this->memberModel->update($member_id, [
            'member_name' => $nama,
            'member_link' => $link,
            'member_desc' => $desc,
            'member_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/member')->with('msg', 'info');
    }
    public function delete()
    {
        $member_id = $this->request->getPost('kode');
        $this->memberModel->delete($member_id);
        return redirect()->to('/admin/member')->with('msg', 'success-delete');
    }
}
