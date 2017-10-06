<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation\Traits;

use Doctrine\Common\Annotations\AnnotationException;
/**
 * Trait ActionTrait
 * @package Opstalent\CrudBundle
 */
trait ActionTrait {

    protected $availableActions = ['addable', 'getable', 'listable', 'editable'];
    /**
     * @return array
     */
    protected function getAvailableActions(): array
    {
        return $this->availableActions;
    }

    protected function addAvailableAction(string $name): int
    {
        return array_push($this->availableActions, $name);
    }

    /**
     * @param array $actions
     * @return bool
     */
    protected function isAvailableActions(array $actions): bool
    {
        return !array_diff($actions, $this->getAvailableActions());
    }
}
