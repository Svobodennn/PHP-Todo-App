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
    <?php view('static/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-3">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Todos</h3>

                                <div class="card-tools">
                                    <div class="pagination pagination-sm float-right">
                                        <a href="<?= url('todos/add') ?>" class="btn btn-sm btn-dark">Add</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <?php
                                echo $_SESSION['error']['type'] != NULL ?
                                    '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>'
                                    :
                                    null
                                ?>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th style="width: 440px">Progress</th>
                                        <th>Status</th>
                                        <th style="width: 40px">Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; foreach ($data as $key => $value): ?>
                                    <tr id="row_<?= $value['id'] ?>">
                                        <td><?= $count++ ?></td>
                                        <td><?= $value['title'] ?></td>
                                        <td><?= $value['start_date'] ?></td>
                                        <td><?= $value['end_date'] ?></td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger" style="width: <?=$value['progress']?>%"></div>
                                            </div>
                                            <span class="badge bg-primary"><?=$value['progress']?>%</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= status($value['status'])['badge'] ?>">
                                                <?= status($value['status'])['title'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button onclick="removeTodo(<?=$value['id']?>)" type="button" class="btn btn-sm btn-danger" >Remove</button>
                                                <a type="button" class="btn btn-sm btn-warning" href="<?= url('todos/edit/'.$value['id']) ?>">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <!--Sweetalert added-->
    <script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js') ?>"></script>
    <!--Axios added-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js"
            integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        //choose form
        function removeTodo(id){
            let formData = new FormData()

            formData.append('id', id)

            axios.post('<?= url('api/removetodo') ?>', formData)
                .then(res => {

                    if (res.data.id){
                        let row = document.getElementById('row_'+res.data.id)
                        row.remove()
                    }

                    swal.fire(
                        res.data.title,
                        res.data.msg,
                        res.data.status
                    )
                }




                )
                .catch(err => {
                    swal.fire(
                        'Oops!',
                        'An Unexpected Error Has Occured.',
                        'error'
                    )
                })
        }





    </script>
</body>
</html>


<?php

if (isset($_SESSION['error']['message'])){
    $_SESSION['error']['message'] = null;
}
if (isset($_SESSION['error']['type'])){
    $_SESSION['error']['type'] = null;
}
?>