<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:<?= $site_mail; ?>"><?= $site_mail; ?></a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span><?= $site_wa; ?></span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="<?= $site_ig; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="<?= $site_fb; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="<?= $site_twit; ?>" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="<?= $site_linked; ?>" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</section>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="/"><img src="<?= '/assets/frontend/images/' . $logo; ?>"> <span><?= $site_name; ?></span></a></h1>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto " href="/gallery">Gallery</a></li>
                <li><a class="nav-link scrollto" href="/team">Team</a></li>
                <li class="dropdown"><a href="/post"><span>News</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/category/news">Berita</a></li>
                        <li><a href="/category/opinion">Opini</a></li>
                        <li><a href="#">Cerpen</a></li>
                        <li><a href="#">Puisi</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="/document">Document</a></li>
                <li><a class="nav-link scrollto" href="/contact">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>