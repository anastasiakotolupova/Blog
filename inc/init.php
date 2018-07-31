<?php


// open the session
session_start();

if($_SERVER['SERVER_NAME'] == 'localhost') {

    $dsn = 'mysql:host=localhost; dbname=blog';
    $login = 'root';
    $pwd = '';
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $login, $pwd, $attributes);

    //>> declare CONSTANTS
    define('URL', 'http://localhost/php/Blog/');
    define('ROOT_TREE', $_SERVER['DOCUMENT_ROOT'] . '/PHP/Blog/');
    // We just declared the way to access our files + URL
} else {
    $dsn = 'mysql:host=localhost; dbname=id6644743_blog';
    $login = 'id6644743_blog';
    $pwd = 'webforce3';
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $login, $pwd, $attributes);

    //>> declare CONSTANTS
    define('URL', 'http://mybestblog.000webhostapp.com/');
    define('ROOT_TREE', $_SERVER['DOCUMENT_ROOT'] . '/PHP/Blog/');
    // We just declared the way to access our files + URL
}
//>> declare VARIABLES
$msg_error = "";
$page = "";

require_once("functions.php");