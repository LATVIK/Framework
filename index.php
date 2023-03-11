<?php
include 'include.php';

spl_autoload_register('myAutoloader');

$route = [];
if (isset($_GET['route'])) {
    $route = explode('/', $_GET['route']);
}
$controller = new Controllers\MainController();
$controller->main($route);
