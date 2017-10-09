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
trait ActionTrait
{

    protected $availableActions = ['addable', 'getable', 'listable', 'editable'];

    /**
     * @return array
     */
    protected function getAvailableActions(): array
    {
        return $this->availableActions;
    }

    /**
     * @param string $name
     *
     * @return int
     */
    protected function addAvailableAction(string $name): int
    {
        return array_push($this->availableActions, $name);
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    protected function isActionAvailable(string $action): bool
    {
        if(in_array($action, $this->availableActions)) {
            return true;
        }

        throw AnnotationException::semanticalError(
            sprintf(
                'The annotation action "%s" is not available.',
                $action
            )
        );
    }
}
