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
        'user_id' => $_SESSION,
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
            'message' => 'Category Succesfully Created.',
            'type' => 'info',
            'data' => get_session('id')
        ];
    } else {
        return [
            'success' => false,
            'message' => "Something Went Wrong",
            'type' => 'danger'
        ];
    }
}