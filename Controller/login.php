<?php
if (route(0) === 'login'){

    if (isset($_POST['submit'])){
        $mail = post('mail');
        $password = post('password');
    }

    view('auth/login');


}