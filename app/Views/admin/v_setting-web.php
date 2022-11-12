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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

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
                    <form class="form-horizontal" action="/<?= session('role'); ?>/setting/web" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="col-md-12">
                            <div class="panel panel-white">

                                <div class="panel-body">

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Site Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="input1" value="<?= $sites['site_name']; ?>" placeholder="Site Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Site Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="input1" value="<?= $sites['site_title']; ?>" placeholder="Site Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Site Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" rows="6" id="summernote"><?= $sites['site_description']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Favicon</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="logo_icon" class="form-control" id="input1">
                                            <p class="help-block">Favicon harus beresolusi 32 x 32 Pixels.</p>
                                            <img src="/assets/frontend/images/<?= $sites['site_favicon']; ?>" class="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Logo Header</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="logo_header" class="form-control" id="input1">
                                            <p class="help-block">Logo harus beresolusi 248 x 54 Pixels.</p>
                                            <img src="/assets/frontend/images/<?= $sites['site_logo_header']; ?>" class="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Logo Big</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="logo_big" class="form-control" id="input1">
                                            <p class="help-block">Logo big harus beresolusi 560 x 315 Pixels.</p>
                                            <img src="/assets/frontend/images/<?= $sites['site_logo_big']; ?>" width="560" class="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Facebook URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="facebook" class="form-control" value="<?= $sites['site_facebook']; ?>" id="input1" placeholder="Facebook URL">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Twitter URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="twitter" class="form-control" value="<?= $sites['site_twitter']; ?>" id="input1" placeholder="Twitter URL">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Linkedin URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="linkedin" class="form-control" value="<?= $sites['site_linkedin'] ?>" id="input1" placeholder="Linkedin URL">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Instagram URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="instagram" class="form-control" value="<?= $sites['site_instagram']; ?>" id="input1" placeholder="Instagram URL">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Pinterest</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="pinterest" class="form-control" value="<?= $sites['site_pinterest']; ?>" id="input1" placeholder="Pinterest URL">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Nomor WA</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="wa" class="form-control" value="<?= $sites['site_wa']; ?>" id="input1" placeholder="62+">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input1" class="col-sm-2 control-label">Email Resmi</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mail" class="form-control" value="<?= $sites['site_mail']; ?>" id="input1" placeholder="name@domain.xxx">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="site_id" value="<?= $sites['site_id'] ?>" required>
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">UPDATE</button>
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
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> -->
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Site Information Saved!",
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