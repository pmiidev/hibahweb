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
            <li class="breadcrumb-item active" aria-current="page"><?= esc($title); ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php if (session()->getFlashdata('msg') === 'success'): ?>Post saved successfully.
          <?php elseif (session()->getFlashdata('msg') === 'info'): ?>Post updated successfully.
          <?php elseif (session()->getFlashdata('msg') === 'success-delete'): ?>Post deleted successfully.
          <?php endif; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">All Posts</h5>
          <a href="/admin/post/add_new" class="btn btn-success btn-sm">Add Post</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px;">#</th>
                  <th>Title</th>
                  <th>Publish Date</th>
                  <th>Category</th>
                  <th>Views</th>
                  <th style="width: 180px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($posts as $post): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($post['post_title']); ?></td>
                    <td><?= esc($post['post_date']); ?></td>
                    <td><?= esc($post['category_name']); ?></td>
                    <td><?= esc($post['post_views']); ?></td>
                    <td>
                      <a href="/post/<?= esc($post['post_slug']); ?>" target="_blank"
                        class="btn btn-outline-secondary btn-sm me-1">View</a>
                      <a href="/admin/post/<?= esc($post['post_id']); ?>/edit"
                        class="btn btn-primary btn-sm me-1">Edit</a>
                      <form action="/admin/post" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= esc($post['post_id']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm"
                          onclick="return confirm('Delete this post?');">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <?php if (empty($posts)): ?>
                  <tr>
                    <td colspan="6" class="text-center">No posts found.</td>
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