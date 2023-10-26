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

    if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;

        $title = post('title');
        $result = model('categories', ['title' => $title, 'category_id' => post('category_id')], 'edit');

        add_session('error', [
            'message' => $result['message'],
            'type' => $result['type']
        ]);
    }

    $result = model('categories', ['category_id' => route(2)], 'getsingle');
    view('categories/edit',$result['data']);


}
elseif (route(0) === 'categories' && route(1) === "remove" && is_numeric(route(2))) {

    $result = model('categories', ['category_id' => route(2)], 'remove');
    redirect('categories');
}