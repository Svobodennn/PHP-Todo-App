<?php
session_start();
require __DIR__ . '/config/config.php';

if (DEV_MODE) {
    error_reporting(E_ALL);
    ini_set('error_reporting', true);
} else {
    error_reporting(0);
    ini_set('error_reporting', false);
}

foreach (glob(__DIR__ . '/helpers/*.php') as $file) {
    require $file;
}

$config['route'][0] = 'home';
$config['lang'] = 'en';

if (isset($_GET['route'])) {

    $pattern = '@^/PHP-Todo-App/(?<lang>[a-z]{2})(?:/(?<route>.+))?@';
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    preg_match($pattern, $url, $result);
}

if (isset($result['lang'])) {
    if (file_exists(BASEDIR . '/language/' . $result['lang'] . '.php')) {
        $config['lang'] = $result['lang'];
    } else {
        $config['lang'] = 'en';
    }
}

if (isset($result['route'])) {
    $config['route'] = explode('/', $result['route']);
}

require BASEDIR . '/language/' . $config['lang'] . '.php';


if (file_exists(BASEDIR . '/Controller/' . $config['route'][0] . '.php')) {
    require BASEDIR . '/Controller/' . $config['route'][0] . '.php';
} else {

    print_r($config);
    exit();
    echo "Page not found";
}


//if (isset($_SESSION['error'])) $_SESSION['error'] = null;
//if (isset($_SESSION['post'])) $_SESSION['post'] = null;
