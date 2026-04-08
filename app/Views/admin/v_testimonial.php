<?= $this->extend('layouts/template-admin'); ?>
<?= $this->section('content'); ?>

      <?= $this->include('layouts/admin-sidebar'); ?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Testimonials Management</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <div aria-live="polite" aria-atomic="true" class="position-relative">
              <div class="toast-container position-absolute top-0 end-0 p-3">
                <?php if (session()->has('msg')) : ?>
                  <?php $msgType = session()->getFlashdata('msg'); ?>
                  <?php $toastClass = 'text-bg-secondary'; $msgTitle = 'Notification'; $msgText = 'Nothing happened.'; ?>
                  <?php if ($msgType === 'success') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Testimonial added successfully!'; ?>
                  <?php elseif ($msgType === 'info') : ?>
                    <?php $toastClass = 'text-bg-info'; $msgTitle = 'Success'; $msgText = 'Testimonial updated successfully!'; ?>
                  <?php elseif ($msgType === 'success-delete') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Testimonial deleted successfully!'; ?>
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

            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Testimonials</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                        <i class="bi bi-plus-lg"></i> Add New Testimonial
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Angkatan</th>
                          <th>Content</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 0;
                        foreach ($testimonials as $row) :
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>
                              <img class="img-circle" width="50" src="/assets/lte4/img/additional/testimonials/<?= $row['testimonial_image']; ?>">
                            </td>
                            <td><?= $row['testimonial_name']; ?></td>
                            <td><?= $row['testimonial_angkatan']; ?></td>
                            <td><?= substr($row['testimonial_content'], 0, 50); ?>...</td>
                            <td>
                              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTestimonialModal<?= $row['testimonial_id']; ?>">
                                <i class="bi bi-pencil-square"></i> Edit
                              </button>
                              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTestimonialModal<?= $row['testimonial_id']; ?>">
                                <i class="bi bi-trash"></i> Delete
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      <!-- Add Testimonial Modal -->
      <div class="modal fade" id="addTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="/admin/testimonial" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="addTestimonialModalLabel">Add New Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="nama">Name</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                  <label for="angkatan">Angkatan</label>
                  <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="2007-2010" required>
                </div>
                <div class="form-group">
                  <label for="content">Content</label>
                  <textarea class="form-control" id="content" name="content" required></textarea>
                </div>
                <div class="form-group">
                  <label for="filefoto">Photo</label>
                  <input type="file" class="form-control" id="filefoto" name="filefoto">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Edit Testimonial Modal -->
      <?php foreach ($testimonials as $row) : ?>
        <div class="modal fade" id="editTestimonialModal<?= $row['testimonial_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editTestimonialModalLabel<?= $row['testimonial_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/testimonial" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="testimonial_id" value="<?= $row['testimonial_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="editTestimonialModalLabel<?= $row['testimonial_id']; ?>">Edit Testimonial</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['testimonial_name']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?= $row['testimonial_angkatan']; ?>" placeholder="2007-2010" required>
                  </div>
                  <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" required><?= $row['testimonial_content']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="filefoto">Photo</label>
                    <input type="file" class="form-control" id="filefoto" name="filefoto">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete Testimonial Modal -->
        <div class="modal fade" id="deleteTestimonialModal<?= $row['testimonial_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteTestimonialModalLabel<?= $row['testimonial_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/testimonial" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="kode" value="<?= $row['testimonial_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteTestimonialModalLabel<?= $row['testimonial_id']; ?>">Delete Testimonial</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete testimonial from "<?= $row['testimonial_name']; ?>"?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

<?= $this->endSection(); ?>