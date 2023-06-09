<?php

use service\UsersAuthService;

include 'service/include/func.php';
include 'service/include/settings.php';

spl_autoload_register('myAutoloader');

$user = UsersAuthService::getUserByToken();

$route = '';
if (isset($_GET['route'])) {
    $route = $_GET['route'];
}
$controller = new controllers\MainController($user);
$controller->main($route);
