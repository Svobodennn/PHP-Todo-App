<?php view('static/header')?>

<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Todo</b>App</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><?= lang('Sign in to start your session') ?></p>
                <?php
                echo get_session('message') != false ?  '<div class="alert alert-danger">'.get_session('message').'</div>' : null;
                add_session('message',false);
                ?>
                <form action="<?= URL.'en/login' ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="mail" placeholder="Email" value="<?= $_SESSION['post']['mail'] ?? null ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $_SESSION['post']['password'] ?? null ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

</div>


<!-- jQuery -->
<script src=" <?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src=" <?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>
<!-- AdminLTE App -->
<script src=" <?= assets('js/adminlte.min.js') ?> "></script>
</body>
</html>

<?php
if (isset($_SESSION['message'])){
    $_SESSION['message'] = null;
}
if (isset($_SESSION['post'])){
    $_SESSION['post'] = null;
}?>
