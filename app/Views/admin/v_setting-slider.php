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
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Slider saved successfully!'; ?>
                  <?php elseif ($msgType === 'deleted') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Deleted'; $msgText = 'Slider item successfully removed.'; ?>
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

            <div class="row g-4">
              <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Add Slider Item</h5>
                  </div>
                  <div class="card-body">
                    <form action="/<?= session('role'); ?>/setting/slider" method="post" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label class="form-label">Slider Title</label>
                        <input type="text" name="slider_title" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Slider Caption</label>
                        <textarea name="slider_caption" class="form-control" rows="4" required></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="slider_image" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="slider_order" class="form-control" value="0" min="0" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Create Slider Item</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Existing Slider Items</h5>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                          <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Caption</th>
                            <th>Order</th>
                            <th>Image</th>
                            <th class="text-end">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($sliders) && is_array($sliders)) : ?>
                            <?php foreach ($sliders as $index => $slider) : ?>
                              <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= esc($slider['slider_title']); ?></td>
                                <td><?= esc($slider['slider_caption']); ?></td>
                                <td><?= esc($slider['slider_order']); ?></td>
                                <td>
                                  <?php if (!empty($slider['slider_image'])) : ?>
                                    <img src="/assets/lte4/img/setting/slider/<?= esc($slider['slider_image']); ?>" alt="Slider Image" class="img-thumbnail" width="80">
                                  <?php endif; ?>
                                </td>
                                <td class="text-end">
                                  <form action="/<?= session('role'); ?>/setting/slider/<?= esc($slider['slider_id']); ?>" method="post" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                  </form>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php else : ?>
                            <tr>
                              <td colspan="6" class="text-center py-4">No slider items found.</td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

<?= $this->endSection(); ?>
