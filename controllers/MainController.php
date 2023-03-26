<?php

namespace controllers;

class MainController extends BaseController
{
    public function buildingARoute(string $route)
    {
        $routes = require 'service/include/routes.php';

        if (key_exists($route, $routes)) {
            $controllerName = $routes[$route][0];
            $actionName = $routes[$route][1];
            $controller = new $controllerName($this->user);
            $controller->$actionName();
        } else {
            $this->getUnknownPage();
        }
    }

    public function addHead()
    {
        include 'views/default/head.html';
    }

    public function addHeader()
    {
        include 'views/default/header.php';
    }

    public function addFooter()
    {
        include 'views/default/footer.html';
    }

    public function addJs()
    {
        echo '<script src="../service/include/functions.js"></script>';
    }

    public function main(string $route)
    {
        $this->addHead();
        echo '<body>';
        $this->addHeader();
        echo '<div class="main-container">';
        echo '<div class="content">';

        $this->buildingARoute($route);

        echo '</div>';
        echo '</div>';
        $this->addFooter();
        $this->addJs();
        echo '</body>';
    }
}
