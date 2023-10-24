<?php
if (!get_session('login')) {
    redirect('login');
}

if (route(0) === 'categories' && !route(1)) {

//    if (isset($_POST['submit'])) {
//        $_SESSION['post'] = $_POST;
//
//        $mail = post('mail');
//        $password = post('password');
//        $result = model('auth/login', ['mail' => $mail, 'password' => $password], 'login');
//
//        if ($result['success']) {
//            redirect('home');
//        } else {
//            add_session('message', $result['message']);
//        }
//    }

    view('categories/categories');
} elseif (route(0) === 'categories' && route(1) === "add") {

        if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;

        $title = post('title');
        $result = model('categories', ['title' => $title],'add');

        add_session('error',[
            'message' => $result['message'] ?? '',
            'type' => $result['type'] ?? ''
        ]);
    }


    view('categories/add');

}elseif (route(0) === 'categories' && route(1) === "edit" && is_numeric(route(2))) {
    view('categories/edit');
}