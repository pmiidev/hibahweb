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
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'About settings updated successfully!'; ?>
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
                    <h5 class="card-title mb-0">About Section Settings</h5>
                  </div>
                  <div class="card-body">
                    <form action="/<?= session('role'); ?>/setting/about" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="about_id" value="<?= esc($abouts['about_id']); ?>">

                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Organization Name</label>
                          <input type="text" name="name" class="form-control" value="<?= esc($abouts['about_name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Address</label>
                          <input type="text" name="alamat" class="form-control" value="<?= esc($abouts['about_alamat']); ?>" required>
                        </div>
                        <div class="col-12">
                          <label class="form-label">Description</label>
                          <textarea name="description" class="form-control" rows="5" required><?= esc($abouts['about_description']); ?></textarea>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">About Image</label>
                          <input type="file" name="img_about" class="form-control">
                          <?php if (!empty($abouts['about_image'])) : ?>
                            <img src="/assets/lte4/img/setting/about/<?= esc($abouts['about_image']); ?>" class="img-fluid mt-2 rounded" alt="About Image">
                          <?php endif; ?>
                        </div>
                        <div class="col-12 text-end">
                          <button type="submit" class="btn btn-primary">Save About Settings</button>
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
