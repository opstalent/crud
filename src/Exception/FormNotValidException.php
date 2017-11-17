<?php

namespace Opstalent\CrudBundle\Exception;

use LogicException;
use Symfony\Component\Form\Form;
use Throwable;

/**
 * Class FormNotValidException
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle\Exception
 */
class FormNotValidException extends LogicException implements Exception
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * ActionUnavailableException constructor.
     * @param Form $form
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(Form $form, $message = "Form Invalid", $code = 0, Throwable $previous = null)
    {
        $this->form = $form;
        parent::__construct($message, $code, $previous);
    }
}
