<?php
if (route(0) === 'login'){

    if (isset($_POST['submit'])){
        $mail = $_POST['mail'];
        $password = $_POST['password'];
    }

    view('auth/login');


}