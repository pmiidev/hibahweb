<?= $this->extend('layouts/template-admin'); ?>
<?= $this->section('content'); ?>

<?= $this->include('layouts/admin-sidebar'); ?>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0"><?= esc($title); ?></h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <?php if (session()->getFlashdata('msg')): ?>
        <div
          class="alert alert-<?= session()->getFlashdata('msg') === 'info' ? 'info' : (session()->getFlashdata('msg') === 'success-delete' ? 'danger' : 'success'); ?> alert-dismissible fade show"
          role="alert">
          <?php if (session()->getFlashdata('msg') === 'success'): ?>Category saved successfully.
          <?php elseif (session()->getFlashdata('msg') === 'info'): ?>Category updated successfully.
          <?php elseif (session()->getFlashdata('msg') === 'success-delete'): ?>Category deleted successfully.
          <?php endif; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
              <li><?= esc($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="card mb-4">
        <div class="card-body">
          <form action="/admin/category" method="post" class="row gy-2 gx-2 align-items-end">
            <?= csrf_field(); ?>
            <div class="col-md-8">
              <label for="category" class="form-label">New Category</label>
              <input type="text" id="category" name="category" class="form-control" placeholder="Category name"
                required>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary w-100">Save Category</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px;">#</th>
                  <th>Name</th>
                  <th style="width: 260px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($categories as $category): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($category['category_name']); ?></td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <form action="/admin/category" method="post" class="d-inline-flex align-items-center m-0">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" name="kode" value="<?= esc($category['category_id']); ?>">
                          <input type="text" name="category2" value="<?= esc($category['category_name']); ?>"
                            class="form-control form-control-sm me-2" required>
                          <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                        </form>
                        <form action="/admin/category" method="post" class="m-0">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="id" value="<?= esc($category['category_id']); ?>">
                          <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this category?');">Delete</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                  <tr>
                    <td colspan="3" class="text-center">No categories found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection(); ?>