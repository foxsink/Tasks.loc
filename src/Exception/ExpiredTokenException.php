<?php

namespace App\Exception;

use Exception;
use Throwable;

class ExpiredTokenException extends Exception
{
    public function __construct($message = "Token expired", Throwable $previous = null)
    {
        parent::__construct($message, 401, $previous);
    }
}