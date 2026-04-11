<?= $this->extend('layouts/template-home'); ?>
<?= $this->section('content'); ?>

<main class="main">

  <!-- Call To Action 2 Section -->
  <section id="call-to-action-2" class="call-to-action-2 section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="advertise-1 d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">

        <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
          <span class="badge text-uppercase mb-2">PMII</span>
          <h2>Pergerakan Mahasiswa Islam Indonesia</h2>
          <p class="my-4">Strategia accelerates your business growth through innovative solutions and cutting-edge
            technology. Join thousands of satisfied customers who have transformed their operations.</p>

          <div class="features d-flex flex-wrap gap-3 mb-4">
            <div class="feature-item">
              <i class="bi bi-check-circle-fill"></i>
              <span>Pergerakan Mahasiswa</span>
            </div>
            <div class="feature-item">
              <i class="bi bi-check-circle-fill"></i>
              <span>Islam Indonesia</span>
            </div>
          </div>

          <div class="cta-buttons d-flex flex-wrap gap-3">
            <!-- <a href="#" class="btn btn-primary">Start Free Trial</a> -->
            <a href="#" class="btn btn-outline">Learn More</a>
          </div>
        </div>

        <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
          <img src="assets/blogy/img/misc/misc-1.webp" alt="Digital Platform" class="img-fluid rounded-4">
          <div class="floating-card">
            <div class="card-icon">
              <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div class="card-content">
              <span class="stats-number">100%</span>
              <span class="stats-text">Growth Mindset</span>
            </div>
          </div>
        </div>

        <div class="decoration">
          <div class="circle-1"></div>
          <div class="circle-2"></div>
        </div>

      </div>

    </div>

  </section>

  <!-- Featured Posts Section -->
  <section id="featured-posts" class="featured-posts section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Featured Posts</h2>
      <div><span>Check Our</span> <span class="description-title">Featured Posts</span></div>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="blog-posts-slider swiper init-swiper">
        <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 800,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 4,
              "spaceBetween": 30,
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 20
                },
                "768": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 4,
                  "spaceBetween": 30
                }
              }
            }
          </script>

        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="assets/blogy/img/blog/blog-post-portrait-1.webp" alt="Blog Image">
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> Julia Parker</span>
                  <span><i class="bi bi-clock"></i> Jan 15, 2025</span>
                  <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                </div>
                <h2><a href="#">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</a></h2>
                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce
                  porttitor metus eget lectus consequat, sit amet feugiat magna vulputate.</p>
                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End slide item -->

          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="assets/blogy/img/blog/blog-post-portrait-2.webp" alt="Blog Image">
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> Mark Wilson</span>
                  <span><i class="bi bi-clock"></i> Jan 18, 2025</span>
                  <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                </div>
                <h2><a href="#">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</a></h2>
                <p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet adipiscing sem neque
                  sed ipsum.</p>
                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End slide item -->

          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="assets/blogy/img/blog/blog-post-portrait-3.webp" alt="Blog Image">
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> Sarah Johnson</span>
                  <span><i class="bi bi-clock"></i> Jan 21, 2025</span>
                  <span><i class="bi bi-chat-dots"></i> 15 Comments</span>
                </div>
                <h2><a href="#">At vero eos et accusamus et iusto odio dignissimos ducimus</a></h2>
                <p>Nullam dictum felis eu pede mollis pretium integer tincidunt cras dapibus vivamus elementum semper
                  nisi.</p>
                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End slide item -->

          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="assets/blogy/img/blog/blog-post-portrait-4.webp" alt="Blog Image">
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> David Brown</span>
                  <span><i class="bi bi-clock"></i> Jan 24, 2025</span>
                  <span><i class="bi bi-chat-dots"></i> 10 Comments</span>
                </div>
                <h2><a href="#">Et harum quidem rerum facilis est et expedita distinctio</a></h2>
                <p>Donec quam felis ultricies nec pellentesque eu pretium quis sem nulla consequat massa quis enim.</p>
                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End slide item -->

          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="assets/blogy/img/blog/blog-post-portrait-5.webp" alt="Blog Image">
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> Emma Davis</span>
                  <span><i class="bi bi-clock"></i> Jan 27, 2025</span>
                  <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                </div>
                <h2><a href="#">Nam libero tempore, cum soluta nobis est eligendi optio</a></h2>
                <p>Aenean leo ligula porttitor eu consequat vitae eleifend ac enim aliquam lorem ante dapibus in
                  viverra.</p>
                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End slide item -->
        </div>

      </div>

    </div>

  </section><!-- /Featured Posts Section -->

  <!-- Latest Posts Section -->
  <section id="latest-posts" class="latest-posts section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Latest Posts</h2>
      <div><span>Check Our</span> <span class="description-title">Latest Posts</span></div>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">

        <div class="col-lg-4">
          <article>

            <div class="post-img">
              <img src="assets/blogy/img/blog/blog-post-1.webp" alt="" class="img-fluid">
            </div>

            <p class="post-category">Politics</p>

            <h2 class="title">
              <a href="blog-details.html">Dolorum optio tempore voluptas dignissimos</a>
            </h2>

            <div class="d-flex align-items-center">
              <img src="assets/blogy/img/person/person-f-12.webp" alt=""
                class="img-fluid post-author-img flex-shrink-0">
              <div class="post-meta">
                <p class="post-author">Maria Doe</p>
                <p class="post-date">
                  <time datetime="2022-01-01">Jan 1, 2022</time>
                </p>
              </div>
            </div>

          </article>
        </div><!-- End post list item -->

        <div class="col-lg-4">
          <article>

            <div class="post-img">
              <img src="assets/blogy/img/blog/blog-post-2.webp" alt="" class="img-fluid">
            </div>

            <p class="post-category">Sports</p>

            <h2 class="title">
              <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
            </h2>

            <div class="d-flex align-items-center">
              <img src="assets/blogy/img/person/person-f-13.webp" alt=""
                class="img-fluid post-author-img flex-shrink-0">
              <div class="post-meta">
                <p class="post-author">Allisa Mayer</p>
                <p class="post-date">
                  <time datetime="2022-01-01">Jun 5, 2022</time>
                </p>
              </div>
            </div>

          </article>
        </div><!-- End post list item -->

        <div class="col-lg-4">
          <article>

            <div class="post-img">
              <img src="assets/blogy/img/blog/blog-post-3.webp" alt="" class="img-fluid">
            </div>

            <p class="post-category">Entertainment</p>

            <h2 class="title">
              <a href="blog-details.html">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
            </h2>

            <div class="d-flex align-items-center">
              <img src="assets/blogy/img/person/person-m-10.webp" alt=""
                class="img-fluid post-author-img flex-shrink-0">
              <div class="post-meta">
                <p class="post-author">Mark Dower</p>
                <p class="post-date">
                  <time datetime="2022-01-01">Jun 22, 2022</time>
                </p>
              </div>
            </div>

          </article>
        </div><!-- End post list item -->

      </div>
    </div>

  </section><!-- /Latest Posts Section -->

  <!-- Call To Action Section -->
  <section id="call-to-action" class="call-to-action section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4 justify-content-between align-items-center">
        <div class="col-lg-6">
          <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
            <h2>Star to our repository</h2>
            <p>Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet
              quam id dui posuere blandit.</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form cta-form" data-aos="fade-up"
              data-aos-delay="300">
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email address..." aria-label="Email address"
                  aria-describedby="button-subscribe">
                <button class="btn btn-primary" type="submit" id="button-subscribe">Subscribe</button>
              </div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cta-image" data-aos="zoom-out" data-aos-delay="200">
            <br>
            <!-- <img src="assets/blogy/img/cta/cta-1.webp" alt="" class="img-fluid"> -->
          </div>
        </div>
      </div>
    </div>
  </section><!-- /Call To Action Section -->

</main>

<?= $this->endSection(); ?>