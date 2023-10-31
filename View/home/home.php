<?php
global $config;
view('static/header');
?>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->

            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= url('logout') ?>" class="nav-link">Log Out</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php view('static/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-2">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <h5 class="mt-4 mb-2">Current Progress <code><?= date('d-m-Y')?></code></h5>
                <div class="row">
                    <?php
                    foreach ($data['statistic'] as $row):
                    ?>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box bg-<?= status($row['status'])['badge'] ?>">
                            <span class="info-box-icon"><i class="<?= status($row['status'])['icon'] ?>"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?= status($row['status'])['title'] ?></span>
                                <span class="info-box-number"><?= $row['total'] ?> Todos</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                  <?= number_format($row['percentage'],0) ?>% Increase in 30 Days
                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <?php
                            foreach ($data['progress'] as $todo):
                            ?>
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-red"><?= date('d/m/Y',strtotime($todo['start_date']))?></span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-check" style="background: <?=$todo['color'] ?> "></i>
                                <div class="timeline-item p-2">
                                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i',strtotime($todo['start_date'])) ?></span>
                                    <h3 class="timeline-header"><span class="badge bg-success"><?= $todo['category'] ?></span> <?= $todo['title'] ?></h3>

                                    <div class="timeline-body">
                                        <?= $todo['description'] ?>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: <?=$todo['progress']?>%"></div>
                                    </div>
                                    <span class="badge bg-primary"><?=$todo['progress']?>%</span>

                                    <div class="timeline-footer">
                                        <a href="<?= url('todos/edit/'.$todo['id']) ?>" class="btn btn-primary btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <?php
                            endforeach;
                            ?>

                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <?php view('static/footer') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src=" <?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src=" <?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>
<!-- AdminLTE App -->
<script src=" <?= assets('js/adminlte.min.js') ?> "></script>
</body>
</html>
