<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.10.2022
 * Time: 00:32
 */
require "application/lib/Dev.php";

use application\core\Router;
use application\lib\Db;

spl_autoload_register(function ($class) {
//    include 'classes/' . $class . '.class.php';
    $path = str_replace('\\', '/', $class . ".php");
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router;
$router->run();
$db = new Db;