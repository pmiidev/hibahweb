-- phpMyAdmin SQL Dump

-- version 5.2.0

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Waktu pembuatan: 07 Nov 2022 pada 03.27

-- Versi server: 10.4.24-MariaDB

-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Database: `hibahweb`

--

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_about`

--

CREATE TABLE
    `tbl_about` (
        `about_id` int(11) NOT NULL,
        `about_name` varchar(255) NOT NULL,
        `about_image` varchar(100) DEFAULT NULL,
        `about_description` text DEFAULT NULL,
        `about_alamat` varchar(255) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_about`

--

INSERT INTO
    `tbl_about` (
        `about_id`,
        `about_name`,
        `about_image`,
        `about_description`,
        `about_alamat`
    )
VALUES (
        1,
        'PK PMII STMIK Tasikmalaya',
        'about1.jpg',
        'PK PMII STMIK Tasikmalaya adalah Ormawa Ekstrak Kampus STMIK Tasikmalaya yang bergerak di bidang pergerakan dan Digital Skill',
        ''
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_category`

--

CREATE TABLE
    `tbl_category` (
        `category_id` int(11) NOT NULL,
        `category_name` varchar(200) DEFAULT NULL,
        `category_slug` varchar(200) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_category`

--

INSERT INTO
    `tbl_category` (
        `category_id`,
        `category_name`,
        `category_slug`
    )
VALUES (1, 'Articles', 'articles'), (2, 'News', 'news'), (3, 'Opinion', 'opinion'), (4, 'Abstract', 'abstract');

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_comment`

--

CREATE TABLE
    `tbl_comment` (
        `comment_id` int(11) NOT NULL,
        `comment_date` timestamp NULL DEFAULT current_timestamp(),
        `comment_name` varchar(60) DEFAULT NULL,
        `comment_email` varchar(90) DEFAULT NULL,
        `comment_message` text DEFAULT NULL,
        `comment_status` int(11) DEFAULT 0,
        `comment_parent` int(11) DEFAULT 0,
        `comment_post_id` int(11) DEFAULT NULL,
        `comment_image` varchar(50) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_comment`

--

INSERT INTO
    `tbl_comment` (
        `comment_id`,
        `comment_date`,
        `comment_name`,
        `comment_email`,
        `comment_message`,
        `comment_status`,
        `comment_parent`,
        `comment_post_id`,
        `comment_image`
    )
VALUES (
        1,
        '2022-11-07 00:43:20',
        'Eris Sulistina',
        'derissulistina@gmail.com',
        'Mantap. Salam Pergerakan.',
        1,
        0,
        3,
        'avatar (5).png'
    ), (
        2,
        '2022-11-07 00:48:39',
        'Uzumkai Shio',
        'shio@gmail.com',
        'Seharusnya capaian awal dari media penerbitan adalah menghasilkan buku pedoman berorganisasi khususnuya di PMII dan lebih khusus lagi transformasi organisasi digital',
        1,
        0,
        1,
        'user_blank.png'
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_home`

--

CREATE TABLE
    `tbl_home` (
        `home_id` int(11) NOT NULL,
        `home_caption_1` varchar(200) DEFAULT NULL,
        `home_caption_2` varchar(200) DEFAULT NULL,
        `home_bg_heading` varchar(50) DEFAULT NULL,
        `home_bg_testimonial` varchar(50) DEFAULT NULL,
        `home_bg_testimonial2` varchar(50) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_home`

--

INSERT INTO
    `tbl_home` (
        `home_id`,
        `home_caption_1`,
        `home_caption_2`,
        `home_bg_heading`,
        `home_bg_testimonial`,
        `home_bg_testimonial2`
    )
VALUES (
        1,
        'Welcome to',
        'District Board of Indonesian Moslem Student Movement',
        'home-1.png',
        'home-2.png',
        'home-3.png'
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_inbox`

--

CREATE TABLE
    `tbl_inbox` (
        `inbox_id` int(11) NOT NULL,
        `inbox_name` varchar(50) DEFAULT NULL,
        `inbox_email` varchar(80) DEFAULT NULL,
        `inbox_subject` varchar(200) DEFAULT NULL,
        `inbox_message` text DEFAULT NULL,
        `inbox_created_at` timestamp NULL DEFAULT current_timestamp(),
        `inbox_status` varchar(2) DEFAULT '0' COMMENT '0=Unread, 1=Read'
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_member`

--

CREATE TABLE
    `tbl_member` (
        `member_id` int(11) NOT NULL,
        `member_name` varchar(50) DEFAULT NULL,
        `member_link` varchar(50) DEFAULT NULL,
        `member_desc` text DEFAULT NULL,
        `member_image` varchar(50) DEFAULT NULL,
        `member_created_at` timestamp NULL DEFAULT current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_navbar`

--

CREATE TABLE
    `tbl_navbar` (
        `navbar_id` int(11) NOT NULL,
        `navbar_name` varchar(50) DEFAULT NULL,
        `navbar_slug` varchar(200) DEFAULT NULL,
        `navbar_parent_id` int(11) DEFAULT 0
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_navbar`

--

INSERT INTO
    `tbl_navbar` (
        `navbar_id`,
        `navbar_name`,
        `navbar_slug`,
        `navbar_parent_id`
    )
VALUES (1, 'Home', NULL, 0), (2, 'Profil', 'about', 0), (13, 'Edukasi', 'edu', 0), (17, 'Contact', 'contact', 0), (
        18,
        'HTML Dasar',
        'category/html-dasar',
        13
    ), (
        19,
        'CSS Dasar',
        'category/css-dasar',
        13
    ), (
        20,
        'JavaScript Dasar',
        'category/javascript-dasar',
        13
    ), (
        21,
        'PHP Dasar',
        'category/php-dasar',
        13
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_post`

--

CREATE TABLE
    `tbl_post` (
        `post_id` int(11) NOT NULL,
        `post_title` varchar(250) DEFAULT NULL,
        `post_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        `post_contents` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        `post_image` varchar(40) DEFAULT NULL,
        `post_date` timestamp NULL DEFAULT current_timestamp(),
        `post_last_update` datetime DEFAULT NULL,
        `post_category_id` int(11) DEFAULT NULL,
        `post_tags` varchar(225) DEFAULT NULL,
        `post_slug` varchar(250) DEFAULT NULL,
        `post_status` int(11) DEFAULT NULL COMMENT '1=Publish, 0=Unpublish',
        `post_views` int(11) DEFAULT 0,
        `post_user_id` int(11) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_post`

--

INSERT INTO
    `tbl_post` (
        `post_id`,
        `post_title`,
        `post_description`,
        `post_contents`,
        `post_image`,
        `post_date`,
        `post_last_update`,
        `post_category_id`,
        `post_tags`,
        `post_slug`,
        `post_status`,
        `post_views`,
        `post_user_id`
    )
VALUES (
        1,
        'Evaluasi Media Penerbitan, Ciptakan Karya Gerakan Intelektual PMII',
        'Dalam kalimat sajak lagu mars PMII tersebut, justru seluruh warga penggerak perubahan ini memahami makna dari kalimat itu. ',
        '<p style=\"text-align: justify; \">Siapa yang masih belum tau dengan kumpulan organisasi berbendera biru kuning. Saya yakin rata-rata sudah mengetahuinya, entah di jalan ataupun dalam ruangan pendidikan, bahkan menjadi mayoritas mahasiswa sebagai ruang berorganisasi. Karena gerak gerik organisasi Pergerakan Mahasiswa Islam Indonesia (PMII) kian mudah dipandang, sebab para kaderisasinya sangat menonjol bila terdapat bencana alam disekitarnya. Namun terdapat keganjalan dalam eksistensi warga pergerakan ini hendak turun ke jalan, yakni media penerbitan berita atau sering kali disebut news. Aksiologi yang diandalkan tidak cukup dengan kekurangan pemikiran atau sapaan akrabnya intelektual. Karena menjadi kader dalam organisasi PMII seharusnya mempunyai pemikiran tinggi dan karya sebagai identitas diri sebagai bukti. Maka dari itu, media penerbitan PMII tahun 2021 ini butuh di evaluasi dan di-booming-kan.</p><p style=\"text-align: justify; \">“Denganmu PMII pergerakanku, ilmu dan bakti ku berikan” kalimat sajak dalam lagu mars PMII.</p><p style=\"text-align: justify; \">Dalam kalimat sajak lagu mars PMII tersebut, justru seluruh warga penggerak perubahan ini memahami makna dari kalimat itu. Bagiku sangat bagus untuk dimaknai dan diteliti, bagaimana bergerak di dalam organisasi harus berilmu dan berbakti. Berilmu dalam artian mempunyai bahan atau akal untuk mengedepankan, mengharumkan identitas PMII dalam berbangsa dan bernegara. Bakti dalam menciptakan suatu karya sesuai keseniannya akan menjadi sebagai sumbangsihnya terhadap organisasi PMII.</p><p style=\"text-align: justify; \">Mengapa harus dievaluasi?</p><p style=\"text-align: justify; \">Setelah satu tahun berjalan menjadi anggota dalam organisasi PMII, tepatnya di salah satu daerah wilayah kota santri Jombang, berdasarkan pengamatan saya secara terang bahwa kader PMII kian dinyatakan mellek media. Namun konon nyatanya sedikit berkarya, atau sering disapa dengan hanya menduga-duga. Maka dari itu, sampai tulisan ini terbit saya harapkan kepada pimpinan Ketua Cabang PMII Jombang, M. Arif Hakim untuk mengevaluasi kembali guna mem-booming-kan perkembangan para kader melalui media.</p><p style=\"text-align: justify; \">Apa guna berkarya dalam organisasi PMII?</p><p style=\"text-align: justify; \">Perlu diketahui, PMII yang dikenal dengan warga pergerakan intelektual setidaknya bisa menciptakan gerakan nyatanya dari karya seninya. Contohnya, 17 April 2021 seluruh warga pergerakan akan merayakan hari lahir organisasi PMII, dari situ kita sudah bisa berkarya dengan menuliskan sejarah atau perayaan yang berbeda dari sebelumnya. Konon katanya sejarah yang dibilang penting dan layak untuk diingat, apa salahnya kita ciptakan dengan karya yang berbeda guna akan dikenang oleh masyarakat hingga kepemerintahan.</p><p style=\"text-align: justify; \">Mungkin segenap rasa hormat dan selamat bagi seluruh warga pergerakan menjelang hari lahirnya organisasi Pergerakan Mahasiswa Islam Indonesia, pada 17 April 2021 mendatang. Saya sendiri selaku masih anggota di ranah fakultas Rayon Fakultas Bisnis dan Bahasa (FBB) Komisariat Umar Tamim, Jombang mengharap agar seluruhnya di setiap naungan organisasi PMII bisa mengevaluasi kembali media penerbitannya, guna saling bersahabat untuk membumikan perkembangan organisasi PMII kedepannya. Jum’at (09/04/2021).</p><p style=\"text-align: justify; \"><b>Muhammad Fa\'iz Hasan</b><br></p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">Sumber: <a href=\"https://ikilhojatim.com/evaluasi-media-penerbitan-ciptakan-karya-gerakan-intelektual-pmii/\" target=\"_blank\">ikilhojatim.com</a></p><p style=\"text-align: justify; \"><br></p>',
        'ccca7e866c78966d4d7f3110303ef43d.jpg',
        '2021-10-22 17:41:12',
        NULL,
        3,
        'pmii,pmiidev,pmiimedia,pmiimaju,pmiimendunia',
        'evaluasi-media-penerbitan--ciptakan-karya-gerakan-intelektual-pmii',
        1,
        1,
        4
    ), (
        2,
        'E-Koran Media Komunis Wadah Menulis untuk Aktivis',
        'Media menulis yang saat ini dapat mendukung hal tersebut pun sudah tidak terhitung, baik yang cetak maupun non cetak, segala bentuk platform sudah berkeliaran bebas serta dapat dinikmati oleh masyarakat tanpa batas. ',
        '<p style=\"text-align: justify; \">Telah resmi di buka&nbsp; E- Koran Media Komunis, salah satu media informasi yang dimilki oleh organisasi Pergerakan Mahasiswa Islam Indonesia (PMII) Komisariat Universitas Islam Malang (Unisma) hari ini tanggal 16 Maret 2021. Selain membaca, keterampilan berbahasa yang penting dimiliki adalah menulis, menyampaikan apa yang menjadi sudut pandang pribadi, baik yang besifat objektif atau subjektif sekalipun. Peka membaca sekitar kemudian menkontruksinya menjadi sebuah tulisan yang bisa dibaca masyarakat luas, menyumbangkan pengetahuan baru yang bersifat positif, bisa menjadi nilai plus untuk kita sebagai manusia yang meyakini perihal khoirunnas anfa’uhum linnas</p><p style=\"text-align: justify; \">Media menulis yang saat ini dapat mendukung hal tersebut pun sudah tidak terhitung, baik yang cetak maupun non cetak, segala bentuk platform sudah berkeliaran bebas serta dapat dinikmati oleh masyarakat tanpa batas. Tinggal ditanyakan kembali kepada diri sendiri apakah kita mau memilih diam ditempat atau bergerak menjadi bagian dari orang-orang yang tulisannya sudah dinikmati banyak kalangan. Maka dari itu, pengurus devisi Lembaga Pers Komisariat (LPK) Pergerakan Mahasiswa Islam Indonesia (PMII) Komisariat Universitas Islam malang (Unisma) memilih satu media berupa “E-Koran Media Komunis” yang bisa menjadi wadah menulis dan menunjang minat bakat kader PMII sebagai aktivis organisasi yang sejadinya setiap kader pasti memilki potensi dalam bidang tersebut. Dalam hal ini, E-Koran Media Komunis juga menyediakan berbagai kategori seperti opini, karya ilmiah dan lain sebagainya, websitenya juga bisa diakses dengan mudah.</p><p style=\"text-align: justify; \">Adanya website ini selain menjadi media menulis, juga diharapkan menjadi warna baru dari Pergerakan Mahsiwa Islam Indonesia (PMII) yang terus dijaga, dirawat dengan baik sehingga tidak ada istilah mati suri. Media yang dapat dijadikani alat bagi sahabat sahabati pergerakan untuk lebih berani melantangkan opini terutama di kondisi saat ini yang mengharuskan kita untuk berpikir lebih kreatif nan lebih aktif, lebih sabar menerima situasi yang tidak tahu sampai kapan pandemi, dan lebih kuat untuk melawan kerasnya dunia digitalisasi yang semakin hebat.</p><p style=\"text-align: justify; \">Dalam hal ini, ketua komisariat PMII Unisma sahabat Maksum menyampaikan apa yang dilihat dengan adanya E-koran Media Komunis “Media ini hadir salah satunya untuk menunaikan point terakhir dari pilar demokrasi, tidak muluk-muluk, dengan harapan sederhana ruang dealektika modern ini selain sebagai pangkalan data, sarana informasi, brand organisasi, juga untuk menjadi wadah utuh menampung gagasan-gagasan keren, ide-ide kreatif dari setiap kader PMII khususnya di lingkup Unisma”. Ketua Kopri PMII Komisariat Unisma Sahabati Firda juga menambahkan “Besar harapan saya, dengan adanya E-Koran Media Komunis mampu menggugah selera literasi bagi para kader PMII Unisma untuk menuangkan cita rasa tulisan-tulisan terbaiknya di website E-Koran PMII Unisma, karena entah diakui atau tidak, hari ini kita hidup di dunia yang penuh dengan informasi atau bisa dikatakan tengah&nbsp; mengalami banjir informasi (Flood of information) namun miskin makna, maka adanya media ini guna menghadirkan informasi kritis-solutif”.</p><p style=\"text-align: justify; \">Selain itu, koordinator devisi Media Pers Komisariat (LPK) juga menyampaikan harapannya “Dengan adanya E-Koran Media Komunis ini, saya berharap kepada kader PMII di bawah naungan komisariat Unisma untuk berani menyampaikan gagasan yang ada dalam pikiran masing-masing kader PMII, baik berupa karya ilmiah, opini ataupun berita tentang isu-isu saat ini. Saya harap kader-kader PMII tidak merasa canggung atau sungkan dalam berkarya segila mungkin.” jelas sahabat Yasak</p><p style=\"text-align: justify; \">Harapan-harapan baik yang sejatinya dapat direlisasikan secara sempurna dengan kerja sama semua elemen PMII Komisariat Unisma baik kader dari semua Rayon, pengurus bahkan sahabat sahabati yang sudah demisioner. Berkontribusi untuk menuangkan idenya melalui tulisan, memberi izin untuk dipublikasikan hingga dapat dikonsumsi banyak orang, karena website ini layaknya sebuah tanaman yang perlu diberi makan agar tetap memberi manfaat pada sekitar, tidak mati apalagi dilupakan. Kita sebagai manusia, yang dianggap sebagai aktivis pergerakan oleh masyarakat umum, selayaknya terus barusaha agar tidak tuli ketika mendengarkan sebuah aspirasi, tidak buta untuk membaca berita, tidak bisu untuk menyampaikan kebenaran baru dan tidak lumpuh untuk berpikir secara utuh.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">Sumber: <a href=\"https://pmiiunisma.id/e-koran-media-komunis-wadah-menulis-untuk-aktivis/\" target=\"_blank\">pmiiunisma.id</a></p><p style=\"text-align: justify; \"><br></p>',
        '77a9b4d95d54ff320de62abd90a669e7.jpg',
        '2021-10-22 17:44:23',
        NULL,
        2,
        'pmii,pmiidev,pmiimendunia,kemahasiswaan,kebangsaan,pemuda',
        'e-koran-media-komunis-wadah-menulis-untuk-aktivis',
        1,
        3,
        5
    ), (
        3,
        'Perlunya Edukasi Media, PMII IAIN Pontianak Adakan Ngaji Media',
        'Kader PCI PMII Jerman mengatakan bahwa penyelenggaraan Ngaji Media ini merupakan bentuk upaya meningkatkan kecerdasan dalam bermedia sosial. ',
        '<p style=\"text-align: justify; \">Pergerakan Mahasiswa Islam Indonesia (PMII) Komisariat IAIN Pontianak telah mengadakan Ngaji Media Chapter 1. Kegiatan ini berlangsung secara daring menggunakan platform Zoom Meeting Pada Sabtu dengan Tema \"Kader PMII Perlu Popularitas atau Kepakaran\" (07/08/2021).&nbsp;</p><p style=\"text-align: justify; \">Kajian ini diikuti oleh Keluarga Besar PMII Komisariat IAIN Pontianak dan Kader PMII se-Indonesia berjumlah 50 Orang. Pemateri dalam kegiatan ini Narendra Ning Ampeldenta atau akrab disapa Rake selaku Direktur Kominfo Perhimpunan Pelajar Indonesia (PPI) dan Kader PCI PMII Jerman.&nbsp;</p><p style=\"text-align: justify; \">Sahabat Novianto membuka kajian tersebut dengan mengutip apa yang disampaikan oleh Ketua Umum PB PMII, Gus Abe mengatakan bahwa kader PMII harus menjadi Key Opinion Leader yang dimana ketika ada suatu topik tidak harus melulu menjadi pengikut dari Opini yang dibuat oleh seseorang, ujarnya.</p><p style=\"text-align: justify; \">Kemudian sudah seharusnya kita sebagai kader PMII harus menjadi orang yang terdepan dalam membuat suatu opini yang tentunya sebagai Mahasiswa akademisi harus betul betul mengontrol dan ikut mengawal permasalahan bangsa ini. Maka dari itu tema yang diangkat pada kesempatan tersebut sangat relevan untuk dibahas.</p><p style=\"text-align: justify; \">Selanjutnya, sahabat Rake selaku pemateri Ngaji Media memaparkan “dalam popularitas atau kepakaran adalah satu kesatuan yang tidak terpisahkan dalam menciptakan opini. dalam hal edukasi ke warga netizen perlu memiliki kepakaran dan dalam penyampaian perlu kepopularitasan agar hal ini tercipta suatu kolaborasi yang positif \"tuturnya.</p><p style=\"text-align: justify; \">Kader PCI PMII Jerman mengatakan bahwa penyelenggaraan Ngaji Media ini merupakan bentuk upaya meningkatkan kecerdasan dalam bermedia sosial. Kegiatan ini peserta tidak hanya mendengar materi yang disampaikan akan tetapi peserta juga ikut bertanya dan berdiskusi terkait tema tersebut. Peserta sangat bersemangat dan antusias mengikuti kajian ini dan peserta berharap agar kajian ini dapat berlangsung secara berkelanjutan sampai peserta bisa memahami ilmu yang telah didapatkan.</p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: justify; \">Sumber: <a href=\"https://www.pmiiiainpontianak.or.id/2021/08/perlunya-edukasi-media-pmii-iain.html\" target=\"_blank\">pmiiiainpontianak.or.id</a></p><p style=\"text-align: justify; \"><br></p>',
        '91f36c86d503fca2efb0fa46db377b21.jpg',
        '2021-10-22 17:46:21',
        NULL,
        2,
        'pmii,pmiidev,keindonesiaan,keislaman,kemahasiswaan,kebangsaan',
        'perlunya-edukasi-media--pmii-iain-pontianak-adakan-ngaji-media',
        1,
        2,
        4
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_post_views`

--

CREATE TABLE
    `tbl_post_views` (
        `view_id` int(11) NOT NULL,
        `view_date` timestamp NULL DEFAULT current_timestamp(),
        `view_ip` varchar(50) DEFAULT NULL,
        `view_post_id` int(11) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_post_views`

--

INSERT INTO
    `tbl_post_views` (
        `view_id`,
        `view_date`,
        `view_ip`,
        `view_post_id`
    )
VALUES (
        76,
        '2020-07-28 16:21:13',
        '::1',
        21
    ), (
        77,
        '2020-10-20 16:54:43',
        '::1',
        21
    ), (
        78,
        '2020-11-14 13:44:03',
        '::1',
        21
    ), (
        79,
        '2020-11-15 18:46:15',
        '::1',
        21
    ), (
        80,
        '2020-11-16 05:45:04',
        '::1',
        18
    ), (
        81,
        '2020-11-16 15:05:16',
        '::1',
        20
    ), (
        82,
        '2020-11-16 15:43:04',
        '::1',
        19
    ), (
        83,
        '2020-11-16 17:05:16',
        '::1',
        20
    ), (
        84,
        '2020-11-16 17:05:24',
        '::1',
        21
    ), (
        85,
        '2020-11-16 18:05:02',
        '::1',
        19
    ), (
        86,
        '2020-11-16 18:29:45',
        '::1',
        18
    ), (
        87,
        '2020-11-17 03:20:38',
        '::1',
        22
    ), (
        88,
        '2020-11-21 05:27:58',
        '::1',
        22
    ), (
        89,
        '2020-11-21 05:34:10',
        '::1',
        18
    ), (
        90,
        '2020-11-21 06:15:43',
        '::1',
        19
    ), (
        91,
        '2020-11-21 06:38:27',
        '::1',
        20
    ), (
        92,
        '2020-11-21 17:00:55',
        '::1',
        22
    ), (
        93,
        '2020-11-21 17:03:12',
        '::1',
        18
    ), (
        94,
        '2020-11-21 17:40:27',
        '::1',
        21
    ), (
        95,
        '2020-11-22 10:34:32',
        '::1',
        19
    ), (
        96,
        '2020-11-22 11:42:07',
        '::1',
        20
    ), (
        97,
        '2021-07-01 13:40:40',
        '::1',
        22
    ), (
        98,
        '2021-07-01 14:02:35',
        '::1',
        21
    ), (
        99,
        '2021-07-02 06:22:44',
        '::1',
        21
    ), (
        100,
        '2021-07-03 06:07:16',
        '::1',
        22
    ), (
        101,
        '2021-07-03 06:31:25',
        '::1',
        21
    ), (
        102,
        '2021-07-03 13:40:24',
        '::1',
        18
    ), (
        103,
        '2021-07-03 13:40:52',
        '::1',
        19
    ), (
        104,
        '2021-07-03 15:23:26',
        '::1',
        20
    ), (
        105,
        '2021-07-03 17:02:54',
        '::1',
        22
    ), (
        106,
        '2021-07-03 17:11:15',
        '::1',
        20
    ), (
        107,
        '2021-07-03 17:14:33',
        '::1',
        21
    ), (
        108,
        '2021-07-04 04:41:56',
        '::1',
        19
    ), (
        109,
        '2021-07-04 05:00:05',
        '::1',
        18
    ), (
        110,
        '2021-07-04 09:45:57',
        '::1',
        23
    ), (
        111,
        '2021-07-04 10:36:53',
        '::1',
        24
    ), (
        112,
        '2021-07-04 10:38:58',
        '::1',
        25
    ), (
        113,
        '2021-07-04 10:51:42',
        '::1',
        26
    ), (
        114,
        '2021-07-04 10:52:29',
        '::1',
        27
    ), (
        115,
        '2021-07-04 11:07:30',
        '::1',
        29
    ), (
        116,
        '2021-07-04 11:22:43',
        '::1',
        30
    ), (
        117,
        '2021-07-04 11:23:08',
        '::1',
        28
    ), (
        118,
        '2021-07-07 09:18:27',
        '::1',
        30
    ), (
        119,
        '2021-07-07 10:12:18',
        '::1',
        27
    ), (
        120,
        '2021-07-07 10:19:01',
        '::1',
        25
    ), (
        121,
        '2021-07-24 14:21:43',
        '::1',
        30
    ), (
        122,
        '2021-07-24 16:33:33',
        '::1',
        28
    ), (
        123,
        '2021-07-26 13:17:09',
        '::1',
        30
    ), (
        124,
        '2021-07-26 15:42:11',
        '::1',
        27
    ), (
        125,
        '2021-07-26 15:52:11',
        '::1',
        25
    ), (
        126,
        '2021-07-26 16:01:51',
        '::1',
        23
    ), (
        127,
        '2021-07-26 16:10:44',
        '::1',
        29
    ), (
        128,
        '2021-07-26 17:36:25',
        '::1',
        33
    ), (
        129,
        '2021-07-26 17:42:10',
        '::1',
        31
    ), (
        130,
        '2021-07-27 03:18:13',
        '::1',
        32
    ), (
        131,
        '2021-07-27 03:20:08',
        '::1',
        28
    ), (
        132,
        '2021-07-27 03:20:32',
        '::1',
        24
    ), (
        133,
        '2021-07-29 10:35:41',
        '::1',
        32
    ), (
        134,
        '2021-07-29 11:06:55',
        '::1',
        33
    ), (
        135,
        '2021-07-29 11:07:47',
        '::1',
        24
    ), (
        136,
        '2021-07-29 11:07:59',
        '::1',
        23
    ), (
        137,
        '2021-07-30 10:21:56',
        '::1',
        28
    ), (
        138,
        '2021-07-30 10:28:44',
        '::1',
        33
    ), (
        139,
        '2021-07-30 10:29:02',
        '::1',
        23
    ), (
        140,
        '2021-07-30 11:42:20',
        '::1',
        31
    ), (
        141,
        '2021-07-30 17:13:03',
        '::1',
        33
    ), (
        142,
        '2021-08-18 17:03:58',
        '::1',
        33
    ), (
        143,
        '2021-08-31 18:35:19',
        '::1',
        33
    ), (
        144,
        '2021-09-04 17:07:00',
        '::1',
        33
    ), (
        145,
        '2021-10-22 15:12:33',
        '::1',
        32
    ), (
        146,
        '2021-10-22 15:50:21',
        '::1',
        33
    ), (
        147,
        '2021-10-22 16:17:10',
        '::1',
        24
    ), (
        148,
        '2021-10-22 17:48:56',
        '::1',
        3
    ), (
        149,
        '2021-10-22 17:50:40',
        '::1',
        2
    ), (
        150,
        '2021-11-15 15:22:53',
        '::1',
        2
    ), (
        151,
        '2022-11-07 00:42:23',
        '::1',
        1
    ), (
        152,
        '2022-11-07 00:42:43',
        '::1',
        2
    ), (
        153,
        '2022-11-07 00:42:52',
        '::1',
        3
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_site`

--

CREATE TABLE
    `tbl_site` (
        `site_id` int(11) NOT NULL,
        `site_name` varchar(100) DEFAULT NULL,
        `site_title` varchar(200) DEFAULT NULL,
        `site_description` text DEFAULT NULL,
        `site_favicon` varchar(50) DEFAULT NULL,
        `site_logo_header` varchar(50) DEFAULT NULL,
        `site_logo_footer` varchar(50) DEFAULT NULL,
        `site_logo_big` varchar(50) DEFAULT NULL,
        `site_facebook` varchar(150) DEFAULT NULL,
        `site_twitter` varchar(150) DEFAULT NULL,
        `site_instagram` varchar(150) DEFAULT NULL,
        `site_pinterest` varchar(150) DEFAULT NULL,
        `site_linkedin` varchar(150) DEFAULT NULL,
        `site_wa` varchar(15) DEFAULT NULL,
        `site_mail` varchar(150) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_site`

--

INSERT INTO
    `tbl_site` (
        `site_id`,
        `site_name`,
        `site_title`,
        `site_description`,
        `site_favicon`,
        `site_logo_header`,
        `site_logo_footer`,
        `site_logo_big`,
        `site_facebook`,
        `site_twitter`,
        `site_instagram`,
        `site_pinterest`,
        `site_linkedin`,
        `site_wa`,
        `site_mail`
    )
VALUES (
        1,
        'PMII',
        'PK PMII STMIK Tasikmalaya',
        'Website Resmi Pengurus Komisariat Pergerakan Mahasiswa Islam Indonesia STMIK Tasikmalaya',
        'favicon1.png',
        'apple-touch-icon2.png',
        'favicon.png',
        'logobig.jpg',
        'https://www.facebook.com/dosenirham',
        'https://twitter.com/bro_irham',
        'https://www.instagram.com/bro_irham',
        'Jl. Taman Amir Hamzah No.5, Menteng, Jakarta Pusat ',
        'https://www.linkedin.com/in/irchamali',
        '6285000111222',
        'info@rayonpmii.id'
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_subscribe`

--

CREATE TABLE
    `tbl_subscribe` (
        `subscribe_id` int(11) NOT NULL,
        `subscribe_email` varchar(100) DEFAULT NULL,
        `subscribe_created_at` timestamp NULL DEFAULT current_timestamp(),
        `subscribe_status` int(11) DEFAULT 0,
        `subscribe_rating` int(11) DEFAULT 0
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_tags`

--

CREATE TABLE
    `tbl_tags` (
        `tag_id` int(11) NOT NULL,
        `tag_name` varchar(200) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_tags`

--

INSERT INTO
    `tbl_tags` (`tag_id`, `tag_name`)
VALUES (1, 'pmii'), (2, 'pmiidev'), (3, 'pmiimedia'), (4, 'pmiimaju'), (7, 'pmiimendunia'), (8, 'keindonesiaan'), (9, 'keislaman'), (10, 'kemahasiswaan'), (11, 'kebangsaan'), (12, 'pemuda');

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_team`

--

CREATE TABLE
    `tbl_team` (
        `team_id` int(11) NOT NULL,
        `team_name` varchar(50) DEFAULT NULL,
        `team_org` varchar(50) DEFAULT NULL,
        `team_content` text DEFAULT NULL,
        `team_image` varchar(50) DEFAULT NULL,
        `team_twitter` varchar(50) DEFAULT NULL,
        `team_facebook` varchar(50) DEFAULT NULL,
        `team_instagram` varchar(50) DEFAULT NULL,
        `team_linked` varchar(50) DEFAULT NULL,
        `team_created_at` timestamp NULL DEFAULT current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data untuk tabel `tbl_team`

--

INSERT INTO
    `tbl_team` (
        `team_id`,
        `team_name`,
        `team_org`,
        `team_content`,
        `team_image`,
        `team_twitter`,
        `team_facebook`,
        `team_instagram`,
        `team_linked`,
        `team_created_at`
    )
VALUES (
        1,
        'Ade Salamun',
        'Ketua',
        '',
        'd3528d89254950eb597bdf3014f4f5e6.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 09:37:35'
    ), (
        2,
        'Marwan Mujahidin',
        'Wakil Ketua I',
        '',
        'cec32fd5691d82c9f316ef590515cf98.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 09:38:56'
    ), (
        3,
        'Hilman Latief',
        'Wakil Ketua II',
        '',
        '4197cf7cc36b9de385718a756bbde482.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 09:39:57'
    ), (
        4,
        'M. Abdurrouf',
        'Wakil Ketua III',
        '',
        '1e2877cbba655720abee419958e61e1a.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 09:40:51'
    ), (
        5,
        'Angga Nugraha',
        'Sekretaris ',
        '',
        'f6be4b85f6bb24ad5bf6c244ea2f22d6.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 09:51:25'
    ), (
        6,
        'Tjaturadi Walujo',
        'Wakil Sekretaris I',
        '',
        'a5a90ee96778be37f4e2af3704001df6.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 09:52:29'
    ), (
        7,
        'Amin sudarsono',
        'Wakil Sekretaris II',
        '',
        '763676a64e4d5d512e551f2bbffefae0.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:03:00'
    ), (
        8,
        'Edi Muktiono',
        'Wakil Sekretaris III',
        '',
        '90e475fa3300aae710054f796249a873.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:03:53'
    ), (
        9,
        'Muhammad Furqon',
        'Bendahara',
        '',
        '57b09176ff076a9280acc3d6c68978f3.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:04:27'
    ), (
        10,
        'Syahrudin C Asho',
        'Departemen I',
        '',
        '50e24eaea0e4569ece68d2bc190455f7.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:05:31'
    ), (
        11,
        'Yudi Wahyudi',
        'Departemen I',
        '',
        'f78202759ef82b0a9a62885b915991a5.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:05:59'
    ), (
        12,
        'Aep Saefulloh',
        'Departemen I',
        '',
        '9945179812b9b940c887e31a0fb09cfe.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:06:34'
    ), (
        13,
        'Supendi ',
        'Departemen II',
        '',
        '3986d3e196901e10955eb8db8031d019.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:07:00'
    ), (
        14,
        'Ade Syarifudin Allam',
        ' Departemen II',
        '',
        '3467c14106766c69ab61559a4a07acee.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:07:40'
    ), (
        15,
        'Hidayat ',
        'Departemen II',
        '',
        '5b6d762b3887fe00b4726a524ac01780.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:08:05'
    ), (
        16,
        'Sukron Maskur ',
        'Departemen II',
        '',
        'fefa461adad475e5bdeface1147897a5.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:08:29'
    ), (
        17,
        'Muhammad Hafiz ',
        'Departemen III',
        '',
        '0fb030b848f7204e88b7777f83918f2b.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:08:53'
    ), (
        18,
        'Slamet Tuhari ',
        'Departemen III',
        '',
        '6cd6956a1dc11383292a8a100c939ad5.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:09:17'
    ), (
        19,
        'Barman Wahidatan ',
        'Departemen III',
        '',
        '772dc5e16858f7056aff382e57abffba.jpg',
        'https://twitter.com/',
        'https://facebook.com/',
        'https://instagram.com/',
        'https://linkedin.com/',
        '2021-08-10 10:09:39'
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_testimonial`

--

CREATE TABLE
    `tbl_testimonial` (
        `testimonial_id` int(11) NOT NULL,
        `testimonial_name` varchar(50) DEFAULT NULL,
        `testimonial_org` varchar(50) DEFAULT NULL,
        `testimonial_content` text DEFAULT NULL,
        `testimonial_image` varchar(50) DEFAULT NULL,
        `testimonial_created_at` timestamp NULL DEFAULT current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_testimonial`

--

INSERT INTO
    `tbl_testimonial` (
        `testimonial_id`,
        `testimonial_name`,
        `testimonial_org`,
        `testimonial_content`,
        `testimonial_image`,
        `testimonial_created_at`
    )
VALUES (
        1,
        'Angga Nugraha',
        'PR PMII Teknik',
        'PMII telah memadukan potensi jaringan antar pengelola organisasi untuk menjadi kekuatan yang menyatukan strategi pemberdayaan melalui kaderisasi.',
        '3ff07ca20e7acd5ca7bff893ac043c68.png',
        '2021-07-30 09:48:07'
    ), (
        2,
        'Tan Sukma',
        'PR PMII Saintek',
        'Gerakan kami untuk mendorong berbagai  usaha pengembangan ekonomi produktif yang berkelanjutan. Melakukan upaya pengembangan SDM dalam bidang pengelolaan UMKM.',
        'e497eda35658c5984707fa25eb945b8e.png',
        '2021-07-30 09:57:52'
    ), (
        3,
        'Edi Muktiono',
        'PR PMII Eksakta',
        'PMII membangun jaringan dan kerjasama guna membangun hubungan aspiratif dengan pemerintah. Dengan kerjasama yang baik dengan pengelola gerakan nasional dan internasional.',
        '0cbf1a5492b39e3a92288117f8487eb5.png',
        '2021-07-30 10:02:22'
    ), (
        4,
        'Dewi Sri',
        'PR PMII Algoritma',
        'Ikhtiar kami untuk mewujudkan organisasi pengelola rayon yang transparan, amanah dan profesional untuk meningkatkan taraf kehidupan masyarakat yang sejahtera.',
        '0082e8fdb74eb6c977c3aa25bd45418f.png',
        '2021-07-30 10:03:50'
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_user`

--

CREATE TABLE
    `tbl_user` (
        `user_id` int(11) NOT NULL,
        `user_name` varchar(100) DEFAULT NULL,
        `user_email` varchar(60) DEFAULT NULL,
        `user_password` varchar(40) DEFAULT NULL,
        `user_level` varchar(10) DEFAULT NULL,
        `user_status` varchar(10) DEFAULT '1',
        `user_photo` varchar(40) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_user`

--

INSERT INTO
    `tbl_user` (
        `user_id`,
        `user_name`,
        `user_email`,
        `user_password`,
        `user_level`,
        `user_status`,
        `user_photo`
    )
VALUES (
        4,
        'Author Dev',
        'author@gmail.com',
        '6de37e2ac5eb524e32ceff7599dbabae',
        '2',
        '1',
        '4894343ac02c28e5f292e7fa60ba447b.png'
    ), (
        5,
        'Admin Dev',
        'admin@gmail.com',
        '45f0d53693e62c673f066f383694e530',
        '1',
        '1',
        '225fc323cfd8ddae21b10991a6468916.png'
    );

-- --------------------------------------------------------

--

-- Struktur dari tabel `tbl_visitors`

--

CREATE TABLE
    `tbl_visitors` (
        `visit_id` int(11) NOT NULL,
        `visit_date` timestamp NULL DEFAULT current_timestamp(),
        `visit_ip` varchar(50) DEFAULT NULL,
        `visit_platform` varchar(100) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Dumping data untuk tabel `tbl_visitors`

--

INSERT INTO
    `tbl_visitors` (
        `visit_id`,
        `visit_date`,
        `visit_ip`,
        `visit_platform`
    )
VALUES (
        541327,
        '2019-03-18 14:07:36',
        '::1',
        'Firefox'
    ), (
        541328,
        '2019-03-19 03:33:51',
        '::1',
        'Chrome'
    ), (
        541329,
        '2019-03-20 01:00:19',
        '::1',
        'Chrome'
    ), (
        541330,
        '2019-04-05 01:53:28',
        '::1',
        'Firefox'
    ), (
        541331,
        '2019-04-06 01:37:35',
        '::1',
        'Chrome'
    ), (
        541332,
        '2019-04-06 23:04:12',
        '::1',
        'Chrome'
    ), (
        541333,
        '2019-04-09 12:19:32',
        '::1',
        'Chrome'
    ), (
        541334,
        '2019-04-10 01:33:03',
        '::1',
        'Chrome'
    ), (
        541335,
        '2019-04-11 03:30:38',
        '::1',
        'Chrome'
    ), (
        541336,
        '2019-04-11 03:30:38',
        '::1',
        'Chrome'
    ), (
        541337,
        '2019-04-12 03:51:42',
        '::1',
        'Chrome'
    ), (
        541338,
        '2019-04-12 21:55:51',
        '::1',
        'Chrome'
    ), (
        541339,
        '2019-04-14 01:30:40',
        '::1',
        'Chrome'
    ), (
        541340,
        '2019-04-15 01:42:53',
        '::1',
        'Chrome'
    ), (
        541341,
        '2019-05-08 02:07:09',
        '::1',
        'Chrome'
    ), (
        541342,
        '2019-05-21 05:55:14',
        '::1',
        'Firefox'
    ), (
        541343,
        '2019-08-28 07:08:22',
        '::1',
        'Firefox'
    ), (
        541344,
        '2019-12-17 06:04:57',
        '::1',
        'Firefox'
    ), (
        541345,
        '2019-12-18 01:34:25',
        '::1',
        'Firefox'
    ), (
        541346,
        '2019-12-19 02:21:23',
        '::1',
        'Firefox'
    ), (
        541347,
        '2019-12-20 07:47:00',
        '::1',
        'Firefox'
    ), (
        541348,
        '2019-12-28 02:58:34',
        '::1',
        'Firefox'
    ), (
        541349,
        '2019-12-29 08:48:39',
        '::1',
        'Firefox'
    ), (
        541350,
        '2019-12-30 03:24:04',
        '::1',
        'Firefox'
    ), (
        541351,
        '2019-12-31 02:47:15',
        '::1',
        'Firefox'
    ), (
        541352,
        '2020-01-01 02:24:55',
        '::1',
        'Firefox'
    ), (
        541353,
        '2020-01-02 01:58:25',
        '::1',
        'Firefox'
    ), (
        541354,
        '2020-01-03 03:15:30',
        '::1',
        'Firefox'
    ), (
        541355,
        '2020-01-04 03:31:49',
        '::1',
        'Firefox'
    ), (
        541356,
        '2020-01-05 06:58:35',
        '127.0.0.1',
        'Firefox'
    ), (
        541357,
        '2020-01-06 06:03:25',
        '::1',
        'Firefox'
    ), (
        541358,
        '2020-01-07 00:57:59',
        '::1',
        'Firefox'
    ), (
        541359,
        '2020-01-08 05:53:44',
        '::1',
        'Firefox'
    ), (
        541360,
        '2020-01-12 04:18:15',
        '::1',
        'Firefox'
    ), (
        541361,
        '2020-01-27 13:54:20',
        '::1',
        'Chrome'
    ), (
        541362,
        '2020-01-27 17:03:12',
        '::1',
        'Chrome'
    ), (
        541363,
        '2020-01-29 06:16:34',
        '::1',
        'Chrome'
    ), (
        541364,
        '2020-01-29 17:07:41',
        '::1',
        'Chrome'
    ), (
        541365,
        '2020-02-01 07:10:48',
        '::1',
        'Chrome'
    ), (
        541366,
        '2020-02-08 04:10:12',
        '::1',
        'Chrome'
    ), (
        541367,
        '2020-03-23 11:34:09',
        '::1',
        'Chrome'
    ), (
        541368,
        '2020-04-10 16:29:23',
        '::1',
        'Chrome'
    ), (
        541369,
        '2020-04-11 13:57:38',
        '::1',
        'Chrome'
    ), (
        541370,
        '2020-04-16 06:37:49',
        '::1',
        'Chrome'
    ), (
        541371,
        '2020-04-20 12:31:53',
        '::1',
        'Chrome'
    ), (
        541372,
        '2020-07-11 13:37:15',
        '::1',
        'Chrome'
    ), (
        541373,
        '2020-07-27 10:39:05',
        '::1',
        'Chrome'
    ), (
        541374,
        '2020-07-28 03:21:12',
        '::1',
        'Chrome'
    ), (
        541375,
        '2020-10-18 16:51:19',
        '::1',
        'Chrome'
    ), (
        541376,
        '2020-10-19 03:59:15',
        '::1',
        'Chrome'
    ), (
        541377,
        '2020-10-20 05:15:15',
        '::1',
        'Chrome'
    ), (
        541378,
        '2020-10-20 17:05:05',
        '::1',
        'Chrome'
    ), (
        541379,
        '2020-10-22 00:42:32',
        '::1',
        'Chrome'
    ), (
        541380,
        '2020-10-23 16:47:35',
        '::1',
        'Chrome'
    ), (
        541381,
        '2020-11-06 10:22:09',
        '::1',
        'Chrome'
    ), (
        541382,
        '2020-11-14 05:17:18',
        '::1',
        'Chrome'
    ), (
        541383,
        '2020-11-14 17:06:44',
        '::1',
        'Chrome'
    ), (
        541384,
        '2020-11-15 17:00:03',
        '::1',
        'Chrome'
    ), (
        541385,
        '2020-11-16 17:05:16',
        '::1',
        'Chrome'
    ), (
        541386,
        '2020-11-18 04:08:49',
        '::1',
        'Chrome'
    ), (
        541387,
        '2020-11-19 13:09:52',
        '::1',
        'Chrome'
    ), (
        541388,
        '2020-11-19 17:45:32',
        '::1',
        'Chrome'
    ), (
        541389,
        '2020-11-21 05:06:14',
        '::1',
        'Chrome'
    ), (
        541390,
        '2020-11-21 17:00:54',
        '::1',
        'Chrome'
    ), (
        541391,
        '2020-12-26 14:24:04',
        '::1',
        'Chrome'
    ), (
        541392,
        '2021-07-01 13:35:17',
        '::1',
        'Chrome'
    ), (
        541393,
        '2021-07-01 17:57:09',
        '::1',
        'Chrome'
    ), (
        541394,
        '2021-07-03 05:04:57',
        '::1',
        'Chrome'
    ), (
        541395,
        '2021-07-03 17:02:54',
        '::1',
        'Chrome'
    ), (
        541396,
        '2021-07-07 09:18:16',
        '::1',
        'Chrome'
    ), (
        541397,
        '2021-07-15 02:37:30',
        '::1',
        'Chrome'
    ), (
        541398,
        '2021-07-17 05:19:51',
        '::1',
        'Chrome'
    ), (
        541399,
        '2021-07-18 15:11:33',
        '::1',
        'Chrome'
    ), (
        541400,
        '2021-07-20 07:41:24',
        '::1',
        'Chrome'
    ), (
        541401,
        '2021-07-24 11:47:28',
        '::1',
        'Chrome'
    ), (
        541402,
        '2021-07-25 05:19:56',
        '::1',
        'Chrome'
    ), (
        541403,
        '2021-07-26 00:55:45',
        '::1',
        'Chrome'
    ), (
        541404,
        '2021-07-26 17:34:56',
        '::1',
        'Chrome'
    ), (
        541405,
        '2021-07-29 09:48:11',
        '::1',
        'Chrome'
    ), (
        541406,
        '2021-07-30 07:37:48',
        '::1',
        'Chrome'
    ), (
        541407,
        '2021-07-30 17:13:03',
        '::1',
        'Chrome'
    ), (
        541408,
        '2021-08-11 08:18:27',
        '::1',
        'Chrome'
    ), (
        541409,
        '2021-08-17 18:34:52',
        '::1',
        'Chrome'
    ), (
        541410,
        '2021-08-18 17:03:10',
        '::1',
        'Chrome'
    ), (
        541411,
        '2021-08-19 17:02:58',
        '::1',
        'Chrome'
    ), (
        541412,
        '2021-08-20 17:22:43',
        '::1',
        'Chrome'
    ), (
        541413,
        '2021-08-22 09:32:28',
        '::1',
        'Chrome'
    ), (
        541414,
        '2021-08-23 03:36:58',
        '::1',
        'Chrome'
    ), (
        541415,
        '2021-08-27 02:48:46',
        '::1',
        'Chrome'
    ), (
        541416,
        '2021-08-31 18:35:04',
        '::1',
        'Chrome'
    ), (
        541417,
        '2021-09-02 01:57:14',
        '::1',
        'Chrome'
    ), (
        541418,
        '2021-09-04 17:06:47',
        '::1',
        'Chrome'
    ), (
        541419,
        '2021-10-02 15:28:31',
        '::1',
        'Chrome'
    ), (
        541420,
        '2021-10-12 17:59:47',
        '::1',
        'Chrome'
    ), (
        541421,
        '2021-10-21 15:56:53',
        '::1',
        'Chrome'
    ), (
        541422,
        '2021-10-21 17:00:19',
        '::1',
        'Chrome'
    ), (
        541423,
        '2021-10-22 17:05:50',
        '::1',
        'Chrome'
    ), (
        541424,
        '2021-11-15 15:14:32',
        '::1',
        'Chrome'
    ), (
        541425,
        '2022-11-07 00:37:20',
        '::1',
        'Chrome 107.0.0.0'
    );

--

-- Indexes for dumped tables

--

--

-- Indeks untuk tabel `tbl_about`

--

ALTER TABLE `tbl_about` ADD PRIMARY KEY (`about_id`);

--

-- Indeks untuk tabel `tbl_category`

--

ALTER TABLE `tbl_category` ADD PRIMARY KEY (`category_id`);

--

-- Indeks untuk tabel `tbl_comment`

--

ALTER TABLE `tbl_comment` ADD PRIMARY KEY (`comment_id`);

--

-- Indeks untuk tabel `tbl_home`

--

ALTER TABLE `tbl_home` ADD PRIMARY KEY (`home_id`);

--

-- Indeks untuk tabel `tbl_inbox`

--

ALTER TABLE `tbl_inbox` ADD PRIMARY KEY (`inbox_id`);

--

-- Indeks untuk tabel `tbl_member`

--

ALTER TABLE `tbl_member` ADD PRIMARY KEY (`member_id`);

--

-- Indeks untuk tabel `tbl_navbar`

--

ALTER TABLE `tbl_navbar` ADD PRIMARY KEY (`navbar_id`);

--

-- Indeks untuk tabel `tbl_post`

--

ALTER TABLE `tbl_post` ADD PRIMARY KEY (`post_id`);

--

-- Indeks untuk tabel `tbl_post_views`

--

ALTER TABLE `tbl_post_views` ADD PRIMARY KEY (`view_id`);

--

-- Indeks untuk tabel `tbl_site`

--

ALTER TABLE `tbl_site` ADD PRIMARY KEY (`site_id`);

--

-- Indeks untuk tabel `tbl_subscribe`

--

ALTER TABLE `tbl_subscribe` ADD PRIMARY KEY (`subscribe_id`);

--

-- Indeks untuk tabel `tbl_tags`

--

ALTER TABLE `tbl_tags` ADD PRIMARY KEY (`tag_id`);

--

-- Indeks untuk tabel `tbl_team`

--

ALTER TABLE `tbl_team` ADD PRIMARY KEY (`team_id`);

--

-- Indeks untuk tabel `tbl_testimonial`

--

ALTER TABLE `tbl_testimonial` ADD PRIMARY KEY (`testimonial_id`);

--

-- Indeks untuk tabel `tbl_user`

--

ALTER TABLE `tbl_user` ADD PRIMARY KEY (`user_id`);

--

-- Indeks untuk tabel `tbl_visitors`

--

ALTER TABLE `tbl_visitors` ADD PRIMARY KEY (`visit_id`);

--

-- AUTO_INCREMENT untuk tabel yang dibuang

--

--

-- AUTO_INCREMENT untuk tabel `tbl_about`

--

ALTER TABLE
    `tbl_about` MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--

-- AUTO_INCREMENT untuk tabel `tbl_category`

--

ALTER TABLE
    `tbl_category` MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--

-- AUTO_INCREMENT untuk tabel `tbl_comment`

--

ALTER TABLE
    `tbl_comment` MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--

-- AUTO_INCREMENT untuk tabel `tbl_home`

--

ALTER TABLE
    `tbl_home` MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--

-- AUTO_INCREMENT untuk tabel `tbl_inbox`

--

ALTER TABLE
    `tbl_inbox` MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT untuk tabel `tbl_member`

--

ALTER TABLE
    `tbl_member` MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT untuk tabel `tbl_navbar`

--

ALTER TABLE
    `tbl_navbar` MODIFY `navbar_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 22;

--

-- AUTO_INCREMENT untuk tabel `tbl_post`

--

ALTER TABLE
    `tbl_post` MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--

-- AUTO_INCREMENT untuk tabel `tbl_post_views`

--

ALTER TABLE
    `tbl_post_views` MODIFY `view_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 154;

--

-- AUTO_INCREMENT untuk tabel `tbl_site`

--

ALTER TABLE
    `tbl_site` MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--

-- AUTO_INCREMENT untuk tabel `tbl_subscribe`

--

ALTER TABLE
    `tbl_subscribe` MODIFY `subscribe_id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT untuk tabel `tbl_tags`

--

ALTER TABLE
    `tbl_tags` MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--

-- AUTO_INCREMENT untuk tabel `tbl_team`

--

ALTER TABLE
    `tbl_team` MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 20;

--

-- AUTO_INCREMENT untuk tabel `tbl_testimonial`

--

ALTER TABLE
    `tbl_testimonial` MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;

--

-- AUTO_INCREMENT untuk tabel `tbl_user`

--

ALTER TABLE
    `tbl_user` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT untuk tabel `tbl_visitors`

--

ALTER TABLE
    `tbl_visitors` MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 541426;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;