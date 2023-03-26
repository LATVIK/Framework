<?php

namespace service\Exception;

class UnauthorizedException extends \Exception
{
    protected $message = 'Authorization failed';
    protected $code = 401;
}
