<?php

namespace Controllers;

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
        }
    }
}
