<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</section>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url() . 'assets/frontend/images/' . $logo; ?>"> <span><?= $site_name; ?></span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="<?= base_url() ?>#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="<?= base_url() ?>#about">About</a></li>
                <li><a class="nav-link scrollto " href="<?= base_url() ?>gallery">Gallery</a></li>
                <li><a class="nav-link scrollto" href="<?= base_url() ?>team">Team</a></li>
                <li class="dropdown"><a href="#"><span>News</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Berita</a></li>
                        <li><a href="#">Opini</a></li>
                        <li><a href="#">Cerpen</a></li>
                        <li><a href="#">Puisi</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="<?= base_url() ?>document">Document</a></li>
                <li><a class="nav-link scrollto" href="<?= base_url() ?>contact">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>