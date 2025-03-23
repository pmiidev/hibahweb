<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">
            <div class="row">
                <?php foreach ($posts as $post) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="post-box">
                            <div class="post-img"><img src="/assets/backend/images/post/<?= $post['post_image']; ?>" class="img-fluid" alt="<?= $post['post_title']; ?>"></div>
                            <span class="post-date">
                                <?= date('d M Y', strtotime($post['post_date'])); ?> | <?= $post['post_views']; ?> views
                            </span>
                            <h3 class="post-title"><a href="/post/<?= $post['post_slug']; ?>"><?= $post['post_title']; ?></a>
                            </h3>
                            <a href="/post/<?= $post['post_slug']; ?>" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a><br>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?= $pager->links('posts', 'post_pagination') ?>
            
        </div>

    </section>
    <!-- End Recent Blog Posts Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>