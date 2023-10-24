<?php
const BASEDIR = 'C:\xampp\htdocs\PHP-Todo-App';
const URL = "http://localhost/PHP-Todo-App/";
const DEV_MODE = true;

try {
    $db = new PDO('mysql:host=localhost;dbname=todoapp', 'root', '');
} catch (PDOException $e) {
    $e->getMessage();
}
