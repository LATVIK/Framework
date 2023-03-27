<?php

function myAutoloader(string $className): void
{
    require_once ROOT . str_replace('\\', '/', $className) . '.php';
}
