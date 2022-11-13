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
    <link href="/assets/backend/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />

    <script src="/assets/backend/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


</head>

<body class="page-header-fixed compact-menu  pace-done page-sidebar-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <?= $this->include('layout/sidebar-dashboard'); ?>
        <div class="page-inner">
            <?= $this->include('layout/title-dashboard'); ?>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <div role="tabpanel">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation"><a href="/<?= session('role'); ?>/comment">All<span class="badge badge-success pull-right m-l-xs"><?= $total_all_comments; ?></span></a></li>
                                        <li role="presentation" class="active"><a href="#unpublish" aria-controls="all" role="tab" data-toggle="tab" aria-expanded="false">Unpublish<span class="badge badge-danger pull-right m-l-xs"><?= $total_comment; ?></span></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in p-v-lg" id="all">
                                            <?php foreach ($comments as $row) : ?>
                                                <div class="search-item">
                                                    <div class="pull-left m-r-md">
                                                        <a href="javascript:void(0);" class="btn-image" data-comment_id="<?= $row['comment_id']; ?>" data-name="<?= $row['comment_name']; ?>" data-email="<?= $row['comment_email']; ?>">
                                                            <?php if (!empty($row['comment_image'])) : ?>
                                                                <img src="/assets/backend/images/<?= $row['comment_image']; ?>" class="img-circle" width="50" height="50" alt="<?= $row['comment_name'] ?>">
                                                            <?php else : ?>
                                                                <img src="/assets/backend/images/user_blank.png" class="img-circle" width="50" alt="<?= $row['comment_name'] ?>">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    <div class="pull-right m-r-md">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <?php if ($row['comment_status'] == '0') : ?>
                                                                    <li><a href="javascript:void(0);" class="btn-publish" data-comment_id="<?= $row['comment_id']; ?>"><span class="fa fa-send"></span> Publish</a></li>
                                                                <?php else : ?>
                                                                    <li><a href="javascript:void(0);" class="btn-reply" data-comment_id="<?= $row['comment_id']; ?>" data-post_id="<?= $row['post_id']; ?>"><span class="fa fa-reply"></span> Reply</a></li>
                                                                <?php endif; ?>
                                                                <li><a href="javascript:void(0);" class="btn-edit" data-comment_id="<?= $row['comment_id']; ?>" data-comment_msg="<?= $row['comment_message']; ?>"><span class="fa fa-edit"></span> Edit</a></li>
                                                                <li><a href="javascript:void(0);" class="btn-delete" data-comment_id="<?= $row['comment_id']; ?>"><span class="fa fa-trash"></span> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h3 class="no-m"><a href="/post/<?= $row['post_slug']; ?>" target="_blank"><?= $row['post_title']; ?></a></h3>
                                                    <a href="javascript:void(0);" class="search-link"><b><?= $row['comment_name'] ?></b>, <?= $row['comment_date']; ?></a>
                                                    <?php if ($row['comment_status'] == '0') {
                                                        echo "<span class='label label-danger'>Unpublish</span>";
                                                    } else {
                                                    } ?>
                                                    <div>
                                                        <p><?= $row['comment_message']; ?></p>
                                                    </div>
                                                </div>

                                                <?php
                                                $comment_id = $row['comment_id'];
                                                $commentModel = new App\Models\CommentModel;
                                                $result = $commentModel->get_replies_post($comment_id)->getResultArray();
                                                foreach ($result as $row) :
                                                ?>
                                                    <div class="col-md-offset-1">
                                                        <div class="search-item">
                                                            <div class="pull-left m-r-md">
                                                                <img src="/assets/backend/images/<?= $row['comment_image']; ?>" class="img-circle" width="50" alt="<?= $row['comment_name'] ?>">
                                                            </div>
                                                            <div class="pull-right m-r-md">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                        <li><a href="javascript:void(0);" class="btn-edit" data-comment_id="<?= $row['comment_id']; ?>" data-comment_msg="<?= $row['comment_message']; ?>"><span class="fa fa-edit"></span> Edit</a></li>
                                                                        <li><a href="javascript:void(0);" class="btn-delete" data-comment_id="<?= $row['comment_id']; ?>"><span class="fa fa-trash"></span> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h3 class="no-m"><a href="/post/<?= $row['post_slug']; ?>" target="_blank"><?= $row['post_title']; ?></a></h3>
                                                            <a href="javascript:void(0);" class="search-link"><b><?= $row['comment_name'] ?></b>, <?= $row['comment_date']; ?></a>
                                                            <div style="margin-left: 7%;">
                                                                <p><?= $row['comment_message']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
            <div class="page-footer">
                <p class="no-s"><?= date('Y'); ?> &copy; Powered by Ircham Ali.</p>
            </div>
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
    <div class="cd-overlay"></div>

    <!-- MODAL REPLY -->
    <form action="/<?= session('role'); ?>/comment" method="POST">
        <div class="modal fade" id="ReplyModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Reply Comment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="comments" class="form-control" rows="5" placeholder="Reply..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="comment_id" required>
                        <input type="hidden" name="post_id" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- MODAL EDIT -->
    <form action="/<?= session('role'); ?>/comment" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <div class="modal fade" id="EditModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Comment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="comments2" id="comment" class="form-control comment" rows="6" placeholder="Edit..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="comment_id2" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--PUBLISH MODAL-->
    <form action="/<?= session('role'); ?>/comment/publish" method="POST">
        <div class="modal fade" id="PublishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Publish Comment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin mau mempublish komentar ini?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="comment_id4" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Publish</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--DELETE RECORD MODAL-->
    <form action="/<?= session('role'); ?>/comment" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Comment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin mau menghapus komentar ini?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="comment_id3" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Change Image MODAL-->
    <form action="<?= site_url('backend/comment/change'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="ImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Change Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" readonly>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" readonly>
                        </div>

                        <div class="form-group">
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="comment_id5" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Change</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


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
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/summernote-master/summernote.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-reply').on('click', function() {
                var comm_id = $(this).data('comment_id');
                var post_id = $(this).data('post_id');
                $('#ReplyModal').modal('show');
                $('[name="comment_id"]').val(comm_id);
                $('[name="post_id"]').val(post_id);
            });

            $('.btn-edit').on('click', function() {
                var comm_id = $(this).data('comment_id');
                var msg = $(this).data('comment_msg');
                $('#EditModal').modal('show');
                $('[name="comment_id2"]').val(comm_id);
                $('.comment').val(msg);
                $('.comment').code(msg);
            });

            $('.btn-delete').on('click', function() {
                var comm_id = $(this).data('comment_id');
                $('#DeleteModal').modal('show');
                $('[name="comment_id3"]').val(comm_id);
            });

            $('.btn-publish').on('click', function() {
                var comm_id = $(this).data('comment_id');
                $('#PublishModal').modal('show');
                $('[name="comment_id4"]').val(comm_id);
            });

            $('.btn-image').on('click', function() {
                var comm_id = $(this).data('comment_id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                $('#ImageModal').modal('show');
                $('[name="comment_id5"]').val(comm_id);
                $('[name="name"]').val(name);
                $('[name="email"]').val(email);
            });


        });
    </script>
    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Comments replied",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'info') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Comments not found.",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'not validated') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Warning',
                text: "Kesalahan pada penginputan",
                showHideTransition: 'slide',
                icon: 'warning',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#fce903'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-delete') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Comment Deleted!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-edit') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Comment Updated!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-publish') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Comment Published!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-change') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Image Changed!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php else : ?>

    <?php endif; ?>
</body>

</html>