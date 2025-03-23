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

    <link href="/assets/backend/css/dropify.min.css" rel="stylesheet" type="text/css" media="screen,projection">
    <link href="/assets/backend/plugins/sum/summernote-lite.min.css" rel="stylesheet">

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
            <!-- Session Message -->
            <?php if (session()->getFlashData('pesan') || session()->getFlashData('peringatan')) : ?>
                <div class="alert alert-<?= session()->getFlashData('pesan') ? "success" : "warning" ?>" role="alert" style="padding: 1rem 3rem;">
                    <?= session()->getFlashdata('pesan') ?? session()->getFlashdata('peringatan') ?>
                </div>
            <?php endif; ?>
            <div id="main-wrapper">
                <div class="row">
                    <form action="/<?= session('role'); ?>/post" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="col-md-8">
                            <div class="panel panel-white">

                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?= $post['post_title']; ?>" class="form-control" placeholder="Title" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="slug" class="form-control" value="<?= $post['post_slug']; ?>" placeholder="Permalink" style="background-color: #F8F8F8;outline-color: none;border:0;color:blue;" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Contents</label>
                                        <textarea name="contents" id="summernote1"><?= $post['post_contents']; ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="filefoto" class="dropify" data-height="190" data-default-file="/assets/backend/images/post/<?= $post['post_image']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" required>
                                            <?php foreach ($categories as $row) : ?>
                                                <?php if ($post['post_category_id'] == $row['category_id']) : ?>
                                                    <option value="<?= $row['category_id']; ?>" selected><?= $row['category_name']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label>Tags</label>
                                    <div style="overflow-y:scroll;height:150px;margin-bottom:30px;">
                                        <?php foreach ($tags as $row) : ?>
                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="tag[]" value="<?= $row['tag_name']; ?>" <?php if (in_array($row['tag_name'], $post_tags)) echo 'checked="checked"'; ?>> <?= $row['tag_name']; ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="post_id" value="<?= $post['post_id']; ?>" required>
                                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%"><span class="icon-cursor"></span> UPDATE</button>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="description" cols="6" rows="6" class="form-control" placeholder="Meta Description"><?= $post['post_description']; ?></textarea>
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
    <!-- jquery jquery-3.4.1.slim.min.js gak cocok untuk dropify lama, jd pakai yg 2.1.4 aja -->
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
    <script src="/assets/backend/js/dropify.min.js"></script>

    <script src="/assets/backend/plugins/sum/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote1').summernote({
                height: 590,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ["fullscreen", "codeview", "help"]],
                ],

                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }

            });

            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "<?= site_url() ?>backend/post/upload_image",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        editor.insertImage(welEditable, url);
                    }
                });
            }

            $('.dropify').dropify({
                messages: {
                    default: 'Drag atau drop untuk memilih gambar',
                    replace: 'Ganti',
                    remove: 'Hapus',
                    error: 'error'
                }
            });

        });
    </script>

</body>

</html>