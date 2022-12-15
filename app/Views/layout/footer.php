<footer id="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h4>Dapatkan informasi terbaru dari kami</h4>
                    <form action="/subscribe" method="post">
                        <input type="email" name="email" placeholder="Insert your email" required>
                        <input type="submit" value="Subscribe">
                    </form>
                    <?php if (session()->getFlashData('pesan') || session()->getFlashData('peringatan')) : ?>
                        <div class="alert alert-<?= session()->getFlashData('pesan') ? "success" : "warning" ?> alert-dismissible fade show  mb-0" role="alert">
                            <?= session()->getFlashData('pesan') ?? session()->getFlashdata('peringatan') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3><span><?= $site['site_title']; ?></span></h3>
                    <p>
                        <?= $about['about_alamat']; ?><br>
                        <strong>Phone:</strong> <a href="tel:+<?= $site['site_wa']; ?>"><?= $site['site_wa']; ?></a><br>
                        <strong>Email:</strong> <a href="mailto:<?= $site['site_mail']; ?>"><?= $site['site_mail']; ?></a><br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/#about">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/gallery">Galery</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/team">Team</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/document">Document</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/contact">Contact</a></li>
                    </ul>
                </div>
                <?php
                // Mengambil data Category
                use App\Models\CategoryModel;

                $categoryModel = new CategoryModel();
                $categories = $categoryModel->findAll();
                ?>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Information</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/post">All Post</a></li>
                        <?php foreach ($categories as $category) : ?>
                            <li><i class="bx bx-chevron-right"></i> <a href="/category/<?= $category['category_slug']; ?>"><?= $category['category_name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p>Sosial Media <?= $site['site_title']; ?></p>
                    <div class="social-links mt-3">
                        <a href="<?= $site['site_instagram']; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="<?= $site['site_facebook']; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="<?= $site['site_twitter']; ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="<?= $site['site_linkedin']; ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>PMIIDev</span></strong> <?= date('Y') ?>
        </div>
        <div class="credits">
            Designed by <a href="https://instagram.com/pmiidev">PMIIDev</a>
        </div>
    </div>
</footer>
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- plugins JS Files -->
<script src="/assets/frontend/plugins/aos/aos.js"></script>
<script src="/assets/frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/frontend/plugins/glightbox/js/glightbox.min.js"></script>
<script src="/assets/frontend/plugins/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/frontend/plugins/php-email-form/validate.js"></script>
<script src="/assets/frontend/plugins/purecounter/purecounter.js"></script>
<script src="/assets/frontend/plugins/swiper/swiper-bundle.min.js"></script>
<script src="/assets/frontend/plugins/waypoints/noframework.waypoints.js"></script>

<!-- Template Main JS File -->
<script src="/assets/frontend/js/main.js"></script>

</body>

</html>