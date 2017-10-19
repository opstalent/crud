<?php

namespace Opstalent\CrudBundle\Traits;

/**
 * Trait AvailableActionTrait
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
trait AvailableActionTrait
{
    /**
     * @var array
     */
    protected $availableActions = [
        'addable',
        'getable',
        'listable',
        'editable'
    ];

    /**
     * @param array $availableActions
     * @return $this
     */
    protected function setAvailableActions(array $availableActions)
    {
        $this->availableActions = $availableActions;
        return $this;
    }

    /**
     * @param string $action
     * @return bool
     */
    protected function isActionAvailable(string $action): bool
    {
        if (in_array($action, $this->availableActions)) {
            return true;
        }
        return false;
    }
}
