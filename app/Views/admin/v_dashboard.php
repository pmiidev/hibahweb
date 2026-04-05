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
            <!-- Info boxes -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-gear-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Unique Visitors</span>
                    <span class="info-box-number"><?= number_format($all_visitors); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-danger shadow-sm">
                    <i class="bi bi-eye"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Page Views</span>
                    <span class="info-box-number"><?= number_format($all_post_views); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <!-- fix for small devices only -->
              <!-- <div class="clearfix hidden-md-up"></div> -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-pencil"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">All Posts</span>
                    <span class="info-box-number"><?= number_format($all_posts); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-warning shadow-sm">
                    <i class="bi bi-people-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number"><?= number_format($all_users); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-title">Visitors Daily Report</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-8">
                        <p class="text-center">
                          <!-- <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong> -->
                        </p>
                        <div id="visitor-chart"></div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-4">
                        <p class="text-center"><strong>Browser Stats</strong></p>
                        <div class="progress-group">
                          Google Chrome
                          <span class="float-end"><b><?= number_format($chrome_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-primary" style="width: <?= number_format($chrome_visitor); ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Firefox
                          <span class="float-end"><b><?= number_format($firefox_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-success" style="width: <?= number_format($firefox_visitor); ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">Internet Explorer</span>
                          <span class="float-end"><b><?= number_format($explorer_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-danger" style="width: <?= number_format($explorer_visitor); ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Safari
                          <span class="float-end"><b><?= number_format($safari_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-warning" style="width: <?= number_format($safari_visitor); ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Opera
                          <span class="float-end"><b><?= number_format($opera_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-danger" style="width: <?= number_format($opera_visitor); ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">Robots</span>
                          <span class="float-end"><b><?= number_format($robot_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-success" style="width: <?= number_format($robot_visitor); ?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Others
                          <span class="float-end"><b><?= number_format($other_visitor); ?></b>%</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-primary" style="width: <?= number_format($other_visitor); ?>%"></div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <!--begin::Row-->
                    <!-- <div class="row">
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> 17%
                          </span>
                          <h5 class="fw-bold mb-0">$35,210.43</h5>
                          <span class="text-uppercase">TOTAL REVENUE</span>
                        </div>
                      </div>
                      
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-info"> <i class="bi bi-caret-left-fill"></i> 0% </span>
                          <h5 class="fw-bold mb-0">$10,390.90</h5>
                          <span class="text-uppercase">TOTAL COST</span>
                        </div>
                      </div>
                     
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> 20%
                          </span>
                          <h5 class="fw-bold mb-0">$24,813.53</h5>
                          <span class="text-uppercase">TOTAL PROFIT</span>
                        </div>
                      </div>
                     
                      <div class="col-md-3 col-6">
                        <div class="text-center">
                          <span class="text-danger">
                            <i class="bi bi-caret-down-fill"></i> 18%
                          </span>
                          <h5 class="fw-bold mb-0">1200</h5>
                          <span class="text-uppercase">GOAL COMPLETIONS</span>
                        </div>
                      </div>
                    </div> -->
                    <!--end::Row-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->
              <div class="col-md-8">
                <!--begin::Row-->
                
                <!--end::Row-->
                <!--begin::Latest Order Widget-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Top 5 Posts</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Post Title</th>
                            <th>Views</th>
                            <!-- <th>Popularity</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($top_five_articles as $no => $row) : $no++; ?>
                          <tr>
                            <td>
                                <?= $no; ?>
                            </td>
                            <td><?= $row['post_title']; ?></td>
                            <td><span class="badge text-bg-success"> <?= number_format($row['post_views']); ?> </span></td>
                            <!-- <td><div id="table-sparkline-1"></div></td> -->
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    
                    <a href="/<?= session('role'); ?>/post" class="btn btn-sm btn-secondary float-end">
                      View All Posts
                    </a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <!-- /.info-box -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Browser Usage</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-12"><div id="pie-chart"></div></div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item">
                        <!-- <a href="#" class="nav-link">
                          United States of America
                          <span class="float-end text-danger">
                            <i class="bi bi-arrow-down fs-7"></i>
                            12%
                          </span>
                        </a> -->
                      </li>
                      
                    </ul>
                  </div>
                  <!-- /.footer -->
                </div>
                <!-- /.card -->
                
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

<?= $this->endSection(); ?>