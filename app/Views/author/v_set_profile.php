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
                            <div id="user_photo" class="form-text">
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
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><span class="bi bi-lock-fill"></span></span>
                                <input type="password" name="old_password" class="form-control" id="inputPassword1" placeholder="Old password" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><span class="bi bi-lock-fill"></span></span>
                                <input type="password" name="new_password" class="form-control" id="inputPassword2" placeholder="New password" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><span class="bi bi-lock-fill"></span></span>
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

<?= $this->endSection(); ?>