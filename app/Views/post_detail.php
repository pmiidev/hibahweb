<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="#"><?= $post['post_title']; ?></a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><a href="/author/<?= $post['post_user_id']; ?>" class="text-primary"><i class="bi bi-person"></i> <?= $post['user_name']; ?></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2020-01-01"><?= date('d M Y', strtotime($post['post_date'])); ?></time>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-eye"></i><?= $post['post_views']; ?> views</li>
                                <li class="d-flex align-items-center"><a href="#footerblog" class="text-primary"><i class="bi bi-chat-dots"></i> <?= $post['comment_total']; ?> comment</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <?= $post['post_contents']; ?>
                        </div>

                        <div class="entry-footer" id="footerblog">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="/category/<?= $post['category_slug']; ?>">
                                        <?= $post['category_slug']; ?>
                                    </a>
                                </li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <?php
                                foreach ($post_tags as $tag) : ?>
                                    <a href="/tag/<?= $tag; ?>"><?= $tag; ?></a> &vert;
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </article><!-- End blog entry -->

                    <!-- Commentar -->
                    <div class="blog-comments" id="comment">
                        <h4 class="comments-count"><?= $post['comment_total']; ?> Comments</h4>
                        <div id="comment-2" class="comment">
                            <?php foreach ($comments as $comment) : ?>
                                <div class="d-flex">
                                    <div class="comment-img"><img alt="" src="/assets/backend/images/<?= $comment['comment_image']; ?>">
                                    </div>
                                    <div>
                                        <h5><?= $comment['comment_name']; ?></h5>
                                        <time datetime="2020-01-01"><?= date('d M Y H:i:s', strtotime($comment['comment_date'])); ?></time>
                                        <p>
                                            <?= $comment['comment_message']; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                                $commentModel = new App\Models\CommentModel;
                                $replies = $commentModel->where('comment_parent', $comment['comment_id'])->get()->getResultArray();
                                ?>
                                <?php foreach ($replies as $reply) : ?>
                                    <div id="comment-reply-1" class="comment comment-reply">
                                        <div class="d-flex">
                                            <div class="comment-img"><img alt="" src="/assets/backend/images/users/<?= $reply['comment_image']; ?>">
                                            </div>
                                            <div>
                                                <h5><a href="javascript:void(0)"><?= $reply['comment_name']; ?></a>
                                                </h5>
                                                <time datetime="2020-01-01"><?= date('d M Y H:i:s', strtotime($reply['comment_date'])); ?></time>
                                                <p>
                                                    <?= $reply['comment_message']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                        <!-- End comment #2-->

                        <div class="reply-form">
                            <h4>Leave a Reply</h4>
                            <p>Your email address will not be published. Required fields are marked * </p>
                            <?= session()->getFlashData('msg') ?? '' ?>
                            <form method="post" action="/post/send_comment" role="form">
                                <div class="row">
                                    <input type="hidden" name="post_id" value="<?= $post['post_id']; ?>" required>
                                    <div class="col-md-6 form-group">
                                        <input name="name" type="text" maxlength="100" required class="form-control" placeholder="Your Name*">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="email" type="email" maxlength="100" required class="form-control" placeholder="Your Email*">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <textarea name="message" class="form-control" placeholder="Your Comment*" maxlength="400" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </form>
                        </div>
                    </div>
                    <!-- End Commentar -->

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <!-- ======= Sidebar ======= -->
                    <?= $this->include('layout/sidebar'); ?>
                    <!-- End Sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>