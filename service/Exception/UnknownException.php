<?php

namespace service\Exception;

class UnknownException extends \Exception
{
    protected $message = 'Unknown exception';
    protected $code = 520;
}
