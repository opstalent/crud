<?php

namespace Opstalent\CrudBundle\Exception;

/**
 * Class NotAllowedTypeException
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class TypeNotAllowedException extends \LogicException implements Exception
{
    /**
     * NotAllowedTypeException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Type Not Allowed", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
