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
              <div class="col-sm-6"><h3 class="mb-0"><?= $title; ?></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
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
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'User added successfully!'; ?>
                  <?php elseif ($msgType === 'info') : ?>
                    <?php $toastClass = 'text-bg-info'; $msgTitle = 'Success'; $msgText = 'User updated successfully!'; ?>
                  <?php elseif ($msgType === 'success-delete') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'User deleted successfully!'; ?>
                  <?php elseif ($msgType === 'success-activate') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'User activated successfully!'; ?>
                  <?php elseif ($msgType === 'success-deactivate') : ?>
                    <?php $toastClass = 'text-bg-warning'; $msgTitle = 'Success'; $msgText = 'User deactivated successfully!'; ?>
                  <?php elseif ($msgType === 'error') : ?>
                    <?php $toastClass = 'text-bg-danger'; $msgTitle = 'Error'; $msgText = 'Invalid input detected.'; ?>
                  <?php elseif ($msgType === 'error-email') : ?>
                    <?php $toastClass = 'text-bg-danger'; $msgTitle = 'Error'; $msgText = 'Email already exists.'; ?>
                  <?php elseif ($msgType === 'error-img') : ?>
                    <?php $toastClass = 'text-bg-danger'; $msgTitle = 'Error'; $msgText = 'Invalid image file.'; ?>
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
                    <h3 class="card-title">Users Management</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus"></i> Add New User
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
                          <th>Email</th>
                          <th>Level</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 0;
                        foreach ($users as $row) :
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>
                              <?php if (empty($row['user_photo'])) : ?>
                                <img class="img-circle" width="50" src="/assets/lte4/img/user_blank.png">
                              <?php else : ?>
                                <img class="img-circle" width="50" src="/assets/lte4/img/additional/users/<?= $row['user_photo']; ?>">
                              <?php endif; ?>
                            </td>
                            <td><?= $row['user_name']; ?></td>
                            <td><?= $row['user_email']; ?></td>
                            <td>
                              <?php
                              if ($row['user_level'] == '1') {
                                echo "Administrator";
                              } else {
                                echo "Author";
                              }
                              ?>
                            </td>
                            <td>
                              <?php if ($row['user_status'] == '1') : ?>
                                <a href="/admin/users/deactivate/<?= $row['user_id']; ?>" class="btn btn-success btn-sm">
                                  <i class="fas fa-check"></i> Active
                                </a>
                              <?php else : ?>
                                <a href="/admin/users/activate/<?= $row['user_id']; ?>" class="btn btn-secondary btn-sm">
                                  <i class="fas fa-times"></i> Inactive
                                </a>
                              <?php endif; ?>
                            </td>
                            <td>
                              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $row['user_id']; ?>">
                                <i class="fas fa-edit"></i> Edit
                              </button>
                              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal<?= $row['user_id']; ?>">
                                <i class="fas fa-trash"></i> Delete
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

      <!-- Modals -->
      <!-- Add User Modal -->
      <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="/admin/users" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="nama">Name</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                  <label for="password2">Confirm Password</label>
                  <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <select class="form-control" id="level" name="level" required>
                    <option value="1">Administrator</option>
                    <option value="2">Author</option>
                  </select>
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

      <!-- Edit User Modals -->
      <?php foreach ($users as $row) : ?>
        <div class="modal fade" id="editUserModal<?= $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel<?= $row['user_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/users" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="editUserModalLabel<?= $row['user_id']; ?>">Edit User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['user_name']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $row['user_email']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password (leave blank if not change)</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="level">Level</label>
                    <select class="form-control" id="level" name="level" required>
                      <option value="1" <?= $row['user_level'] == '1' ? 'selected' : ''; ?>>Administrator</option>
                      <option value="2" <?= $row['user_level'] == '2' ? 'selected' : ''; ?>>Author</option>
                    </select>
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

        <!-- Delete User Modal -->
        <div class="modal fade" id="deleteUserModal<?= $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel<?= $row['user_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/users" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="kode" value="<?= $row['user_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteUserModalLabel<?= $row['user_id']; ?>">Delete User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete user "<?= $row['user_name']; ?>"?</p>
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