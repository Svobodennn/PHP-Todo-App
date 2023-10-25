<?php
if (!get_session('login')) {
    redirect('login');
}

if (route(0) === 'categories' && !route(1)) {

    $result = model('categories', [], 'list');
    view('categories/categories', $result['data']);

}
elseif (route(0) === 'categories' && route(1) === "add") {

    if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;

        $title = post('title');
        $result = model('categories', ['title' => $title], 'add');

        add_session('error', [
            'message' => $result['message'] ?? null,
            'type' => $result['type'] ?? null
        ]);
    }


    view('categories/add');

}
elseif (route(0) === 'categories' && route(1) === "edit" && is_numeric(route(2))) {


    view('categories/edit');
}
elseif (route(0) === 'categories' && route(1) === "remove" && is_numeric(route(2))) {

    $result = model('categories', ['category_id' => route(2)], 'list');
    view('categories/edit');
}