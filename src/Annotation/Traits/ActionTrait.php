<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation\Traits;

use Doctrine\Common\Annotations\AnnotationException;
use Opstalent\CrudBundle\Annotation\AbstractAnnotation;

/**
 * Trait ActionTrait
 * @package Opstalent\CrudBundle
 */
trait ActionTrait
{

    /**
     * @var string[]
     * @Required
     * @AnnotatedDescription("The property holds all available actions for class")
     */
    public $actions = [];

    /**
     * @var array
     */
    protected $availableActions = ['addable', 'getable', 'listable', 'editable'];

    protected function extractActions(string $key, array $data): array
    {
        if (array_key_exists($key, $data)) {
            foreach ($data[$key] as $action) {
                $this->enableAction($action);
            }
        }
        return $this->getActions();
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @return array
     */
    protected function getAvailableActions(): array
    {
        return $this->availableActions;
    }

    /**
     * @param string $name
     * @return int
     */
    protected function addAvailableAction(string $name): int
    {
        return array_push($this->availableActions, $name);
    }

    /**
     * @param string $action
     * @return bool
     * @throws AnnotationException
     */
    protected function isActionAvailable(string $action): bool
    {
        if (in_array($action, $this->availableActions)) {
            return true;
        }

        throw AnnotationException::semanticalError(
            sprintf(
                'The annotation action "%s" is not available.',
                $action
            )
        );
    }

    /**
     * @param string $action
     * @return Entity
     */
    protected function enableAction(string $action): AbstractAnnotation
    {
        if ($this->isActionAvailable($action)) array_push($this->actions, $action);
        return $this;
    }


}
