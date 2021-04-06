<?php

namespace App\Exception;

use Exception;
use Throwable;

class UsedTokenException extends Exception
{
    public function __construct($message = "Token already used", Throwable $previous = null)
    {
        parent::__construct($message, 401, $previous);
    }
}