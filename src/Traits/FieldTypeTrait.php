<?php

namespace Opstalent\CrudBundle\Traits;

use Symfony\Component\Form\FormTypeInterface;

/**
 * Trait FieldTypeTrait
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
trait FieldTypeTrait
{
    /**
     * @param string $type
     * @return bool
     */
    protected function isTypeAvailable(string $type): bool
    {
        if (is_subclass_of(new $type(), FormTypeInterface::class)) {
            return true;
        }
        return false;
    }
}
