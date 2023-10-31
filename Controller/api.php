<?php

//echo json_encode(array_map(function ($key){
//    if ($key == Null) return $key.'is null';
//    else return $key;
//},$_POST));

if (route(1) === 'addtodo') {

    $post = filter($_POST);
    $start_date = $post['start_date'] ?? 'Y-m-d H:i:s';
    $end_date = $post['end_date'] ?? 'Y-m-d H:i:s';

    if (!$post['title']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter a Title';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
    if (!$post['description']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter a Description';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    if ($post['start_time'] && $post['start_date']) {
        $start_date = $post['start_date'] . ' ' . $post['start_time'];


    }
    if ($post['end_time'] && $post['end_date']) {
        $end_date = $post['end_date'] . ' ' . $post['end_time'];
    }

    if ($post['category_id']) {
        $stmt = $db->prepare('select * from categories where user_id= :user_id and id= :category_id');
        $stmt->execute([
            'user_id' => get_session('id'),
            'category_id' => $post['category_id']
        ]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$category) {
            $status = 'error';
            $title = 'Oops!';
            $msg = "This category doesn't exist. Please enter a valid one.";
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }


    $q = $db->prepare('insert into todos set 
                     todos.title= :title, 
                     todos.description= :description, 
                     todos.color= :color, 
                     todos.status= :status, 
                     todos.progress= :progress, 
                     todos.start_date= :start_date, 
                     todos.end_date= :end_date,  
                     todos.category_id= :category_id,
                     todos.user_id= :user_id');
    $result = $q->execute([
        'title' => $post['title'],
        'description' => $post['description'],
        'color' => $post['color'] ?? '#007bff',
        'status' => $post['status'] ?? 'a',
        'progress' => intval($post['progress']) ?? 0,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'category_id' => $post['category_id'] ?? 0,
        'user_id' => $post['user_id']
    ]);

    if ($result) {
        $status = 'success';
        $title = 'Yay! 🥳 ';
        $msg = 'Todo Added';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    } else {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'An unexpected error occurred. Please refresh your page and try again.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


}
elseif (route(1) === 'removetodo') {

    $post = filter($_POST);

    if (!$post['id']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'An unexpected error occurred. Please refresh your page and try again.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


    $q = $db->prepare('delete from todos where id= :id and user_id= :user_id');
    $result = $q->execute([
        'id' => $post['id'],
        'user_id' => get_session('id')
    ]);

    if ($result) {
        $status = 'success';
        $title = 'Succesful';
        $msg = 'Todo Removed';
        $id = $post['id'];
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'id' => $id]);
        exit();
    } else {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'An unexpected error occurred. Please refresh your page and try again.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

}
elseif (route(1) === 'calendar') {

   $start = get('start');
   $end = get('end');

    $sql = "
       Select id,
       title,
       color,
       start_date as start, 
       end_date as end, 
       CONCAT('/PHP-Todo-App/en/todos/edit/',todos.id) as url 
       from todos where user_id= :user_id";

    if ($start && $end){
        $sql .= " && start_date BETWEEN '$start' AND '$end' OR end_date BETWEEN '$start' AND '$end' ";
    }

    $q = $db->prepare($sql);
    $q->execute(['user_id' => get_session('id')]);
    $result = $q->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}
elseif (route(1) === 'updateprofile') {

    $post = filter($_POST);

    if (!$post['name']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter Your Name';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
    if (!$post['surname']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter Your Surname';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
    if (!$post['mail']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter a Valid Mail';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


    $q = $db->prepare('update users set 
                     users.name= :name, 
                     users.surname= :surname, 
                     users.mail= :mail
                     where users.id= :user_id
                     ');
    $result = $q->execute([
        'name' => $post['name'],
        'surname' => $post['surname'],
        'mail' => $post['mail'],
        'user_id' => intval($post['id'])
    ]);
    if ($result) {
        add_session('id',$post['id']);
        add_session('name',$post['name']);
        add_session('surname',$post['surname']);
        add_session('mail',$post['mail']);
        add_session('login',true);


        $status = 'success';
        $title = 'Yay! 🥳 ';
        $msg = 'Information Updated';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    } else {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'An unexpected error occurred. Please refresh your page and try again.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


}
elseif (route(1) === 'updatepassword') {

    $post = filter($_POST);

    if (!$post['oldPassword']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter Your Password';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
    if (!$post['newPassword']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter Your New Password';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
    if (!$post['repeatPassword']) {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Please Enter Your New Password Again';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
    if ($post['repeatPassword'] != $post['newPassword']){
        $status = 'error';
        $title = 'Oops!';
        $msg = 'The Entered Passwords Do Not Match';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    // Password validation
    $isLengthValid = strlen($post['newPassword']) >= 9;
    $isUppercaseValid = preg_match('/[A-Z]/', $post['newPassword']);
    $isDigitValid = preg_match('/\d/', $post['newPassword']);
    $isSpecialValid = preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $post['newPassword']);
    // Password Validation

    if ($isLengthValid && $isUppercaseValid && $isDigitValid && $isSpecialValid) {

        $q = $db->prepare('select password from users where id= :user_id');
        $q->execute(['user_id' => $post['id']]);
        $pw = $q->fetchColumn();

        if (md5($post['oldPassword']) == $pw ){
            $q = $db->prepare('update users set 
                     users.password= :newPassword
                     where users.id= :user_id
                     ');
            $result = $q->execute([
                'newPassword' => md5($post['newPassword']),
                'user_id' => intval($post['id'])
            ]);
            if ($result) {
                $status = 'success';
                $title = 'Yay! 🥳 ';
                $msg = 'Password Changed';
                echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
                exit();
            } else {
                $status = 'error';
                $title = 'Oops!';
                $msg = 'An unexpected error occurred. Please refresh your page and try again.';
                echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
                exit();
            }
        } else {
            $status = 'error';
            $title = 'Oops!';
            $msg = 'Incorrect password';

            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    } else {
        $status = 'error';
        $title = 'Oops!';
        $msg = 'Your Password Doesnt Match Requirements';

        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }






}
