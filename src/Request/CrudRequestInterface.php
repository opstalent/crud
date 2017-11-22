<?php

namespace Opstalent\CrudBundle\Request;

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
}
