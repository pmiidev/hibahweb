<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2><?= $title; ?></h2>
                <h3><span><?= $about['about_name']; ?></span></h3>
                <p>Halaman ini berisi narahubung dan profil organisasi untuk menjalin komunikasi atau lain sebagainya</p>
            </div><br>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Alamat</h3>
                        <a href="https://goo.gl/maps/yNZWhx9ySUwc5gVg9" target="_blank"><?= $about['about_alamat']; ?></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email</h3>
                        <a href="mailto:<?= $site['site_mail']; ?>"><?= $site['site_mail']; ?></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>WhatsApp</h3>
                        <a href="tel:+<?= $site['site_wa']; ?>"><?= $site['site_wa']; ?></a>
                    </div>
                </div>

            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-12 md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.4083494201277!2d108.20421701379742!3d-7.307937373874869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f50c5effef495%3A0x573420e273c62448!2sSTMIK%20Tasikmalaya!5e0!3m2!1sid!2sid!4v1667809312869!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
            <div id="message-box" class="row bg-dark text-light mt-3 p-2" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-center mb-0">Message Box</h3>
                <?php if (session()->getFlashData('success') || session()->getFlashData('danger')) : ?>
                    <div class="alert alert-<?= session()->getFlashData('success') ? "success" : "warning" ?> alert-dismissible fade show  my-2" role="alert">
                        <?= session()->getFlashData('success') ?? session()->getFlashdata('danger') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal mt-3" action="/contact" method="post" enctype="multipart/form-data">
                    <div class="row mb-2">
                        <label for="inbox_name" class="col-md-2 control-label">Nama</label>
                        <div class="col-md-10">
                            <input type="text" name="inbox_name" class="form-control" id="inbox_name" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inbox_email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" name="inbox_email" class="form-control" id="inbox_email" placeholder="nama@email.xxx" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inbox_subject" class="col-md-2 control-label">Subject</label>
                        <div class="col-md-10">
                            <input type="text" name="inbox_subject" class="form-control" id="inbox_subject" placeholder="Subjet Pesan" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inbox_message" class="col-md-2 control-label">Message</label>
                        <div class="col-md-10">
                            <textarea name="inbox_message" id="inbox_message" class="form-control" rows="3" placeholder="Isi pesan..." required></textarea>
                        </div>
                    </div>
                    <div class="row my-2 px-2 ">
                        <button type="submit" class="btn btn-primary col-md-3 ms-md-auto me-2">Submit Message</button>
                    </div>
                </form>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection(); ?>