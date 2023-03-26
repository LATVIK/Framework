<?php

function myAutoloader(string $className)
{
    require_once ROOT . str_replace('\\', '/', $className) . '.php';
}
