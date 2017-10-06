<?php

namespace Opstalent\CrudBundle\Exceptions;

use Throwable;

class UnavailableActionException extends \Exception
{
    public function __construct($message = "Action unavailable", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
