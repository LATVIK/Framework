<?php

namespace service\Exception;

class NoFoundException extends \Exception
{
    protected $code = 404;
}