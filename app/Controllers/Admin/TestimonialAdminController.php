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
        if (!$this->validate([
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
        ])) {
            return redirect()->to('/admin/testimonial')->with('msg', 'error');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/testi/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $angkatan = strip_tags(htmlspecialchars($this->request->getPost('angkatan'), ENT_QUOTES));
        $content = strip_tags(htmlspecialchars($this->request->getPost('content'), ENT_QUOTES));
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
        if (!$this->validate([
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
        ])) {
            return redirect()->to('/admin/testimonial')->with('msg', 'error');
        }
        $testimonial_id = strip_tags(htmlspecialchars($this->request->getPost('testimonial_id'), ENT_QUOTES));
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $angkatan = strip_tags(htmlspecialchars($this->request->getPost('angkatan'), ENT_QUOTES));
        $content = strip_tags(htmlspecialchars($this->request->getPost('content'), ENT_QUOTES));
        // Cek Foto
        $testimonial = $this->testimonialModel->find($testimonial_id);
        $fotoAwal = $testimonial['testimonial_image'];
        $fileFoto = $this->request->getFile('filefoto');
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
