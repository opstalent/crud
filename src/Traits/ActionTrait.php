<?php

namespace Opstalent\CrudBundle\Traits;

use Opstalent\CrudBundle\Annotations\AbstractAnnotation;

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
     * @param string $key
     * @param array $data
     * @return array
     */
    protected function setActions(array $data): array
    {
        foreach ($data as $action) {
            $this->addAction($action);
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
     * @param string $action
     * @return $this
     */
    protected function addAction(string $action)
    {
        if ($this->isActionAvailable($action)) {
            array_push($this->actions, $action);
        }
        return $this;
    }
}
