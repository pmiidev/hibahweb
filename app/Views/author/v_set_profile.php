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
                    <div class="toast-container position-absolute top-50 end-0 p-3">
                        <?php if (session()->has('msg')): ?>
                            <?php 
                                $msgType = session()->getFlashdata('msg'); 
                                $toastClass = 'text-bg-primary';
                                $msgTitle = 'Notification';
                                $msgText = 'Something happened!';
                                
                                if ($msgType === 'success') {
                                    $toastClass = 'text-bg-success';
                                    $msgTitle = 'Success';
                                    $msgText = 'Password changed successfully!';
                                } elseif ($msgType === 'success-update') {
                                    $toastClass = 'text-bg-success';
                                    $msgTitle = 'Success';
                                    $msgText = 'Profile updated successfully!';
                                } elseif ($msgType === 'error-notmatch') {
                                    $toastClass = 'text-bg-warning';
                                    $msgTitle = 'Error';
                                    $msgText = 'Password and Confirm Password do not match!';
                                } elseif ($msgType === 'error-notfound') {
                                    $toastClass = 'text-bg-warning';
                                    $msgTitle = 'Error';
                                    $msgText = 'Invalid Password!';
                                } elseif ($msgType === 'error') {
                                    $toastClass = 'text-bg-danger';
                                    $msgTitle = 'Error';
                                    $msgText = 'Invalid Input!';
                                }
                            ?>
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

                <!--begin::Col-->
                <div class="col-md-8">
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
                    <!--end::Input Group-->
                    
                </div>
                <!--end::Col-->
                    
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