<?php

namespace service\Exception;

class AccessDeniedException extends \Exception
{
    protected $code = 403;
}
