<?= $this->extend('layouts/page-template'); ?>
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
                <!-- Flash Messages -->
                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container position-absolute top-0 end-0 p-3">
                        <?php if (session()->has('msg')): ?>
                            <?php 
                                $msgType = session()->getFlashdata('msg'); 
                                $toastClass = 'text-bg-secondary';
                                $msgTitle = 'Notification';
                                $msgIcon = 'Icons';
                                $msgText = 'Something happened!';
                                
                                if ($msgType === 'success') {
                                    $toastClass = 'text-bg-info';
                                    $msgTitle = 'Success';
                                    $msgIcon = '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>';
                                    $msgText = 'Password changed successfully!';
                                } elseif ($msgType === 'success-update') {
                                    $toastClass = 'text-bg-success';
                                    $msgTitle = 'Success';
                                    $msgIcon = '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>';
                                    $msgText = 'Profile updated successfully!';
                                } elseif ($msgType === 'error-notmatch') {
                                    $toastClass = 'text-bg-warning';
                                    $msgTitle = 'Error';
                                    $msgIcon = '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>';
                                    $msgText = 'Password and Confirm Password do not match!';
                                } elseif ($msgType === 'error-notfound') {
                                    $toastClass = 'text-bg-danger';
                                    $msgTitle = 'Error';
                                    $msgIcon = '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>';
                                    $msgText = 'Invalid Password!';
                                } elseif ($msgType === 'error') {
                                    $toastClass = 'text-bg-danger';
                                    $msgTitle = 'Error';
                                    $msgIcon = '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>';
                                    $msgText = 'Invalid Input!';
                                }
                            ?>
                            <div class="toast <?= $toastClass; ?> show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"><?= $msgIcon; ?></svg>
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
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Quick Example-->
                        <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header"><div class="card-title">Change Profile</div></div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="/<?= session('role'); ?>/setting/profile" method="post" enctype="multipart/form-data">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div id="photo" class="form-text">
                                    <img src="/assets/lte4/img/users/<?= $akun['user_photo']; ?>" class="thumbnail" height="50px">
                                    Foto profile sebaiknya beresolusi 32 x 32 Pixels!
                                </div><br>
                                <div class="input-group mb-3">
                                    <input type="file" name="user_photo" class="form-control" id="user_photo"/>
                                    <label class="input-group-text" for="user_photo">Upload</label>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="user_name"><span class="bi bi-person"></span></span>
                                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Nama User" value="<?= $akun['user_name']; ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="user_email"><span class="bi bi-envelope"></span></span>
                                    <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email User" value="<?= $akun['user_email']; ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="user_password"><span class="bi bi-lock-fill"></span></span>
                                    <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Change Profile</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                        </div>
                        <!--end::Quick Example-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Input Group-->
                        <div class="card card-success card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header"><div class="card-title">Change Password</div></div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <form action="/<?= session('role'); ?>/setting/profile" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputPassword1"><span class="bi bi-lock-fill"></span></span>
                                    <input type="password" name="old_password" class="form-control" id="inputPassword1" placeholder="Old password" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputPassword2"><span class="bi bi-lock-fill"></span></span>
                                    <input type="password" name="new_password" class="form-control" id="inputPassword2" placeholder="New password" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputPassword3"><span class="bi bi-lock-fill"></span></span>
                                    <input type="password" name="conf_password" class="form-control" id="inputPassword3" placeholder="New password confirm." required>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                            <button type="submit" class="btn btn-success">Change Password</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Body-->
                        </div>
                        <!--end::Quick Example-->
                    </div>
                    <!--end::Col-->
                </div>
                    
            </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                var toastList = toastElList.map(function (toastEl) {
                    return new bootstrap.Toast(toastEl, { autohide: true, delay: 5000 }) // 5 detik
                });
                toastList.forEach(toast => toast.show());
            });
        </script>


<?= $this->endSection(); ?>