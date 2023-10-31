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
                <a href="index3.html" class="nav-link">Your profile</a>
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
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Your Profile</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="profile" action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input required="required" type="text" class="form-control" id="name"
                                               name="name"
                                               value="<?= get_session('name') ?>">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                                               value="<?= get_session('id') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Surname</label>
                                        <input required="required" type="text" class="form-control" id="surname"
                                               name="surname"
                                               value="<?= get_session('surname') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="mail">Mail</label>
                                        <input required="required" type="text" class="form-control" id="mail"
                                               name="mail"
                                               value="<?= get_session('mail') ?>">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="change_password" action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="password">Old Password</label>
                                        <input type="password" class="form-control" id="password" name="password"">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                                               value="<?= get_session('id') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password"
                                               name="new_password">
                                        <div class="password-criteria">
                                            Password must meet the following criteria:
                                            <ul>
                                                <li id="length">At least 9 characters long</li>
                                                <li id="uppercase">Contain at least one uppercase letter (A-Z)</li>
                                                <li id="digit">Contain at least one digit (0-9)</li>
                                                <li id="special">Contain at least one special character (e.g., @, #, $,
                                                    %, etc.)
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeat_password">Repeat New Password</label>
                                        <input type="password" class="form-control" id="repeat_password"
                                               name="repeat_password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
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
    const profile = document.getElementById('profile')
    const change_password = document.getElementById('change_password')


    // Password Validation
    function checkValidation(element) {
        return element.style.color === 'green';
    }

    var lengthMessage = document.getElementById('length');
    var uppercaseMessage = document.getElementById('uppercase');
    var digitMessage = document.getElementById('digit');
    var specialMessage = document.getElementById('special');

    document.getElementById('new_password').addEventListener('input', function () {
        let password = this.value;
        console.log(password)

        if (password.length >= 9) {
            lengthMessage.style.color = 'green';
        } else {
            lengthMessage.style.color = 'red';
        }

        if (/[A-Z]/.test(password)) {
            uppercaseMessage.style.color = 'green';
        } else {
            uppercaseMessage.style.color = 'red';
        }

        if (/\d/.test(password)) {
            digitMessage.style.color = 'green';
        } else {
            digitMessage.style.color = 'red';
        }

        if (/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
            specialMessage.style.color = 'green';
        } else {
            specialMessage.style.color = 'red';
        }
    });
    // Password Validation


    profile.addEventListener('submit', (e) => {

        let name = document.getElementById('name').value
        let surname = document.getElementById('surname').value
        let mail = document.getElementById('mail').value
        let id = document.getElementById('user_id').value


        let formData = new FormData();
        formData.append('name', name)
        formData.append('surname', surname)
        formData.append('mail', mail)
        formData.append('id', id)


        axios.post('<?= url('api/updateprofile') ?>', formData)
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
    change_password.addEventListener('submit', (e) => {

        let oldPassword = document.getElementById('password').value
        let newPassword = document.getElementById('new_password').value
        let repeatPassword = document.getElementById('repeat_password').value
        let id = document.getElementById('user_id').value


        let formData = new FormData();
        formData.append('oldPassword', oldPassword)
        formData.append('newPassword', newPassword)
        formData.append('repeatPassword', repeatPassword)
        formData.append('id', id)

        if (checkValidation(lengthMessage) && checkValidation(uppercaseMessage) && checkValidation(digitMessage) && checkValidation(specialMessage)) {
            axios.post('<?= url('api/updatepassword') ?>', formData)
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
        } else {
            swal.fire(
                'Incorrect Password',
                'Your Password Doesnt Match Requirements',
                'error'
        )
        }

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