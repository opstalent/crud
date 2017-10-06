<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Opstalent\CrudBundle\Annotation\Traits\ActionTrait;

/**
 * Class Field
 * @package Opstalent\CrudBundle
 * @Annotation
 * @Target("PROPERTY")
 */
class Field
{
    use ActionTrait;

    /**
     * @var string[]
     * @Required
     * @AnnotatedDescription("The property holds all available actions for class")
     */
    public $actions = [];

    /**
     * Entity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (array_key_exists("actions", $data)) {
            foreach ($data['actions'] as $action) {
                $this->addAction($action);
            }
        }
    }

    /**
     * @param string $action
     *
     * @return Field
     */
    public function addAction(string $action): Field
    {
        if ($this->isActionAvailable($action)) array_push($this->actions, $action);
        return $this;
    }
}
