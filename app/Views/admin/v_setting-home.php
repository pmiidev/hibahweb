<?= $this->extend('layouts/page-template'); ?>
<?= $this->section('content'); ?>

      <?= $this->include('layouts/admin-sidebar'); ?>
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0"><?= esc($title); ?></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= esc($title); ?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div aria-live="polite" aria-atomic="true" class="position-relative">
              <div class="toast-container position-absolute top-0 end-0 p-3">
                <?php if (session()->has('msg')) : ?>
                  <?php $msgType = session()->getFlashdata('msg'); ?>
                  <?php $toastClass = 'text-bg-secondary'; $msgTitle = 'Notification'; $msgText = 'Nothing happened.'; ?>
                  <?php if ($msgType === 'success') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Home settings updated successfully!'; ?>
                  <?php elseif ($msgType === 'error') : ?>
                    <?php $toastClass = 'text-bg-danger'; $msgTitle = 'Error'; $msgText = 'Invalid input detected.'; ?>
                  <?php endif; ?>
                  <div class="toast <?= $toastClass; ?> show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                      <strong class="me-auto"><?= $msgTitle; ?></strong>
                      <small class="text-muted">just now</small>
                      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                      <?= $msgText; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Home Section Settings</h5>
                  </div>
                  <div class="card-body">
                    <form action="/<?= session('role'); ?>/setting/home" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="home_id" value="<?= esc($homes['home_id']); ?>">

                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Headline</label>
                          <input type="text" name="caption1" class="form-control" value="<?= esc($homes['home_caption_1']); ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Subheadline</label>
                          <input type="text" name="caption2" class="form-control" value="<?= esc($homes['home_caption_2']); ?>" required>
                        </div>
                        <div class="col-md-12">
                          <label class="form-label">Video URL</label>
                          <input type="url" name="home_video" class="form-control" value="<?= esc($homes['home_video']); ?>" required>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Background Heading</label>
                          <input type="file" name="img_heading" class="form-control">
                          <?php if (!empty($homes['home_bg_heading'])) : ?>
                            <img src="/assets/frontend/img/<?= esc($homes['home_bg_heading']); ?>" class="img-fluid mt-2 rounded" alt="Heading Background">
                          <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Background Testimonial</label>
                          <input type="file" name="img_testimonial" class="form-control">
                          <?php if (!empty($homes['home_bg_testimonial'])) : ?>
                            <img src="/assets/frontend/img/<?= esc($homes['home_bg_testimonial']); ?>" class="img-fluid mt-2 rounded" alt="Testimonial Background">
                          <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Background Testimonial 2</label>
                          <input type="file" name="img_testimonial2" class="form-control">
                          <?php if (!empty($homes['home_bg_testimonial2'])) : ?>
                            <img src="/assets/frontend/img/<?= esc($homes['home_bg_testimonial2']); ?>" class="img-fluid mt-2 rounded" alt="Testimonial Background 2">
                          <?php endif; ?>
                        </div>
                        <div class="col-12 text-end">
                          <button type="submit" class="btn btn-primary">Save Home Settings</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

<?= $this->endSection(); ?>
