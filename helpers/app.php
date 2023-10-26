<?php
function route($index)
{
    global $config;
    if (isset($config['route'][$index])) {
        return $config['route'][$index];
    } else
        return false;
}

function view($viewName, $pageData = [])
{
    global $config;
    $data = $pageData;
    if (file_exists(BASEDIR . '/View/' . $viewName . '.php')) {
        require BASEDIR . '/View/' . $viewName . '.php';
    } else
        return false;
}

function assets($assetName)
{
    if (file_exists(BASEDIR . '/public/' . $assetName)) {
        return URL . 'public/' . $assetName;
    } else
        return false;
}

function lang($text)
{

    global $lang;
    if (isset($lang[$text])) {
        return $lang[$text];
    } else
        return $text;
}

function add_session($index, $value)
{
    $_SESSION[$index] = $value;
}

function get_session($index)
{
    if (isset($_SESSION[$index])) {
        return $_SESSION[$index];
    } else
        return false;
}

function filter($field){
    return is_array($field)
        ?
        array_map('filter',$field)
        :
        htmlspecialchars(trim($field));
}
function post($index)
{
    if (isset($_POST[$index])) {
        return filter($_POST[$index]);
    } else
        return false;
}

function get($index)
{
    if (isset($_GET[$index])) {
        return filter($_GET[$index]);
    } else
        return false;
}

function get_cookie($index)
{
    if (isset($_COOKIE[$index])) {
        return htmlspecialchars(trim($_COOKIE[$index]));
    } else
        return false;
}

function model($modelName, $pageData = [], $data_process = null)
{
    global $db;
    $process = $data_process;
    $data = $pageData;
    if (file_exists(BASEDIR . '/Model/' . $modelName . '.php')) {
        $result = require BASEDIR . '/Model/' . $modelName . '.php';
        return $result;
    } else
        return false;
}

function redirect($link){
    global $config;
    header('Location:'.url($link));
}

function url($url){
    global $config;
    return URL.$config['lang'].'/'.$url;
}

function debug($data){
    echo "<pre style='background: #1d1d1d; color: greenyellow; position: absolute; left: 0; top: 0; z-index: 999; width: 100%;height: 100%;'>";
    print_r($data);
    echo "</pre>";
}