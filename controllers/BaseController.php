<?php

namespace controllers;

abstract class BaseController
{
    public function main(array $route)
    {
        $action = array_shift($route);
        if (!$action) {
            $action = 'index';
        }
        $action .= 'Action';
        if (method_exists($this, $action)) {
            $this->$action($route);
        } else {
            $this->getUnknownPage();
        }
    }


    public function getUnknownPage()
    {
        http_response_code(404);
        include 'views/unknown_page.php';
    }
}
