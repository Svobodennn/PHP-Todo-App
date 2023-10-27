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
elseif (route(1) === 'edittodo') {

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


    $q = $db->prepare('update todos set 
                     todos.title= :title, 
                     todos.description= :description, 
                     todos.color= :color, 
                     todos.status= :status, 
                     todos.progress= :progress, 
                     todos.start_date= :start_date, 
                     todos.end_date= :end_date,  
                     todos.category_id= :category_id
                     where todos.user_id= :user_id
                     and todos.id= :id');
    $result = $q->execute([
        'title' => $post['title'],
        'description' => $post['description'],
        'color' => $post['color'] ?? '#007bff',
        'status' => $post['status'] ?? 'a',
        'progress' => intval($post['progress']) ?? 0,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'category_id' => intval($post['category_id']) ?? 0,
        'user_id' => intval($post['user_id']),
        'id' => intval($post['id'])
    ]);
    if ($result) {
        $status = 'success';
        $title = 'Yay! 🥳 ';
        $msg = 'Todo Updated';
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
elseif (route(1) === 'removetodo'){

    $post = filter($_POST);

    if (!$post['id']){
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
