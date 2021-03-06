<?php

namespace Opstalent\CrudBundle\Exception;

use LogicException;
use Throwable;

/**
 * Class MethodNotAllowedException
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class MethodNotAllowedException extends LogicException implements Exception
{
    /**
     * MethodNotAllowedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Method Not Allowed", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
