<?php


if ($process == 'list') {


    $q = $db->prepare('select * from todos where user_id= :user_id');
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
elseif ($process == 'getsingle') {

    $stmt = $db->prepare('select * from categories where user_id= :user_id');
    $stmt->execute([
        'user_id' => get_session('id')
    ]);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $q = $db->prepare('select * from todos 
         where todos.id= :id
         and todos.user_id= :user_id');
    $q->execute([
        'id' => $data['todo_id'],
        'user_id' => get_session('id')
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
            'data' => array_merge($q->fetch(PDO::FETCH_ASSOC), ['categories' => $categories])
        ];
    } else {
        return [
            'success' => false
        ];
    }
}
