<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2 class="text-center"><?= $keyword; ?></h2>
            </header><br>

            <div class="row">
                <?php foreach ($posts as $row) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="post-box">
                            <div class="post-img"><img src="/assets/backend/images/post/<?= $row['post_image']; ?>" class="img-fluid" alt=""></div>
                            <span class="post-date">
                                <?= date('d M Y', strtotime($row['post_date'])); ?>
                                |
                                <?= $row['post_views'] . ' views'; ?>
                            </span>
                            <h3 class="post-title"><a href="/post/<?= $row['post_slug']; ?>"><?= $row['post_title']; ?></a>
                            </h3>
                            <a href="/post/<?= $row['post_slug']; ?>" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a><br>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div><br><br>

        </div>

    </section>
    <!-- End Recent Blog Posts Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>