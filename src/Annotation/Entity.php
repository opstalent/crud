<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Opstalent\CrudBundle\Annotation\Traits\ActionTrait;

/**
 * Class Entity
 * @package Opstalent\CrudBundle
 * @Annotation
 * @Target("CLASS")
 */
class Entity
{
    use ActionTrait;

    /**
     * @var array<string>
     * @Required
     * @AnnotatedDescription("The property holds all available actions for class")
     */
    public $actions;


    public function __construct(array $data)
    {
        $this->addAvailableAction("deletable");
        if(array_key_exists("actions", $data)) $this->setActions($data['actions']);;
    }

    /**
     * @param array $actions
     * @return Entity
     */
    public function setActions(array $actions): Entity
    {
        if($this->isAvailableActions($actions)) $this->actions = $actions;
        return $this;
    }
}
