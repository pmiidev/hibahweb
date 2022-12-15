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
    <link href="/assets/backend/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />

    <script src="/assets/backend/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


</head>

<body class="page-header-fixed  compact-menu  pace-done page-sidebar-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <?= $this->include('layout/sidebar-dashboard'); ?>
        <div class="page-inner">
            <?= $this->include('layout/title-dashboard'); ?>
            <div id="main-wrapper">
                <div class="row">
                    <form class="form-horizontal" action="/<?= session('role'); ?>/setting/home" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Caption 1</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="caption1" class="form-control" id="input1" value="<?= $homes['home_caption_1']; ?>" placeholder="Site Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Caption 2</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="caption2" class="form-control" id="input1" value="<?= $homes['home_caption_2']; ?>" placeholder="Site Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_video" class="col-sm-2 control-label">Link Video</label>
                                        <div class="col-sm-10">
                                            <input type="url" name="home_video" class="form-control" id="home_video" value="<?= $homes['home_video']; ?>" placeholder="Link video">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Image Heading</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="img_heading" class="form-control" id="input1">
                                            <p class="help-block">Image heading sebaiknya beresolusi 1215 x 872 Pixels.</p>
                                            <img src="/assets/frontend/img/<?= $homes['home_bg_heading']; ?>" width="560" class="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Image Testimonial</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="img_testimonial" class="form-control" id="input1">
                                            <p class="help-block">Image testimonial sebaiknya beresolusi 1043 x 663 Pixels.</p>
                                            <img src="/assets/frontend/img/<?= $homes['home_bg_testimonial']; ?>" width="560" class="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Image Testimonial2</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="img_testimonial2" class="form-control" id="input1">
                                            <p class="help-block">Image testimonial2 sebaiknya beresolusi 726 x 790 Pixels.</p>
                                            <img src="/assets/frontend/img/<?= $homes['home_bg_testimonial2']; ?>" width="560" class="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="home_id" value="<?= $homes['home_id'] ?>" required>
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success btn-lg">UPDATE</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
            <div class="page-footer">
                <p class="no-s"><?= date('Y'); ?> &copy; Powered by Ircham Ali.</p>
            </div>
        </div><!-- Page Inner -->
    </main><!-- Page Content -->

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
    <script src="/assets/backend/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="/assets/backend/plugins/moment/moment.js"></script>
    <script src="/assets/backend/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>
    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Home Information Saved!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Invalid Input.",
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