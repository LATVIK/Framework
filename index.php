<?php
include 'service/include/func.php';
include 'service/include/settings.php';

spl_autoload_register('myAutoloader');

$route = [];
if (isset($_GET['route'])) {
    $route = explode('/', $_GET['route']);
}
$controller = new controllers\MainController();
$controller->main($route);
