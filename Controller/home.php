<?php

if (route(0) === 'home' && !route(1)){
    $result = model('home', [], 'list');
    view('home/home', $result['data']);
}
elseif (route(0) === 'home' && route(1) == 'calendar'){

    view('home/calendar');
}