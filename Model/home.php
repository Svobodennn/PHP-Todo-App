<?php


if ($process == 'list') {


    $q = $db->prepare('Select todos.*, c.title as category from todos
         left join categories c on c.id = todos.category_id
         where todos.user_id= :user_id and status= :status order by start_date asc');
    $q->execute([
        'user_id' => get_session('id'),
        'status' => 'o',
    ]);
    $todos = $q->fetchAll(PDO::FETCH_ASSOC);


    $q = $db->prepare('select status, 
       count(todos.id) as total, 
       (count(todos.id) * 100 / (SELECT count(id) from todos where user_id= :user_id)) as percentage 
       from todos 
       where user_id= :user_id group by status');
    $q->execute([
        'user_id' => get_session('id'),
    ]);

    if ($q->rowCount()) {
        return [
            'success' => true,
            'data' => array_merge(['statistic' => $q->fetchAll(PDO::FETCH_ASSOC)], ['progress' => $todos] )
        ];
    } else {
        return [
            'success' => false
        ];
    }
}
