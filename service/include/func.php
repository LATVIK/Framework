<?php

function myAutoloader(string $className)
{
    require_once '' . str_replace('\\', '/', $className) . '.php';
}
