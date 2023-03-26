<?php

namespace api\controllers;

use controllers\BaseController;

class MainController extends BaseController
{
    public function buildingARoute(string $route)
    {
        $routes = require 'routes.php';

        if (key_exists($route, $routes)) {
            $controllerName = $routes[$route][0];
            $actionName = $routes[$route][1];
            $controller = new $controllerName($this->user);
            $controller->$actionName();
        } else {
            $this->getUnknownPage();
        }
    }

    public function main(string $route)
    {
        $this->buildingARoute($route);
    }

    public function getUnknownPage()
    {
        http_response_code(404);
    }
}
