<?php

namespace Opstalent\CrudBundle\Exception;

use LogicException;
use Throwable;

/**
 * Class AnnotationNotDefinedException
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle\Exception
 */
class AnnotationNotDefinedException extends LogicException implements Exception
{
    const DEFAULT_MESSAGE = "Annotation not defined properly. 
        Please check documentation on https://github.com/opstalent/crud/blob/master/README.md";

    /**
     * AnnotationNotDefinedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = self::DEFAULT_MESSAGE,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
