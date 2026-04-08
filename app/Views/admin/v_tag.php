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
            <li class="breadcrumb-item active" aria-current="page">Tags</li>
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
          <?php if (session()->getFlashdata('msg') === 'success'): ?>Tag saved successfully.
          <?php elseif (session()->getFlashdata('msg') === 'info'): ?>Tag updated successfully.
          <?php elseif (session()->getFlashdata('msg') === 'success-delete'): ?>Tag deleted successfully.
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
          <form action="/admin/tag" method="post" class="row gy-2 gx-2 align-items-end">
            <?= csrf_field(); ?>
            <div class="col-md-8">
              <label for="tag" class="form-label">New Tag</label>
              <input type="text" id="tag" name="tag" class="form-control" placeholder="Tag name" required>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary w-100">Save Tag</button>
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
                <?php foreach ($tags as $tag): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($tag['tag_name']); ?></td>
                    <td>
                      <form action="/admin/tag" method="post" class="d-inline-flex align-items-center gap-2">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="kode" value="<?= esc($tag['tag_id']); ?>">
                        <input type="text" name="tag2" value="<?= esc($tag['tag_name']); ?>"
                          class="form-control form-control-sm me-2" required>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                      </form>
                      <form action="/admin/tag" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= esc($tag['tag_id']); ?>">
                        <button type="submit" class="btn btn-sm btn-danger"
                          onclick="return confirm('Delete this tag?');">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <?php if (empty($tags)): ?>
                  <tr>
                    <td colspan="3" class="text-center">No tags found.</td>
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