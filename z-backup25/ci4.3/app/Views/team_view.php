<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2><?= $title; ?></h2>
                <h3><span><?= $about['about_name']; ?></span></h3>
                <p>Masa Khidmat 2022/2023</p>
            </div>

            <div class="row">
                <?php foreach ($teams as $team) : ?>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="/assets/backend/images/team/<?= $team['team_image']; ?>" class="img-fluid" alt="">
                                <div class="social">
                                    <a href="<?= $team['team_twitter']; ?>"><i class="bi bi-twitter"></i></a>
                                    <a href="<?= $team['team_facebook']; ?>"><i class="bi bi-facebook"></i></a>
                                    <a href="<?= $team['team_instagram']; ?>"><i class="bi bi-instagram"></i></a>
                                    <a href="<?= $team['team_linked']; ?>"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4><?php echo $team['team_name']; ?></h4>
                                <span><?php echo $team['team_jabatan']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</main><!-- End #main -->
<?= $this->endSection(); ?>