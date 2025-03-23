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
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="data-table" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">No</th>
                                                <th>Email</th>
                                                <th>Created at</th>
                                                <th>Status</th>
                                                <th style="text-align: center;">Rating</th>
                                                <th style="text-align: center;width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php
                                            $no = 0;
                                            foreach ($subscribers as $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $row['subscribe_email']; ?></td>
                                                    <td><?= date('d/m/Y H:i:s', strtotime($row['subscribe_created_at'])); ?></td>
                                                    <?php if ($row['subscribe_status'] == 0) : ?>
                                                        <td title="activate"><a href="/<?= session('role'); ?>/subscriber/activate/<?= $row['subscribe_id']; ?>"><span class="fa fa-toggle-off"></span></a></td>
                                                    <?php else : ?>
                                                        <td title="deactivate"><a href="/<?= session('role'); ?>/subscriber/deactivate/<?= $row['subscribe_id']; ?>"><span class="fa fa-toggle-on"></span></a></td>
                                                    <?php endif; ?>
                                                    <td style="text-align: center;"><a href="/<?= session('role'); ?>/subscriber/decrease/<?= $row['subscribe_id']; ?>" class="btn btn-sm btn-default" title="Turunkan Rating"><span class="fa fa-minus"></span></a> <?= $row['subscribe_rating']; ?> <a href="/<?= session('role'); ?>/subscriber/increase/<?= $row['subscribe_id']; ?>" class="btn btn-sm btn-default" title="Naikan Rating"><span class="fa fa-plus"></span></a></td>
                                                    <td style="text-align: center;">
                                                        <?php if ($row['subscribe_status'] == '0') : ?>
                                                            <a href="javascript:void(0);" class="btn btn-xs btn-edit" data-id="<?= $row['subscribe_id']; ?>" title="Aktifkan Status Email"><span class="fa fa-check"></span></a>
                                                        <?php else : ?>
                                                        <?php endif; ?>
                                                        <a href="javascript:void(0);" class="btn btn-xs btn-delete" data-id="<?= $row['subscribe_id']; ?>" title="Hapus"><span class="fa fa-trash"></span></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
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

    <!--EDIT RECORD MODAL-->
    <form action="<?= site_url('backend/subscriber/update'); ?>" method="post">
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Aktifkan Email</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin email ini aktif?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--DELETE RECORD MODAL-->
    <form action="/<?= session('role'); ?>/subscriber" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Subscriber</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin mau menghapus data ini?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Delete</button>
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
    <script src="/assets/backend/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="/assets/backend/plugins/moment/moment.js"></script>
    <script src="/assets/backend/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').dataTable();

            //Aktifkan email
            $('.btn-edit').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('tag');
                $('[name="kode"]').val(id);
                $('#EditModal').modal('show');
            });

            //Hapus Record
            $('#body-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('[name="id"]').val(id);
                $('#DeleteModal').modal('show');
            });

        });
    </script>

    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Subscriber Activated.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-delete') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Subscriber Deleted!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-increase') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Rating Increased!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-decrease') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Rating Decreased!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-activate') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Status Active!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-deactivate') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Status Deactive!.",
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