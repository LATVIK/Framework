<?php

namespace Controllers;

class MainController extends BaseController
{
    public function buildingARoute(array $route)
    {
        $controllerName = array_shift($route);
        $routes = require 'routes.php';

        if (key_exists($controllerName, $routes)) {
            $controller = new $routes[$controllerName]();
            $controller->main($route);
        } else {
            $this->getUnknownPage();
        }
    }

    public function getUnknownPage()
    {
        include 'views/unknown_page.php';
    }

    public function addHead()
    {
        include 'views/default/head.html';
    }

    public function addHeader()
    {
        include 'views/default/header.html';
    }

    public function addFooter()
    {
        include 'views/default/footer.html';
    }

    public function main(array $route)
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
        echo '</body>';
    }
}
