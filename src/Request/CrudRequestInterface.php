<?php

namespace Opstalent\CrudBundle\Request;

use Symfony\Component\Form\FormInterface;

/**
 * Class CrudRequestInterface
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
interface CrudRequestInterface
{
    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return string
     */
    public function getClassName(): string;

    /**
     * @param FormInterface $form
     * @return $this
     */
    public function setForm(FormInterface $form): CrudRequestInterface;
}
