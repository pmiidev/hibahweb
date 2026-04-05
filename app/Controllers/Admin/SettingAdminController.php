<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CommentModel;
use App\Models\HomeModel;
use App\Models\InboxModel;
use App\Models\SiteModel;
use App\Models\SliderModel;
use App\Models\UserModel;

class SettingAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->homeModel = new HomeModel();
        $this->aboutModel = new AboutModel();
        $this->sliderModel = new SliderModel();
        $this->userModel = new UserModel();
    }

    private function getBaseData(string $title): array
    {
        return [
            'akun' => $this->akun,
            'title' => $title,
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
        ];
    }

    public function web()
    {
        $data = $this->getBaseData('Website Setting');
        $data['sites'] = $this->siteModel->first();

        return view('admin/v_setting-web', $data);
    }

    public function web_update()
    {
        $data = [
            'site_id' => htmlspecialchars(strip_tags($this->request->getPost('site_id'), ENT_QUOTES)),
            'name' => htmlspecialchars(strip_tags($this->request->getPost('name'), ENT_QUOTES)),
            'title' => htmlspecialchars(strip_tags($this->request->getPost('title'), ENT_QUOTES)),
            'description' => htmlspecialchars(strip_tags($this->request->getPost('description'), ENT_QUOTES)),
            'facebook' => htmlspecialchars(strip_tags($this->request->getPost('facebook'), ENT_QUOTES)),
            'twitter' => htmlspecialchars(strip_tags($this->request->getPost('twitter'), ENT_QUOTES)),
            'linkedin' => htmlspecialchars(strip_tags($this->request->getPost('linkedin'), ENT_QUOTES)),
            'instagram' => htmlspecialchars(strip_tags($this->request->getPost('instagram'), ENT_QUOTES)),
            'pinterest' => htmlspecialchars(strip_tags($this->request->getPost('pinterest'), ENT_QUOTES)),
            'wa' => htmlspecialchars(strip_tags($this->request->getPost('wa'), ENT_QUOTES)),
            'mail' => htmlspecialchars(strip_tags($this->request->getPost('mail'), ENT_QUOTES)),
            'logo_icon' => $this->request->getFile('logo_icon'),
            'logo_header' => $this->request->getFile('logo_header'),
            'logo_big' => $this->request->getFile('logo_big'),
        ];

        $rules = [
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
                    'numeric' => 'Inputan harus angka'
                ]
            ],
            'mail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Inputan harus email'
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
                'rules' => 'max_size[logo_header,2048]|is_image[logo_header]|mime_in[logo_header,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'logo_big' => [
                'rules' => 'max_size[logo_big,2048]|is_image[logo_big]|mime_in[logo_big,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/admin/setting/web')->with('msg', 'error');
        }

        $validated = $this->validator->getValidated();
        $site_id = $validated['site_id'];
        $name = $validated['name'];
        $title = $validated['title'];
        $description = $validated['description'];
        $facebook = $validated['facebook'];
        $twitter = $validated['twitter'];
        $linkedin = $validated['linkedin'];
        $instagram = $validated['instagram'];
        $pinterest = $validated['pinterest'];
        $wa = $validated['wa'];
        $mail = $validated['mail'];

        $fileLogoIcon = $validated['logo_icon'];
        $fileLogoHeader = $validated['logo_header'];
        $fileLogoBig = $validated['logo_big'];

        $site = $this->siteModel->find($site_id);
        $logoIconAwal = $site['site_favicon'] ?? null;
        $logoHeaderAwal = $site['site_logo_header'] ?? null;
        $logoBigAwal = $site['site_logo_big'] ?? null;

        $namaLogoIcon = $logoIconAwal;
        if ($fileLogoIcon && $fileLogoIcon->isValid() && $fileLogoIcon->getName() !== '') {
            $namaLogoIcon = $fileLogoIcon->getRandomName();
            $fileLogoIcon->move('assets/frontend/images/', $namaLogoIcon);
        }

        $namaLogoHeader = $logoHeaderAwal;
        if ($fileLogoHeader && $fileLogoHeader->isValid() && $fileLogoHeader->getName() !== '') {
            $namaLogoHeader = $fileLogoHeader->getRandomName();
            $fileLogoHeader->move('assets/frontend/images/', $namaLogoHeader);
        }

        $namaLogoBig = $logoBigAwal;
        if ($fileLogoBig && $fileLogoBig->isValid() && $fileLogoBig->getName() !== '') {
            $namaLogoBig = $fileLogoBig->getRandomName();
            $fileLogoBig->move('assets/frontend/images/', $namaLogoBig);
        }

        $this->siteModel->update($site_id, [
            'site_name' => $name,
            'site_title' => $title,
            'site_description' => $description,
            'site_favicon' => $namaLogoIcon,
            'site_logo_header' => $namaLogoHeader,
            'site_logo_big' => $namaLogoBig,
            'site_facebook' => $facebook,
            'site_twitter' => $twitter,
            'site_linkedin' => $linkedin,
            'site_instagram' => $instagram,
            'site_pinterest' => $pinterest,
            'site_wa' => $wa,
            'site_mail' => $mail,
        ]);

        return redirect()->to('/admin/setting/web')->with('msg', 'success');
    }

    public function home()
    {
        $data = $this->getBaseData('Home Setting');
        $data['homes'] = $this->homeModel->first();

        return view('admin/v_setting-home', $data);
    }

    public function home_update()
    {
        $data = [
            'home_id' => htmlspecialchars(strip_tags($this->request->getPost('home_id'), ENT_QUOTES)),
            'caption1' => htmlspecialchars(strip_tags($this->request->getPost('caption1'), ENT_QUOTES)),
            'caption2' => htmlspecialchars(strip_tags($this->request->getPost('caption2'), ENT_QUOTES)),
            'home_video' => htmlspecialchars(strip_tags($this->request->getPost('home_video'), ENT_QUOTES)),
            'img_heading' => $this->request->getFile('img_heading'),
            'img_testimonial' => $this->request->getFile('img_testimonial'),
            'img_testimonial2' => $this->request->getFile('img_testimonial2'),
        ];

        $rules = [
            'home_id' => [
                'rules' => 'required|is_natural_no_zero|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'is_natural_no_zero' => 'inputan harus angka dan tidak boleh nol atau negatif',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'caption1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'caption2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'home_video' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'img_heading' => [
                'rules' => 'max_size[img_heading,2048]|is_image[img_heading]|mime_in[img_heading,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'img_testimonial' => [
                'rules' => 'max_size[img_testimonial,2048]|is_image[img_testimonial]|mime_in[img_testimonial,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'img_testimonial2' => [
                'rules' => 'max_size[img_testimonial2,2048]|is_image[img_testimonial2]|mime_in[img_testimonial2,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/admin/setting/home')->with('msg', 'error');
        }

        $validated = $this->validator->getValidated();
        $home_id = $validated['home_id'];
        $caption1 = $validated['caption1'];
        $caption2 = $validated['caption2'];
        $home_video = $validated['home_video'];

        $fileImgHeading = $validated['img_heading'];
        $fileImgTestimonial = $validated['img_testimonial'];
        $fileImgTestimonial2 = $validated['img_testimonial2'];

        $home = $this->homeModel->find($home_id);
        $imgHeadingAwal = $home['home_bg_heading'] ?? null;
        $imgTestimonialAwal = $home['home_bg_testimonial'] ?? null;
        $imgTestimonial2Awal = $home['home_bg_testimonial2'] ?? null;

        $namaImgHeading = $imgHeadingAwal;
        if ($fileImgHeading && $fileImgHeading->isValid() && $fileImgHeading->getName() !== '') {
            $namaImgHeading = $fileImgHeading->getRandomName();
            $fileImgHeading->move('assets/frontend/img/', $namaImgHeading);
        }

        $namaImgTestimonial = $imgTestimonialAwal;
        if ($fileImgTestimonial && $fileImgTestimonial->isValid() && $fileImgTestimonial->getName() !== '') {
            $namaImgTestimonial = $fileImgTestimonial->getRandomName();
            $fileImgTestimonial->move('assets/frontend/img/', $namaImgTestimonial);
        }

        $namaImgTestimonial2 = $imgTestimonial2Awal;
        if ($fileImgTestimonial2 && $fileImgTestimonial2->isValid() && $fileImgTestimonial2->getName() !== '') {
            $namaImgTestimonial2 = $fileImgTestimonial2->getRandomName();
            $fileImgTestimonial2->move('assets/frontend/img/', $namaImgTestimonial2);
        }

        $this->homeModel->update($home_id, [
            'home_caption_1' => $caption1,
            'home_caption_2' => $caption2,
            'home_video' => $home_video,
            'home_bg_heading' => $namaImgHeading,
            'home_bg_testimonial' => $namaImgTestimonial,
            'home_bg_testimonial2' => $namaImgTestimonial2,
        ]);

        return redirect()->to('/admin/setting/home')->with('msg', 'success');
    }

    public function about()
    {
        $data = $this->getBaseData('About Setting');
        $data['abouts'] = $this->aboutModel->first();

        return view('admin/v_setting-about', $data);
    }

    public function about_update()
    {
        $data = [
            'about_id' => htmlspecialchars(strip_tags($this->request->getPost('about_id'), ENT_QUOTES)),
            'name' => htmlspecialchars(strip_tags($this->request->getPost('name'), ENT_QUOTES)),
            'alamat' => htmlspecialchars(strip_tags($this->request->getPost('alamat'), ENT_QUOTES)),
            'description' => htmlspecialchars(strip_tags($this->request->getPost('description'), ENT_QUOTES)),
            'img_about' => $this->request->getFile('img_about'),
        ];

        $rules = [
            'about_id' => [
                'rules' => 'required|is_natural_no_zero|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'is_natural_no_zero' => 'inputan harus angka dan tidak boleh nol atau negatif',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'alamat' => [
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
            'img_about' => [
                'rules' => 'max_size[img_about,2048]|is_image[img_about]|mime_in[img_about,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/admin/setting/about')->with('msg', 'error');
        }

        $validated = $this->validator->getValidated();
        $about_id = $validated['about_id'];
        $name = $validated['name'];
        $alamat = $validated['alamat'];
        $description = $validated['description'];

        $fileImgAbout = $validated['img_about'];
        $about = $this->aboutModel->find($about_id);
        $imgAboutAwal = $about['about_image'] ?? null;
        $namaImgAbout = $imgAboutAwal;

        if ($fileImgAbout && $fileImgAbout->isValid() && $fileImgAbout->getName() !== '') {
            $namaImgAbout = $fileImgAbout->getRandomName();
            $fileImgAbout->move('assets/frontend/img/', $namaImgAbout);
        }

        $this->aboutModel->update($about_id, [
            'about_name' => $name,
            'about_alamat' => $alamat,
            'about_description' => $description,
            'about_image' => $namaImgAbout,
        ]);

        return redirect()->to('/admin/setting/about')->with('msg', 'success');
    }

    public function slider()
    {
        $data = $this->getBaseData('Slider Setting');
        $data['sliders'] = $this->sliderModel->orderBy('slider_order', 'ASC')->findAll();

        return view('admin/v_setting-slider', $data);
    }

    public function slider_save()
    {
        $data = [
            'slider_title' => htmlspecialchars(strip_tags($this->request->getPost('slider_title'), ENT_QUOTES)),
            'slider_caption' => htmlspecialchars(strip_tags($this->request->getPost('slider_caption'), ENT_QUOTES)),
            'slider_order' => htmlspecialchars(strip_tags($this->request->getPost('slider_order'), ENT_QUOTES)),
            'slider_image' => $this->request->getFile('slider_image'),
        ];

        $rules = [
            'slider_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'slider_caption' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'slider_order' => [
                'rules' => 'required|is_natural',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'is_natural' => 'Inputan harus angka dan tidak negatif'
                ]
            ],
            'slider_image' => [
                'rules' => 'uploaded[slider_image]|max_size[slider_image,2048]|is_image[slider_image]|mime_in[slider_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar slider harus diunggah',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/admin/setting/slider')->with('msg', 'error');
        }

        $validated = $this->validator->getValidated();
        $sliderTitle = $validated['slider_title'];
        $sliderCaption = $validated['slider_caption'];
        $sliderOrder = $validated['slider_order'];
        $fileImage = $validated['slider_image'];

        $imageName = $fileImage->getRandomName();
        $fileImage->move('assets/frontend/img/', $imageName);

        $this->sliderModel->insert([
            'slider_title' => $sliderTitle,
            'slider_caption' => $sliderCaption,
            'slider_image' => $imageName,
            'slider_order' => $sliderOrder,
        ]);

        return redirect()->to('/admin/setting/slider')->with('msg', 'success');
    }

    public function slider_delete($id)
    {
        $slider = $this->sliderModel->find($id);
        if ($slider) {
            $this->sliderModel->delete($id);
            return redirect()->to('/admin/setting/slider')->with('msg', 'deleted');
        }

        return redirect()->to('/admin/setting/slider')->with('msg', 'error');
    }

    public function profile()
    {
        $data = $this->getBaseData('Profile Setting');

        return view('admin/v_set_profile', $data);
    }

    public function profile_update()
    {
        $user_name = $this->request->getPost('user_name');
        $user_email = $this->request->getPost('user_email');
        $user_photo = $this->request->getFile('user_photo');

        $rules = [
            'user_name' => 'required|alpha_space',
            'user_email' => 'required|valid_email',
            'user_photo' => 'max_size[user_photo,2048]|is_image[user_photo]|mime_in[user_photo,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to("/admin/setting/profile")->with('msg', 'error');
        }

        // Cek apakah ada file yang diunggah
        if ($user_photo && $user_photo->isValid() && !$user_photo->hasMoved()) {
            $namaUserPhoto = $user_photo->getRandomName();
            $user_photo->move('assets/lte4/img/users', $namaUserPhoto);
        } else {
            $namaUserPhoto = $this->akun['user_photo']; // Gunakan foto lama jika tidak ada upload baru
        }

        // Simpan ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_photo' => $namaUserPhoto
        ]);

        return redirect()->to('/admin/setting/profile')->with('msg', 'success-update');
    }

    public function profile_password()
    {
        $old_password = $this->request->getPost('old_password');
        $new_password = $this->request->getPost('new_password');
        $conf_password = $this->request->getPost('conf_password');

        // Cek apakah password lama sesuai
        if (!password_verify($old_password, $this->akun['user_password'])) {
            return redirect()->to("/admin/setting/profile")->with('msg', 'error-notfound');
        }

        // Validasi input
        $rules = [
            'new_password' => 'required|min_length[6]|matches[conf_password]',
            'conf_password' => 'required|min_length[6]|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to("/admin/setting/profile")->with('msg', 'error-notmatch');
        }

        // Update password ke database
        $this->userModel->update($this->akun['user_id'], [
            'user_password' => password_hash($new_password, PASSWORD_DEFAULT)
        ]);

        return redirect()->to("/admin/setting/profile")->with('msg', 'success');
    }


}