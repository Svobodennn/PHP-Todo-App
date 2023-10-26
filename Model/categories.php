<?php


if ($process == 'add') {

    if (!$data['title']) {
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
} elseif ($process == 'list') {


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
elseif ($process == 'edit') {


    $q = $db->prepare('update categories set title= :title where id= :id and user_id= :user_id');
    $q->execute([
        'title' => $data['title'],
        'id' => $data['category_id'],
        'user_id' => get_session('id')
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
            'message' => "Category Title Succesfully Changed",
            'type' => 'success'
        ];
    } else {
        return [
            'success' => false,
            'message' => "Something Went Wrong",
            'type' => 'danger'
        ];
    }
}
elseif ($process == 'getsingle') {
    $q = $db->prepare('select * from categories where categories.id= :id and user_id= :user_id');
    $q->execute([
        'id' => $data['category_id'],
        'user_id' => get_session('id')
    ]);
    if ($q->rowCount()) {
        return [
            'success' => true,
            'data' => $q->fetch(PDO::FETCH_ASSOC)
        ];
    } else {
        return [
            'success' => false
        ];
    }
}
elseif ($process == 'remove') {

    if (!$data['title']) {
        return [
            'success' => false,
            'message' => 'Please Enter a Title for Your Category',
            'type' => 'danger'
        ];
    }

    $id = $data['category_id'];
    $q = $db->prepare('delete from categories where id= :id && categories.user_id = :user_id');
    $result = $q->execute([
        'id' => $id,
        'user_id' => get_session('id')
    ]);

    if ($result) {
        add_session('error', [
            'message' => 'Category Succesfully Deleted.',
            'type' => 'success',
        ]);
        return [
            'success' => true,
            'message' => 'Category Succesfully Deleted.',
            'type' => 'info',
        ];
    } else {
        add_session('error', [
            'message' => "Something Went Wrong",
            'type' => 'danger'
        ]);
        return [
            'success' => false,
            'message' => "Something Went Wrong",
            'type' => 'danger'
        ];
    }
}