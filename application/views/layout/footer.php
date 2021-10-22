<footer id="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h4>Dapatkan informasi terbaru dari kami</h4>
                    <form action="<?= site_url('subscribe'); ?>" method="post">
                        <input type="hidden" name="url" value="<?php echo site_url(); ?>" required>
                        <input type="email" name="email" placeholder="Insert your email">
                        <input type="submit" value="Subscribe">
                    </form>
                </div>
                <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Halo Sahabat!</strong> <?php echo $this->session->flashdata('message'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Rayon<span>.</span></h3>
                    <p>
                        Jl. Taman Amir Hamzah <br>
                        Pegangsaan, Menteng<br>
                        Central Jakarta <br><br>
                        <strong>Phone:</strong> <?= $site_wa; ?><br>
                        <strong>Email:</strong> <?= $site_mail; ?><br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Galery</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Team</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Information</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">News</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Opinion</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">History</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Propaganda</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p>Sosial Media <?= $site_title; ?></p>
                    <div class="social-links mt-3">
                        <a href="<?= $site_ig; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="<?= $site_fb; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="<?= $site_twit; ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="<?= $site_linked; ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
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