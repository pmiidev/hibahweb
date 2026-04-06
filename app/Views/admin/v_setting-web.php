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
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Site information updated successfully!'; ?>
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
                    <h5 class="card-title mb-0">Basic Website Settings</h5>
                  </div>
                  <div class="card-body">
                    <form action="/<?= session('role'); ?>/setting/web" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="site_id" value="<?= esc($sites['site_id']); ?>">

                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Site Name</label>
                          <input type="text" name="name" class="form-control" value="<?= esc($sites['site_name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Site Title</label>
                          <input type="text" name="title" class="form-control" value="<?= esc($sites['site_title']); ?>" required>
                        </div>
                        <div class="col-12">
                          <label class="form-label">Site Description</label>
                          <textarea name="description" class="form-control" rows="4" required><?= esc($sites['site_description']); ?></textarea>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Favicon</label>
                          <input type="file" name="logo_icon" class="form-control">
                          <?php if (!empty($sites['site_favicon'])) : ?>
                            <img src="/assets/lte4/img/setting/web/<?= esc($sites['site_favicon']); ?>" class="img-thumbnail mt-2" width="64" alt="Favicon">
                          <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Logo Header</label>
                          <input type="file" name="logo_header" class="form-control">
                          <?php if (!empty($sites['site_logo_header'])) : ?>
                            <img src="/assets/lte4/img/setting/web/<?= esc($sites['site_logo_header']); ?>" class="img-thumbnail mt-2" width="140" alt="Logo Header">
                          <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Logo Big</label>
                          <input type="file" name="logo_big" class="form-control">
                          <?php if (!empty($sites['site_logo_big'])) : ?>
                            <img src="/assets/lte4/img/setting/web/<?= esc($sites['site_logo_big']); ?>" class="img-thumbnail mt-2" width="140" alt="Logo Big">
                          <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Facebook URL</label>
                          <input type="url" name="facebook" class="form-control" value="<?= esc($sites['site_facebook']); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Twitter URL</label>
                          <input type="url" name="twitter" class="form-control" value="<?= esc($sites['site_twitter']); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">LinkedIn URL</label>
                          <input type="url" name="linkedin" class="form-control" value="<?= esc($sites['site_linkedin']); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Instagram URL</label>
                          <input type="url" name="instagram" class="form-control" value="<?= esc($sites['site_instagram']); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Pinterest URL</label>
                          <input type="url" name="pinterest" class="form-control" value="<?= esc($sites['site_pinterest']); ?>">
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">Nomor WA</label>
                          <input type="text" name="wa" class="form-control" value="<?= esc($sites['site_wa']); ?>">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Email Resmi</label>
                          <input type="email" name="mail" class="form-control" value="<?= esc($sites['site_mail']); ?>">
                        </div>
                        <div class="col-12 text-end">
                          <button type="submit" class="btn btn-primary">Update Basic Settings</button>
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
