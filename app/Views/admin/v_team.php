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
              <div class="col-sm-6"><h3 class="mb-0">Teams Management</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Teams</li>
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
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Team member added successfully!'; ?>
                  <?php elseif ($msgType === 'info') : ?>
                    <?php $toastClass = 'text-bg-info'; $msgTitle = 'Success'; $msgText = 'Team member updated successfully!'; ?>
                  <?php elseif ($msgType === 'success-delete') : ?>
                    <?php $toastClass = 'text-bg-success'; $msgTitle = 'Success'; $msgText = 'Team member deleted successfully!'; ?>
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
                    <h3 class="card-title">Teams</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTeamModal">
                        <i class="fas fa-plus"></i> Add New Team Member
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
                          <th>Jabatan</th>
                          <th>Sosmed</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 0;
                        foreach ($teams as $row) :
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>
                              <img class="img-circle" width="50" src="/assets/lte4/img/additional/teams/<?= $row['team_image']; ?>">
                            </td>
                            <td><?= $row['team_name']; ?></td>
                            <td><?= $row['team_jabatan']; ?></td>
                            <td>
                              <a href="<?= $row['team_twitter']; ?>" target="_blank" class="btn" style="background-color: #1DA1F2; color: white; padding: 0.2rem 0.4rem; font-size: 0.8rem;" title="Twitter"><i class="bi bi-twitter" style="font-size: 0.75rem;"></i></a>
                              <a href="<?= $row['team_facebook']; ?>" target="_blank" class="btn" style="background-color: #0A66C2; color: white; padding: 0.2rem 0.4rem; font-size: 0.8rem;" title="Facebook"><i class="bi bi-facebook" style="font-size: 0.75rem;"></i></a>
                              <a href="<?= $row['team_instagram']; ?>" target="_blank" class="btn" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: white; padding: 0.2rem 0.4rem; font-size: 0.8rem;" title="Instagram"><i class="bi bi-instagram" style="font-size: 0.75rem;"></i></a>
                              <a href="<?= $row['team_linked']; ?>" target="_blank" class="btn" style="background-color: #0077B5; color: white; padding: 0.2rem 0.4rem; font-size: 0.8rem;" title="LinkedIn"><i class="bi bi-linkedin" style="font-size: 0.75rem;"></i></a>
                            </td>
                            <td>
                              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTeamModal<?= $row['team_id']; ?>">
                                <i class="fas fa-edit"></i> Edit
                              </button>
                              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTeamModal<?= $row['team_id']; ?>">
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

      <!-- Add Team Modal -->
      <div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" aria-labelledby="addTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="/admin/team" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="addTeamModalLabel">Add New Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="nama">Name</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                </div>
                <div class="form-group">
                  <label for="twitter">Twitter</label>
                  <input type="url" class="form-control" id="twitter" name="twitter" required>
                </div>
                <div class="form-group">
                  <label for="facebook">Facebook</label>
                  <input type="url" class="form-control" id="facebook" name="facebook" required>
                </div>
                <div class="form-group">
                  <label for="instagram">Instagram</label>
                  <input type="url" class="form-control" id="instagram" name="instagram" required>
                </div>
                <div class="form-group">
                  <label for="linked">LinkedIn</label>
                  <input type="url" class="form-control" id="linked" name="linked" required>
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

      <!-- Edit Team Modal -->
      <?php foreach ($teams as $row) : ?>
        <div class="modal fade" id="editTeamModal<?= $row['team_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editTeamModalLabel<?= $row['team_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/team" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="team_id" value="<?= $row['team_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="editTeamModalLabel<?= $row['team_id']; ?>">Edit Team Member</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['team_name']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $row['team_jabatan']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="url" class="form-control" id="twitter" name="twitter" value="<?= $row['team_twitter']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="url" class="form-control" id="facebook" name="facebook" value="<?= $row['team_facebook']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="url" class="form-control" id="instagram" name="instagram" value="<?= $row['team_instagram']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="linked">LinkedIn</label>
                    <input type="url" class="form-control" id="linked" name="linked" value="<?= $row['team_linked']; ?>" required>
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

        <!-- Delete Team Modal -->
        <div class="modal fade" id="deleteTeamModal<?= $row['team_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteTeamModalLabel<?= $row['team_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/admin/team" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="kode" value="<?= $row['team_id']; ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteTeamModalLabel<?= $row['team_id']; ?>">Delete Team Member</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete team member "<?= $row['team_name']; ?>"?</p>
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