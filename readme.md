# Hibahweb [CI4]

## Deskripsi Ringkas
Salam Pergerakan! Selamat datang di situs resmi github [@pmiidev](https://github.com/pmiidev) untuk repo project-project kita kedepan. Kali ini pmiidev membagikan salah satu source code website company profile secara free (hibah) untuk para pengurus rayon/komis/rayon/korcab se-Indonesia.

Website ini dibangun dengan framework CodeIgniter [2022, CI 4] dilengkapi dengan fasilitas halaman front end dan back end. Front end adalah halaman website yang dikunjungi oleh pengunjung website, sedangkan back end untuk mengelola konten oleh administrator maupun author.

<hr>

## Daftar Isi

1. [Teknologi](#teknologi)
2. [Fitur](#fitur)
3. [Instalasi](#instalasi)
   - [Cara Install](#instalasi)
   - [Spesifikasi yang Dibutuhkan](#spesifikasi)
   - [Login Dashboard](#login-dashboard)
4. [Lisensi](#lisensi)

<hr>

## Teknologi

Teknologi yang digunakan untuk membangun aplikasi ini diantaranya:

1. [Codeigniter 4](https://codeigniter.com/)
2. [Bootstrap 5.1.1 => Halaman depan](https://getbootstrap.com/)
3. [Bootstrap 3.3.5 => Halaman dashboard](https://getbootstrap.com/)
4. [Bootstrap icon](https://icons.getbootstrap.com/)
5. [Fontawsome 4.3.0](https://fontawesome.com/)
6. [jQuery 2.1.4](https://jquery.com/)
7. [jQueryUI 1.11.4](http://jqueryui.com)
8. [jQuery blockUI 2.70.0](http://malsup.com/jquery/block/)
9. [jQuery-slimScroll 1.3.0](http://rocha.la/jQuery-slimScroll)
10. [jQuery Mockjax 2.0.1](https://github.com/jakerella/jquery-mockjax)
11. [Datatables 1.10.7](https://datatables.net/)
12. [MariaDB / MySql](https://mariadb.org/)
13. [Summernote](https://summernote.org/)
14. [AOS](http://michalsnik.github.io/aos/)
15. [Boxicond](https://boxicons.com/)
16. [Glightbox](https://biati-digital.github.io/glightbox/)
17. [Swiper 7.0.6](https://swiperjs.com)
18. [Isotope PACKAGED v3.0.6](https://isotope.metafizzy.co)
19. [PHP Email Form Validation - v3.1](https://bootstrapmade.com/php-email-form/)
20. [purecounter.js 1.1.4](https://github.com/srexi/purecounterjs)
21. [Waypoints 4.0.1](https://github.com/imakewebthings/waypoints)
22. [pace 1.0.2](https://github.com/CodeByZach/pace/)
23. [Uniform 2.1.2](http://pixelmatrixdesign.com)
24. [Line-icons](https://lineicons.com/)
25. [OffCanvasMenuEffects](https://tympanus.net/Development/OffCanvasMenuEffects/)
26. [Waves 0.6.5](http://fian.my.id/Waves)
27. [Switchery](https://abpetkov.github.io/switchery/)
28. [3d-bold-navigation](https://codyhouse.co/gem/3d-bold-navigation)
29. [dropify 0.2.1](https://github.com/JeremyFagis/dropify)
30. [moment.js 2.10.3](https://momentjs.com)
31. [toastr](https://github.com/CodeSeven/toastr)
32. [weather-icons 1.3](http://erikflowers.github.io/weather-icons/)
33. [metrojs](http://drewgreenwell.com/projects/metrojs)
34. [chartjs 1.0.2](http://chartjs.org/)
35. And more...

<hr>

## Fitur

Fitur pada Aplikasi ini meliputi:

1. Halaman Depan

   - Home
   - Gallery
   - Team
   - All Post
   - Post by Category
   - Post by Author
   - Post by Tag
   - Post by Search
   - Document
   - Contact
   - Login

2. Halaman Dashboard Admin

   - Dashboard
   - Post
     - All post
     - Add new
     - Category
     - Tag
   - Inbox
   - Comment
   - Subscriber
   - Member
   - Testimonial
   - Team
   - Users
   - Settings
     - My Profile
     - Website
     - Home
     - About
   - Logout

3. Halaman Dashboard Author

   - Dashboard
   - Post
     - All post
     - Add new
     - Category
     - Tag
   - Comment
   - Settings
     - My Profile
   - Logout

<hr>


## Instalasi

1. Clone repository ini melalui terminal git (pastikan sudah menginstall git)

```sh
  git clone https://github.com/pmiidev/hibahweb.git
```

2. run mysql (pada xampp biasanya)
3. Buat database dengan nama 'hibahweb' lalu Import `hibahweb.sql` yang ada pada folder db (pilih yang angka tertinggi karena versi yang terbaru, lalu rename menjadi hibahweb.sql)
4. Rename file env menjadi .env<br>
   Sesuaikan pengaturan pada .env jika dibutuhkan.
5. ketik perintah 'composer install' pada terminal (harus sudah menginstall composer).
6. Jalankan perintah `php spark serve` pada terminal untuk menjalankan aplikasi. pastikan lokasinya run tepat berada pada aplikasi dan pastikan juga untuk memiliki koneksi internet.

### Spesifikasi

- PHP ^7.4
- CodeIgniter 4.x
- Database MySQL atau MariaDB 5.x

### Login Dashboard

|                      | Username         | Password          |
| -------------------- | ---------------- | ----------------- |
| Admin                | admin@gmail.com  | admin2021pmiidev  |
| Author               | author@gmail.com | author2021pmiidev |

<hr>

## Lisensi

Project ini merupakan software yang free dan open source di bawah [lisensi MIT](LICENSE).

## Acknowledgment 

- Special thanks to [Sahabat Eris](https://github.com/sejutaimpian) for upgrading this repo using CodeIgniter 4 👋🏻     
- Demo [https://upgradedhibahweb.000webhostapp.com/](http://upgradedhibahweb.000webhostapp.com/)
