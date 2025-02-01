<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\TestimonialModel;

class TestimonialAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->testimonialModel = new TestimonialModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Testimonial',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'testimonials' => $this->testimonialModel->findAll()
        ];

        return view('admin/v_testimonial', $data);
    }
    public function insert()
    {
        $data = [
            'nama' => htmlspecialchars(strip_tags($this->request->getPost('nama')), ENT_QUOTES),
            'angkatan' => htmlspecialchars(strip_tags($this->request->getPost('angkatan')), ENT_QUOTES),
            'content' => htmlspecialchars(strip_tags($this->request->getPost('content')), ENT_QUOTES),
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
            'angkatan' => [
                'rules' => 'required|exact_length[9]|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'exact_length' => 'Inputan harus berformat 2007-2010',
                    'alpha_numeric_punct' => 'Inputan harus berformat 2007-2010'
                ]
            ],
            'content' => [
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
            return redirect()->to('/admin/testimonial')->with('msg', 'error');
        }
        $validData = $this->validator->getValidated();
        $nama = $validData['nama'];
        $angkatan = $validData['angkatan'];
        $content = $validData['content'];
        $filefoto = $validData['filefoto'];
        // Cek foto
        if ($filefoto->isValid()) {
            // Ambil File foto
            $namaFotoUpload = $filefoto->getRandomName();
            $filefoto->move('assets/backend/images/testi/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }
        // Simpan ke database
        $this->testimonialModel->save([
            'testimonial_name' => $nama,
            'testimonial_angkatan' => $angkatan,
            'testimonial_content' => $content,
            'testimonial_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/testimonial')->with('msg', 'success');
    }
    public function update()
    {
        $data = [
            'testimonial_id' => htmlspecialchars(strip_tags($this->request->getPost('testimonial_id')), ENT_QUOTES),
            'nama' => htmlspecialchars(strip_tags($this->request->getPost('nama')), ENT_QUOTES),
            'angkatan' => htmlspecialchars(strip_tags($this->request->getPost('angkatan')), ENT_QUOTES),
            'content' => htmlspecialchars(strip_tags($this->request->getPost('content')), ENT_QUOTES),
            'filefoto' => $this->request->getFile('filefoto')
        ];
        $rules = [
            'testimonial_id' => [
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
            'angkatan' => [
                'rules' => 'required|exact_length[9]|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'exact_length' => 'Inputan harus berformat 2007-2010',
                    'alpha_numeric_punct' => 'Inputan harus berformat 2007-2010'
                ]
            ],
            'content' => [
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
            return redirect()->to('/admin/testimonial')->with('msg', 'error');
        }
        $validData = $this->validator->getValidated();
        $testimonial_id = $validData['testimonial_id'];
        $nama = $validData['nama'];
        $angkatan = $validData['angkatan'];
        $content = $validData['content'];
        $fileFoto = $validData['filefoto'];
        // Cek Foto
        $testimonial = $this->testimonialModel->find($testimonial_id);
        $fotoAwal = $testimonial['testimonial_image'];
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/testi/', $namaFotoUpload);
        }
        // Simpan ke database
        $this->testimonialModel->update($testimonial_id, [
            'testimonial_name' => $nama,
            'testimonial_angkatan' => $angkatan,
            'testimonial_content' => $content,
            'testimonial_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/testimonial')->with('msg', 'info');
    }
    public function delete()
    {
        $testimonial_id = $this->request->getPost('kode');
        $this->testimonialModel->delete($testimonial_id);
        return redirect()->to('/admin/testimonial')->with('msg', 'success-delete');
    }
}
