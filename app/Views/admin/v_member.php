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
              <div class="col-sm-6"><h3 class="mb-0">Members Management</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Members</li>
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
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Member added successfully!'; ?>
                  <?php elseif ($msgType === 'info') : ?>
                    <?php $toastClass = 'text-bg-info'; $msgTitle = 'Success'; $msgText = 'Member updated successfully!'; ?>
                  <?php elseif ($msgType === 'success-delete') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Member deleted successfully!'; ?>
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
                    <h3 class="card-title">Members</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        <i class="bi bi-plus-lg"></i> Add New Member
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
                          <th>Link</th>
                          <th>Description</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 0;
                        foreach ($members as $row) :
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>
                              <img class="img-circle" width="50" src="/assets/lte4/img/additional/members/<?= $row['member_image']; ?>">
                            </td>
                            <td><?= $row['member_name']; ?></td>
                            <td><a href="<?= $row['member_link']; ?>" target="_blank"><?= $row['member_link']; ?></a></td>
                            <td><?= substr($row['member_desc'], 0, 50); ?>...</td>
                            <td>
                              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editMemberModal<?= $row['member_id']; ?>">
                                <i class="bi bi-pencil-square"></i> Edit
                              </button>
                              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMemberModal<?= $row['member_id']; ?>">
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

      <!-- Add Member Modal -->
      <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="/admin/member" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Add New Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="nama">Name</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                  <label for="link">Link</label>
                  <input type="url" class="form-control" id="link" name="link" required>
                </div>
                <div class="form-group">
                  <label for="desc">Description</label>
                  <textarea class="form-control" id="desc" name="desc" required></textarea>
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

      <!-- Edit Member Modal -->
      <?php foreach ($members as $row) : ?>
        <div class="modal fade" id="editMemberModal<?= $row['member_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMemberModalLabel<?= $row['member_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/member" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="member_id" value="<?= $row['member_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="editMemberModalLabel<?= $row['member_id']; ?>">Edit Member</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['member_name']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="link">Link</label>
                    <input type="url" class="form-control" id="link" name="link" value="<?= $row['member_link']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" id="desc" name="desc" required><?= $row['member_desc']; ?></textarea>
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

        <!-- Delete Member Modal -->
        <div class="modal fade" id="deleteMemberModal<?= $row['member_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMemberModalLabel<?= $row['member_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/member" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="kode" value="<?= $row['member_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteMemberModalLabel<?= $row['member_id']; ?>">Delete Member</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete member "<?= $row['member_name']; ?>"?</p>
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