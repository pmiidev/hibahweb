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
                        <li><?= $title; ?></li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Gallery</h2>
                    <h3>Galeri <span>Rayon</span></h3>
                    <p>Pergerakan Mahasiswa Islam Indonesia</p>
                </div><br>

                <!-- <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div> -->

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    <?php foreach ($data->result() as $apost) : ?>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                            <img src="<?= base_url() . 'assets/backend/images/thumb/' . $apost->post_image; ?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4><?php echo date('d M Y', strtotime($apost->post_date)); ?></h4>
                                <p><?php echo $apost->post_title; ?></p>
                                <a href="<?= base_url() . 'assets/backend/images/thumb/' . $apost->post_image; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?php echo $apost->post_title; ?>"><i class="bx bx-plus"></i></a>
                                <a href="<?= site_url('post/' . $apost->post_slug); ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
    <script src="assets/frontend/vendor/aos/aos.js"></script>
    <script src="assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/frontend/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/frontend/vendor/php-email-form/validate.js"></script>
    <script src="assets/frontend/vendor/purecounter/purecounter.js"></script>
    <script src="assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/frontend/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/frontend/js/main.js"></script>

</body>

</html>