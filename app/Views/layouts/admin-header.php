<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= esc($title); ?></title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Dashboard v2" />
    <meta name="author" content="Ircham Ali" />
    <link rel="shortcut icon" href="/assets/lte4/img/AdminLTELogo.png">
    <!--end::Primary Meta Tags-->
    <!--Fonts-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/lte4/css/adminlte.css" /> 
    <!-- apexcharts -->
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/lte4/css/plugins/apexcharts.css">
    
  </head>
  <body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> -->
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::End Navbar links-->
            <ul class="navbar-nav ms-auto">
                      <li class="nav-item dropdown">
                        <button
                          class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                          id="bd-theme"
                          type="button"
                          aria-expanded="false"
                          data-bs-toggle="dropdown"
                          data-bs-display="static"
                        >
                          <span class="theme-icon-active"> <i class="my-1"></i> </span>
                          <span class="d-lg-none ms-2" id="bd-theme-text">Theme</span>
                        </button>
                        <ul
                          class="dropdown-menu dropdown-menu-end"
                          aria-labelledby="bd-theme-text"
                          style="--bs-dropdown-min-width: 8rem"
                        >
                          <li>
                            <button
                              type="button"
                              class="dropdown-item d-flex align-items-center active"
                              data-bs-theme-value="light"
                              aria-pressed="false"
                            >
                              <i class="bi bi-sun-fill me-2"></i>
                              Light
                              <i class="bi bi-check-lg ms-auto d-none"></i>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="dropdown-item d-flex align-items-center"
                              data-bs-theme-value="dark"
                              aria-pressed="false"
                            >
                              <i class="bi bi-moon-fill me-2"></i>
                              Dark
                              <i class="bi bi-check-lg ms-auto d-none"></i>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="dropdown-item d-flex align-items-center"
                              data-bs-theme-value="auto"
                              aria-pressed="true"
                            >
                              <i class="bi bi-circle-fill-half-stroke me-2"></i>
                              Auto
                              <i class="bi bi-check-lg ms-auto d-none"></i>
                            </button>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <!--end::End Navbar links-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="<?= base_url(''); ?>assets/lte4/img/users/<?= $akun['user_photo']; ?>"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <!-- <span class="d-none d-md-inline">Alexander Pierce</span> -->
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-secondary shadow">
                  <img
                    src="<?= base_url(''); ?>assets/lte4/img/users/<?= $akun['user_photo']; ?>"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    <b><?= $akun['user_name']; ?></b>
                    <small><?= session('role'); ?></small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="/<?= session('role'); ?>/setting/profile" class="btn btn-default btn-flat">Profile</a>
                  <a href="/logout" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>