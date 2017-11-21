<?php

namespace Opstalent\CrudBundle;

/**
 * Class CrudHandlingInterface
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
abstract class CrudHandlingInterface
{
    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $className;

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }
}
