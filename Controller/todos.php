<?php
if (!get_session('login')) {
    redirect('login');
}

if (route(0) === 'todos' && !route(1)) {

    $result = model('todos', [], 'list');
    view('todos/todos', $result['data']);

}
elseif (route(0) === 'todos' && route(1) === "add") {

    if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;

        $title = post('title');
        $result = model('todos', ['title' => $title], 'add');

        add_session('error', [
            'message' => $result['message'] ?? null,
            'type' => $result['type'] ?? null
        ]);
    }

    $result = model('categories', [], 'list');
    view('todos/add',$result['data']);

}
elseif (route(0) === 'todos' && route(1) === "edit" && is_numeric(route(2))) {

    if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;

        $title = post('title');
        $result = model('todos', ['title' => $title, 'todo_id' => post('todo_id')], 'edit');

        add_session('error', [
            'message' => $result['message'],
            'type' => $result['type']
        ]);
    }

    $result = model('todos', ['todo_id' => route(2)], 'getsingle');
    view('todos/edit',$result['data']);


}
elseif (route(0) === 'todos' && route(1) === "remove" && is_numeric(route(2))) {

    $result = model('todos', ['todo_id' => route(2)], 'remove');
    redirect('todos');
}