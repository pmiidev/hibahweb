<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2><?= $title; ?></h2>
                <h3><span><?= $about['about_name']; ?></span></h3>
                <p>Halaman ini berisi foto-foto dari postingan-postingan kader PMII berupa berita, opini, materi, dll</p>
            </div><br>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($posts as $post) : ?>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= date('d M Y', strtotime($post['post_date'])); ?></h4>
                            <p><?= $post['post_title']; ?></p>
                            <a href="/assets/backend/images/post/<?= $post['post_image']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?= $post['post_title']; ?>"><i class="bx bx-plus"></i></a>
                            <a href="/post/<?= $post['post_slug']; ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection(); ?>