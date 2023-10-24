<?php
if (get_session('login')){
    redirect('home');
}

if (route(0) === 'login') {

    if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;

        $mail = post('mail');
        $password = post('password');
        $result = model('auth/login', ['mail' => $mail, 'password' => $password], 'login');

        if ($result['success']) {
            redirect('home');
        } else {
            add_session('message', $result['message']);
        }
    }
    view('auth/login');
}