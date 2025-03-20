<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title><?= $title; ?></title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Ircham Ali" />
    <link rel="shortcut icon" href="/assets/frontend/img/apple-touch-icon.png">

    <!-- Styles -->
    <link href="/assets/backend/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
    <link href="/assets/backend/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" />
    <link href="/assets/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />

    <script src="/assets/backend/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


</head>

<body class="page-header-fixed compact-menu pace-done page-sidebar-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <?= $this->include('layout/sidebar-dashboard'); ?>
        <div class="page-inner">
            <?= $this->include('layout/title-dashboard'); ?>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h4 class="panel-title">Change Profile</h4>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="/<?= session('role'); ?>/setting/profile" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="user_photo" class="col-sm-2 control-label">Foto Profile</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="user_photo" class="form-control" id="user_photo">
                                            <p class="help-block">Foto profile sebaiknya beresolusi 32 x 32 Pixels.</p>
                                            <img src="/assets/backend/images/users/<?= $akun['user_photo']; ?>" class="thumbnail" height="50px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_name" class="col-sm-2 control-label">Nama User</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Nama User" value="<?= $akun['user_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_email" class="col-sm-2 control-label">Email User</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email User" value="<?= $akun['user_email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_password" class="col-sm-2 control-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Change Password</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h4 class="panel-title">Change Password</h4>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="/<?= session('role'); ?>/setting/profile" method="post">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-sm-2 control-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="old_password" class="form-control" id="inputPassword1" placeholder="Old Password" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword2" class="col-sm-2 control-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="new_password" class="form-control" id="inputPassword2" placeholder="New Password" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Confirm New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="conf_password" class="form-control" id="inputPassword3" placeholder="Confirm New Password" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Change Password</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Main Wrapper -->
            <div class="page-footer">
                <p class="no-s"><?= date('Y'); ?> &copy; Powered by Ircham Ali.</p>
            </div>
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
    <div class="cd-overlay"></div>


    <!-- Javascripts -->
    <script src="/assets/backend/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="/assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/backend/plugins/pace-master/pace.min.js"></script>
    <script src="/assets/backend/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="/assets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/backend/plugins/switchery/switchery.min.js"></script>
    <script src="/assets/backend/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/classie.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/main.js"></script>
    <script src="/assets/backend/plugins/waves/waves.min.js"></script>
    <script src="/assets/backend/plugins/3d-bold-navigation/js/main.js"></script>
    <script src="/assets/backend/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="/assets/backend/plugins/jquery-counterup/jquery.counterup.min.js"></script>
    <script src="/assets/backend/plugins/toastr/toastr.min.js"></script>
    <script src="/assets/backend/plugins/flot/jquery.flot.min.js"></script>
    <script src="/assets/backend/plugins/flot/jquery.flot.time.min.js"></script>
    <script src="/assets/backend/plugins/flot/jquery.flot.symbol.min.js"></script>
    <script src="/assets/backend/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="/assets/backend/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/assets/backend/plugins/chartsjs/Chart.min.js"></script>
    <script src="/assets/backend/js/modern.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>
    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Password Changed.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-update') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Profile Changed.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-notmatch') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Password and Confirm Password doesn't match.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-notfound') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Invalid Password",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Invalid Input",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php else : ?>

    <?php endif; ?>

</body>

</html>