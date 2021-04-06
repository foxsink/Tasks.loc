<?php

namespace App\Exception;

use Exception;
use Throwable;

class UserNotFoundException extends Exception
{
    public function __construct($message = "User not found", Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}