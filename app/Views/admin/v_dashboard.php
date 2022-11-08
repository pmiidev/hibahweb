<!DOCTYPE html>
<html>

<head>

    <!-- Title -->
    <title>Dashboard</title>

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
    <link href="/assets/backend/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

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
        <div class="navbar">
            <div class="navbar-inner">
                <div class="sidebar-pusher">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="logo-box">
                    <a href="/<?= session('role'); ?>" class="logo-text"><span>PMII</span></a>
                </div><!-- Logo Box -->
                <div class="topmenu-outer">
                    <div class="top-menu">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right"><?= $total_inbox; ?></span></a>
                                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">

                                    <li>
                                        <p class="drop-title">Anda memiliki <?= $total_inbox; ?> pesan baru !</p>
                                    </li>
                                    <li class="dropdown-menu-list slimscroll messages">
                                        <ul class="list-unstyled">
                                            <?php foreach ($inboxs as $row) : ?>
                                                <li>
                                                    <a href="/<?= session('role') ?>/inbox">
                                                        <div class="msg-img">
                                                            <div class="online on"></div><img class="img-circle" src="/assets/backend/images/user_blank.png" alt="">
                                                        </div>
                                                        <p class="msg-name"><?= $row['inbox_name']; ?></p>
                                                        <p class="msg-text"><?= word_limiter($row['inbox_message'], 5); ?></p>
                                                        <p class="msg-time"><?= date('d-m-Y H:i:s', strtotime($row['inbox_created_at'])); ?></p>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="drop-all"><a href="/<?= session('role'); ?>/inbox" class="text-center">All Messages</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-comment"></i><span class="badge badge-success pull-right"><?= $total_comment; ?></span></a>
                                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                    <li>
                                        <p class="drop-title">Anda memiliki <?= $total_comment; ?> komentar baru !</p>
                                    </li>
                                    <li class="dropdown-menu-list slimscroll messages">
                                        <ul class="list-unstyled">
                                            <?php foreach ($comments as $row) : ?>
                                                <li>
                                                    <a href="/<?= session('role'); ?>/comment">
                                                        <div class="msg-img">
                                                            <div class="online on"></div><img class="img-circle" src="/assets/backend/images/user_blank.png" alt="">
                                                        </div>
                                                        <p class="msg-name"><?= $row['comment_name']; ?></p>
                                                        <p class="msg-text"><?= word_limiter($row['comment_message'], 5); ?></p>
                                                        <p class="msg-time"><?= date('d-m-Y H:i:s', strtotime($row['comment_date'])); ?></p>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="drop-all"><a href="/<?= session('role'); ?>/comment" class="text-center">All Comments</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                    <span class="user-name"><?= session('name'); ?><i class="fa fa-angle-down"></i></span>
                                    <img class="img-circle avatar" src="/assets/backend/images/<?= $akun['user_photo']; ?>" width="40" height="40" alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li role="presentation"><a href="<?= site_url('backend/change_pass'); ?>"><i class="fa fa-key"></i>Change Password</a></li>
                                    <li role="presentation"><a href="<?= site_url('backend/comment/unpublish'); ?>"><i class="fa fa-comment"></i>Comments<span class="badge badge-success pull-right"><?= $total_comment; ?></span></a></li>
                                    <li role="presentation"><a href="<?= site_url('backend/inbox'); ?>"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right"><?= $total_inbox; ?></span></a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a href="<?= site_url('logout'); ?>"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= site_url('logout'); ?>" class="log-out waves-effect waves-button waves-classic">
                                    <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                </a>
                            </li>
                        </ul><!-- Nav -->
                    </div><!-- Top Menu -->
                </div>
            </div>
        </div><!-- Navbar -->
        <div class="page-sidebar sidebar">
            <div class="page-sidebar-inner slimscroll">
                <div class="sidebar-header">
                    <div class="sidebar-profile">
                        <a href="javascript:void(0);">
                            <div class="sidebar-profile-image">
                                <img src="/assets/backend/images/<?= $akun['user_photo']; ?>" class="img-circle img-responsive" alt="">
                            </div>
                            <div class="sidebar-profile-details">
                                <span><?= session('nama'); ?><br>
                                    <small>Administrator</small>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
                <ul class="menu accordion-menu">
                    <li class="active"><a href="/<?= session('role'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-home"></span>
                            <p>Dashboard</p>
                        </a></li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-pin"></span>
                            <p>Post</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="/<?= session('role'); ?>/post/add_post">Add New</a></li>
                            <li><a href="/<?= session('role'); ?>/post">Post List</a></li>
                            <li><a href="/<?= session('role'); ?>/category">Category</a></li>
                            <li><a href="/<?= session('role'); ?>/tag">Tag</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/inbox" class="waves-effect waves-button"><span class="menu-icon icon-envelope"></span>
                            <p>Inbox</p>
                        </a>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/comment" class="waves-effect waves-button"><span class="menu-icon icon-bubbles"></span>
                            <p>Comments</p>
                        </a>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/subscriber" class="waves-effect waves-button"><span class="menu-icon icon-users"></span>
                            <p>Subscribers</p>
                        </a>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/member" class="waves-effect waves-button"><span class="menu-icon icon-key"></span>
                            <p>Member</p>
                        </a>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/testimonial" class="waves-effect waves-button"><span class="menu-icon icon-like"></span>
                            <p>Testimonials</p>
                        </a>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/team" class="waves-effect waves-button"><span class="menu-icon icon-users"></span>
                            <p>Teams</p>
                        </a>
                    </li>
                    <li>
                        <a href="/<?= session('role'); ?>/users" class="waves-effect waves-button"><span class="menu-icon icon-user"></span>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="droplink"><a href="/<?= session('role'); ?>/settings" class="waves-effect waves-button"><span class="menu-icon icon-settings"></span>
                            <p>Settings</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="/<?= session('role'); ?>/settings">Basic</a></li>
                            <li><a href="/<?= session('role'); ?>/home-setting">Home</a></li>
                            <li><a href="/<?= session('role'); ?>/about-setting">About</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/logout" class="waves-effect waves-button"><span class="menu-icon icon-logout"></span>
                            <p>Log Out</p>
                        </a>
                    </li>
                </ul>
            </div><!-- Page Sidebar Inner -->
        </div><!-- Page Sidebar -->
        <div class="page-inner">
            <div class="page-title">
                <h3>Dashboard</h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="/<?= session('role'); ?>">Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel info-box panel-white">
                            <div class="panel-body">
                                <div class="info-box-stats">
                                    <p class="counter"><?= number_format($all_visitors); ?></p>
                                    <span class="info-box-title">Unique Visitors</span>
                                </div>
                                <div class="info-box-icon">
                                    <i class="icon-users"></i>
                                </div>
                                <div class="info-box-progress">
                                    <div class="progress progress-xs progress-squared bs-n">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel info-box panel-white">
                            <div class="panel-body">
                                <div class="info-box-stats">
                                    <p class="counter"><?= number_format($all_post_views); ?></p>
                                    <span class="info-box-title">Page Views</span>
                                </div>
                                <div class="info-box-icon">
                                    <i class="icon-eye"></i>
                                </div>
                                <div class="info-box-progress">
                                    <div class="progress progress-xs progress-squared bs-n">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel info-box panel-white">
                            <div class="panel-body">
                                <div class="info-box-stats">
                                    <p><span class="counter"><?= number_format($all_posts); ?></span></p>
                                    <span class="info-box-title">All Posts</span>
                                </div>
                                <div class="info-box-icon">
                                    <i class="icon-pencil"></i>
                                </div>
                                <div class="info-box-progress">
                                    <div class="progress progress-xs progress-squared bs-n">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel info-box panel-white">
                            <div class="panel-body">
                                <div class="info-box-stats">
                                    <p class="counter"><?= number_format($all_comments); ?></p>
                                    <span class="info-box-title">Comments Received</span>
                                </div>
                                <div class="info-box-icon">
                                    <i class="icon-bubbles"></i>
                                </div>
                                <div class="info-box-progress">
                                    <div class="progress progress-xs progress-squared bs-n">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="visitors-chart">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Visitors This Month</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <canvas id="canvas"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="stats-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Browser Stats</h4>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                <li>Google Chrome<div class="text-success pull-right"><?= number_format($chrome_visitor); ?>%</div>
                                                </li>
                                                <li>Firefox<div class="text-success pull-right"><?= number_format($firefox_visitor); ?>%</div>
                                                </li>
                                                <li>Internet Explorer<div class="text-success pull-right"><?= number_format($explorer_visitor); ?>%</div>
                                                </li>
                                                <li>Safari<div class="text-success pull-right"><?= number_format($safari_visitor); ?>%</div>
                                                </li>
                                                <li>Opera<div class="text-success pull-right"><?= number_format($opera_visitor); ?>%</div>
                                                </li>
                                                <li>Robots<div class="text-success pull-right"><?= number_format($robot_visitor); ?>%</div>
                                                </li>
                                                <li>Others<div class="text-success pull-right"><?= number_format($other_visitor); ?>%</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h4 class="panel-title">Top 5 Articles</h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive project-stats">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Post Title</th>
                                                <th style="text-align: right;">Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($top_five_articles as $no => $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $no; ?></th>
                                                    <td><?= $row['post_title']; ?></td>
                                                    <td style="text-align: right;"><?= number_format($row['post_views']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <script>
        $(document).ready(function() {
            // CounterUp Plugin
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });

            var myLine = document.getElementById("canvas").getContext("2d");
            var lineChartData = {
                labels: <?= $month; ?>,
                datasets: [

                    {
                        fillColor: "rgba(34,186,160,0.2)",
                        strokeColor: "rgba(34,186,160,1)",
                        pointColor: "rgba(34,186,160,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(18,175,203,1)",
                        data: <?= $value; ?>
                    }

                ]

            }

            var canvas = new Chart(myLine).Line(lineChartData, {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 0,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 2,
                datasetStroke: true,
                tooltipCornerRadius: 2,
                datasetStrokeWidth: 2,
                datasetFill: true,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });
        });
    </script>

</body>

</html>