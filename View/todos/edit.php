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
        <div class="content-wrapper p-3">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add Todo</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="todo" action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input value="<?=$data['title']?>" type="text" class="form-control" id="title" name="title">
                                            <input type="hidden" class="form-control" id="user_id" name="user_id"
                                                   value="<?= get_session('id') ?>">
                                            <input type="hidden" class="form-control" id="id" name="id"
                                                   value="<?= $data['id'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select id="category_id" name="category_id" class="form-control">
                                                <option value="0">Choose a Category</option>
                                                <?php
                                                foreach ($data['categories'] as $category):
                                                    ?>
                                                    <option <?= $data['category_id'] == $category['id'] ? "selected='selected'" : null ?> value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" value="<?= $data['description'] ?>" id="description" name="description"
                                                   placeholder="Enter Description">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option <?= $data['status'] == 'a' ? "selected='selected'" : null ?> value="a">Active</option>
                                                <option <?= $data['status'] == 'p' ? "selected='selected'" : null ?> value="p">Passive</option>
                                                <option <?= $data['status'] == 'o' ? "selected='selected'" : null ?> value="o">Ongoing</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="progress">Progress</label>
                                            <input name="progress" id="progress" class="custom-range" value="<?= $data['progress']?>" type="range" min="0" max="100">
                                        </div>
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input type="color" class="form-control" id="color" value="<?= $data['color']?>"
                                                   name="color"">
                                        </div>
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <div class="row">
                                                <input type="date" class="form-control col-8" id="start_date"
                                                       value="<?= explode(' ',$data['start_date'])[0]?>" name="start_date"">
                                                <input type="time" class="form-control col-4" id="start_time"
                                                       value="<?= explode(' ',$data['start_date'])[1]?>" name="start_time"">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <div class="row">
                                                <input type="date" class="form-control col-8" id="end_date"
                                                       value="<?= explode(' ',$data['end_date'])[0]?>" name="end_date"">
                                                <input type="time" class="form-control col-4" id="end_time"
                                                       value="<?= explode(' ',$data['end_date'])[1]?>" name="end_time"">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
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
        const todo = document.getElementById('todo')


        todo.addEventListener('submit', (e) => {

            let title = document.getElementById('title').value
            let id = document.getElementById('id').value
            let description = document.getElementById('description').value
            let category_id = document.getElementById('category_id').value
            let color = document.getElementById('color').value
            let start_date = document.getElementById('start_date').value
            let end_date = document.getElementById('end_date').value
            let start_time = document.getElementById('start_time').value
            let end_time = document.getElementById('end_time').value
            let user_id = document.getElementById('user_id').value
            let progress = document.getElementById('progress').value
            let status = document.getElementById('status').value

            let formData = new FormData();
            formData.append('title', title)
            formData.append('id', id)
            formData.append('description', description)
            formData.append('category_id', category_id)
            formData.append('color', color)
            formData.append('start_date', start_date)
            formData.append('end_date', end_date)
            formData.append('start_time', start_time)
            formData.append('end_time', end_time)
            formData.append('user_id', user_id)
            formData.append('status', status)
            formData.append('progress', progress)


            axios.post('<?= url('api/edittodo') ?>', formData)
                .then(res => {
                    swal.fire(
                        res.data.title,
                        res.data.msg,
                        res.data.status
                    )
                })
                .catch(err => {
                    swal.fire(
                        'Oops!',
                        'An Unexpected Error Has Occured.',
                        'error'
                    )
                })
            e.preventDefault()
        })

    </script>
    </body>
    </html>

<?php

if (isset($_SESSION['error']['message'])) {
    $_SESSION['error']['message'] = null;
}
if (isset($_SESSION['error']['type'])) {
    $_SESSION['error']['type'] = null;
}
?>