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
            <li class="breadcrumb-item"><a href="/admin/post">All Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Post</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <?php $errors = session('errors'); ?>
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
              <li><?= esc($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="/admin/post" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row gy-3">
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" id="title" name="title" value="<?= old('title'); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="slug" class="form-label">Slug</label>
                  <input type="text" id="slug" name="slug" value="<?= old('slug'); ?>" class="form-control"
                    placeholder="example-post-title" required>
                </div>
                <div class="mb-3">
                  <label for="contents" class="form-label">Contents</label>
                  <textarea id="summernote" name="contents" class="form-control"
                    required><?= old('contents'); ?></textarea>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Meta Description</label>
                  <textarea id="description" name="description" rows="3"
                    class="form-control"><?= old('description'); ?></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-body">
                <div class="mb-3">
                  <label for="filefoto" class="form-label">Image</label>
                  <input type="file" id="filefoto" name="filefoto" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="category" class="form-label">Category</label>
                  <select id="category" name="category" class="form-select" required>
                    <option value="">Select category</option>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?= esc($category['category_id']); ?>" <?= old('category') == $category['category_id'] ? 'selected' : ''; ?>><?= esc($category['category_name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tags</label>
                  <div class="row row-cols-1 g-2">
                    <?php $oldTags = old('tag') ?: []; ?>
                    <?php foreach ($tags as $tag): ?>
                      <div class="col">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="tag-<?= esc($tag['tag_id']); ?>"
                            name="tag[]" value="<?= esc($tag['tag_name']); ?>" <?= in_array($tag['tag_name'], $oldTags) ? 'checked' : ''; ?>>
                          <label class="form-check-label"
                            for="tag-<?= esc($tag['tag_id']); ?>"><?= esc($tag['tag_name']); ?></label>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Publish Post</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function () {
    $('#summernote').summernote({
      height: 590,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ["fullscreen", "codeview", "help"]],
      ],
      callbacks: {
        onImageUpload: function (files) {
          sendFile(files[0], this);
        }
      }
    });

    function sendFile(file, editor) {
      var data = new FormData();
      data.append("file", file);
      $.ajax({
        data: data,
        type: "POST",
        url: "<?= site_url('admin/post/upload_image'); ?>",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          var imageUrl = response.url ? response.url : response;
          $(editor).summernote('insertImage', imageUrl);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
        }
      });
    }
  });
</script>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>