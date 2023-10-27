<?php
if (!get_session('login')) {
    redirect('login');
}

if (route(0) === 'todos' && !route(1)) {

    $result = model('todos', [], 'list');
    view('todos/todos', $result['data']);

}
elseif (route(0) === 'todos' && route(1) === "add") {
    $result = model('categories', [], 'list');
    view('todos/add',$result['data']);

}
elseif (route(0) === 'todos' && route(1) === "edit" && is_numeric(route(2))) {
    $result = model('todos', ['todo_id' => route(2)], 'getsingle');
    view('todos/edit',$result['data']);

}
