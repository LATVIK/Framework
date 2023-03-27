<?php

use service\UsersAuthService;

include 'service/include/settings.php';
include '../service/include/func.php';


header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE, OPTIONS');
spl_autoload_register('myAutoloader');

$user = UsersAuthService::getUserByToken();

$route = '';
if (isset($_GET['route'])) {
    $route = $_GET['route'];
}
try {
    $controller = new api\controllers\MainController($user);
    $controller->main($route);
} catch (Exception $exception) {
    http_response_code($exception->getCode());
    echo json_encode($exception->getMessage());
}
