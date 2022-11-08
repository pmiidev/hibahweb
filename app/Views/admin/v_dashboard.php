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
            </div>
            <!-- End Main Content -->

            <?= $this->include('layout/footer-dashboard'); ?>
        </div>
    </main>
    <div class="cd-overlay"></div>

    <!-- Javascripts -->
    <?= $this->include('layout/js-dashboard'); ?>
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