<?php

namespace Opstalent\CrudBundle\Exception;

use Throwable;
use LogicException;

/**
 * Class ClassNotFoundException
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle\Exception
 */
class ClassNotFoundException extends LogicException implements Exception
{
    /**
     * ClassNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Class not found.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
