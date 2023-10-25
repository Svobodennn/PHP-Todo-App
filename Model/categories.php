<?php


if ($process == 'add') {

    if (!$data['title']){
        return [
            'success' => false,
            'message' => 'Please Enter a Title for Your Category',
            'type' => 'danger'
        ];
    }


    $q = $db->prepare('insert into categories set title= :title, user_id= :user_id');
    $q->execute([
        'title' => $data['title'],
        'user_id' => get_session('id'),
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
            'message' => 'Category Succesfully Created.',
            'type' => 'info',
        ];
    } else {
        return [
            'success' => false,
            'message' => "Something Went Wrong",
            'type' => 'danger'
        ];
    }
}
elseif ($process == 'list') {


    $q = $db->prepare('select * from categories where user_id= :user_id');
    $q->execute([
        'user_id' => get_session('id'),
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
            'data' => $q->fetchAll(PDO::FETCH_ASSOC)
        ];
    } else {
        return [
            'success' => false
        ];
    }
}
elseif ($process == 'remove') {

    $id = $data['category_id'];
    $q = $db->prepare('delete from categories where id= :id');
    $q->execute([
        'id' => $id,
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
        ];
    } else {
        return [
            'success' => false
        ];
    }
}