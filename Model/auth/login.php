<?php


if ($process == 'login') {

    if (!$data['mail']){
        return [
            'success' => false,
            'message' => 'Please Enter Your Mail'
        ];
    }
    if (!$data['password']){
        return [
            'success' => false,
            'message' => 'Please Enter Your Password'
        ];
    }


    $q = $db->prepare('Select * from users where mail= :mail and password= :password');
    $q->execute([
        'mail' => $data['mail'],
        'password' => md5($data['password'])
    ]);

    if ($q->rowCount()) {
        $user = $q->fetch(PDO::FETCH_ASSOC);
        add_session('id', $user['id']);
        add_session('name', $user['name']);
        add_session('surname', $user['surname']);
        add_session('mail', $user['mail']);
        add_session('login', true);

        return [
            'success' => true,
            'data' => $user
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Incorrect Mail or Password'
        ];
    }
}