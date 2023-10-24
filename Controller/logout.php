<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Destroy the session
session_destroy();

// Redirect to the login page or wherever you want
redirect('login');
exit();
