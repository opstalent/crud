<?php

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use Opstalent\CrudBundle\Exceptions\UnavailableActionException;

/**
 * Class AbstractAnnotation
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
abstract class AbstractAnnotation
{
    /**
     * @var string[]
     *
     * @Required
     */
    protected $actions = [];

    /**
     * @var array
     */
    protected $availableActions = [];

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function setActions(array $data): AbstractAnnotation
    {
        if (array_key_exists('actions', $data)) {
            foreach ($data['actions'] as $action) {
                $this->enableAction($action);
            }
        }
        return $this;
    }

    /**
     * @param array $availableActions
     * @return AbstractAnnotation
     */
    protected function setAvailableActions(array $availableActions): AbstractAnnotation
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
        return in_array($action, $this->availableActions);
    }

    /**
     * @param string $action
     * @return Entity
     */
    protected function enableAction(string $action): AbstractAnnotation
    {
        if ($this->isActionAvailable($action)) {
            array_push($this->actions, $action);
        } else {
            throw new UnavailableActionException();
        }
        return $this;
    }
}
