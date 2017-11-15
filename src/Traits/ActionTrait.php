<?php

namespace Opstalent\CrudBundle\Traits;

/**
 * Trait ActionTrait
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
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
     * @param array $data
     * @return $this
     */
    protected function setActions(array $data)
    {
        foreach ($data as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @param string $action
     * @return $this
     */
    protected function addAction(string $action)
    {
        if ($this->isActionAvailable($action)) {
            $this->actions[] = $action;
        }
        return $this;
    }

    /**
     * @param string $action
     * @return bool
     */
    public function isValidAction(string $action): bool
    {
        return in_array($action, $this->getActions());
    }
}
