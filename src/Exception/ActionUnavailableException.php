<?php

namespace Opstalent\CrudBundle\Exception;

use LogicException;
use Throwable;

/**
 * Class ActionUnavailableException
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle\Exception
 */
class ActionUnavailableException extends LogicException implements Exception
{
    /**
     * ActionUnavailableException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Unavailable Action", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
