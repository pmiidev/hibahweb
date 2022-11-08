<?= $this->include('layout/header-dashboard'); ?>

<body class="page-header-fixed compact-menu pace-done page-sidebar-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <?= $this->include('layout/sidebar-dashboard'); ?>
        <div class="page-inner">
            <?= $this->include('layout/title-dashboard'); ?>

            <!-- Main Content -->
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <a href="/post/add_new" class="btn btn-success m-b-sm">Add New Post</a>
                                <div class="table-responsive">
                                    <table id="data-table" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">No</th>
                                                <th>Title</th>
                                                <th>Publish Date</th>
                                                <th>Category</th>
                                                <th>Views</th>
                                                <th style="text-align: center;width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($posts as $post) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $post['post_title']; ?></td>
                                                    <td><?= $post['post_date']; ?></td>
                                                    <td><?= $post['category_name']; ?></td>
                                                    <td><?= $post['post_views']; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="<?= site_url('backend/post/get_edit/' . $post['post_id']); ?>" class="btn btn-xs"><span class="fa fa-pencil"></span></a>
                                                        <a href="javascript:void(0);" class="btn btn-xs btn-delete" data-id="<?= $post['post_id']; ?>"><span class="fa fa-trash"></span></a>
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
            </div>
            <!-- End Main Content -->

            <?= $this->include('layout/footer-dashboard'); ?>
        </div>
    </main>
    <!--DELETE RECORD MODAL-->
    <form action="<?= site_url('backend/post/delete'); ?>" method="post">
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Post</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin mau menghapus post ini?
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

            //Delete Record
            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                $('[name="id"]').val(id);
                $('#DeleteModal').modal('show');
            });

        });
    </script>

    <!--Toast Message-->
    <?php if (session()->getFlashData('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Post Saved!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'info') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Post Updated!",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'success-delete') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Post Deleted!.",
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