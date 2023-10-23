<?php
foreach (glob(__DIR__.'/helpers/*.php') as $file ){
    require $file;
}
$config['route'] = 'home';
$config['lang'] = 'en';

if (isset($_GET['route'])) {

    $pattern = '@^/PHP-Todo-App/(?<lang>[a-z]{2})(?:/(?<route>.+))?@';
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    preg_match($pattern, $url, $result);
}

if (isset($result['lang'])) {
    if (file_exists(__DIR__ . '/language/' . $result['lang'] . '.php')) {
        $config['lang'] = $result['lang'];
    } else {
        $config['lang'] = 'en';
    }
}

$config['route'] = explode('/',$result['route']);

if (file_exists(__DIR__.'/Controller/'.$config['route'][0].'.php')){
    require __DIR__.'/Controller/'.$config['route'][0].'.php';
} else {
    echo "Page not found";
}



require __DIR__ . '/language/' . $config['lang'] . '.php';
