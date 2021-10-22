<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $site_name; ?> | <?= $site_title; ?></title>
    <meta content="<?= $site_desc; ?>" name="description">
    <meta content="PMII, PR, PK, PC, PKC, PB, Pergerakan Mahasiswa Islam Indonesia" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/frontend/img/favicon.png" rel="icon">
    <link href="<?= base_url() ?>assets/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/frontend/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/frontend/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: BizLand - v3.5.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?= $header; ?>
    <!-- End Header -->

    <main id="main" data-aos="fade-up">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Inner Page</h2>
                    <ol>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li>Inner Page</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <h3>Kontak<span> Rayon</span></h3>
                    <p>Pergerakan Mahasiswa Islam Indonesia</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Alamat</h3>
                            <p><?= $site_loc; ?></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email</h3>
                            <p><?= $site_mail; ?></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>WhatsApp</h3>
                            <p><?= $site_wa; ?></p>
                        </div>
                    </div>

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-12 md-6">
                        <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4594555269905!2d106.84882731476908!3d-6.202960995509508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f46f1aa68feb%3A0x1025d8e539e14ede!2sNahdlatul%20Ulama%20University%20of%20Indonesia!5e0!3m2!1sen!2sid!4v1634883199767!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                    </div>

                </div>

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?= $footer; ?>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/frontend/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/purecounter/purecounter.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/frontend/js/main.js"></script>

</body>

</html>