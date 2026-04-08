# Hibahweb

## Project Description
Salam Pergerakan! Selamat datang di repositori project hibahweb. Proyek ini adalah source code website company profile yang dibagikan secara gratis untuk pengurus rayon/komis/cabang/korcab se-Indonesia.

Website ini dibangun dengan framework CodeIgniter 4 dan menyediakan:
- Halaman depan untuk pengunjung website
- Halaman belakang untuk pengelolaan konten oleh administrator dan author
- Sistem login dan dashboard untuk admin dan author
- Pengaturan konten `Settings` untuk situs, halaman home, about, dan slider

> [!NOTE]
> Proyek ini menggunakan CodeIgniter 4 dan disiapkan untuk PHP 8.2+. Periksa `composer.json` untuk detail versi: `codeigniter4/framework` ^4.7.

<hr>

## Project Upgrade Status
Ingin berkontribusi? Silakan ajukan pull request atau buka issue di GitHub.

### BACKEND
> AUTH
>>- [x] Login page
>>- [x] Dashboard for Admin and Author
>>- [x] Page layouts: template, header, footer, sidebar
>>- [x] User settings for Admin and Author

> SETTINGS
>>- [x] Basic
>>- [x] Home
>>- [x] About
>>- [x] Slider

> POSTS
>>- [ ] All posts
>>- [ ] Add post
>>- [ ] Categories
>>- [ ] Tags

> ADDITIONAL
>>- [X] Users 
>>- [X] Members
>>- [X] Teams
>>- [X] Testimonials

### FRONTEND
> HOME (CI4 default)

<hr>

## Installation & Updates

1. Clone repository:
   ```bash
   git clone https://github.com/pmiidev/hibahweb.git
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Update composer packages ketika ada rilis baru:
   ```bash
   composer update
   ```

Jika Anda memutakhirkan framework, periksa release notes dan terapkan perubahan pada folder `app` jika diperlukan. File yang terpengaruh bisa disalin atau digabung dari `vendor/codeigniter4/framework/app`.

## Setup

1. Salin `env` menjadi `.env`
2. Sesuaikan `app.baseURL` dan pengaturan database
3. Pastikan server web mengarah ke folder `public`

## Important: Public Folder

`index.php` sekarang berada di dalam folder `public` untuk keamanan yang lebih baik. Pastikan konfigurasi web server Anda menunjuk ke folder tersebut, bukan ke root proyek.

## Contributing

Kami sangat menghargai kontribusi!

- Buka issue jika menemukan bug atau ingin menambahkan fitur
- Kirim pull request untuk perbaikan atau penambahan
- Berikan ⭐ di repositori ini jika Anda menyukai project ini

Terima kasih atas dukungan dan kontribusinya.

## Server Requirements

PHP version 8.2 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- json (enabled by default)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if using MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if using HTTP\CURLRequest

> [!WARNING]
> - PHP 7.4 reached end of life on November 28, 2022.
> - PHP 8.0 reached end of life on November 26, 2023.
> - PHP 8.1 will reach end of life on December 31, 2025.

Pastikan lingkungan Anda menggunakan PHP 8.2+ untuk keamanan dan kompatibilitas terbaik.
