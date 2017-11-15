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
    /**
     * AnnotationNotDefinedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = "Annotation not defined properly.",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
