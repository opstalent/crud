<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Opstalent\CrudBundle\Annotation\Traits\ActionTrait;
use Opstalent\CrudBundle\Annotation\AbstractAnnotation;

/**
 * Class Entity
 * @package Opstalent\CrudBundle
 * @Annotation
 * @Target("CLASS")
 */
class Entity extends AbstractAnnotation
{
    use ActionTrait;

    /**
     * Entity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->addAvailableAction("deletable");
        $this->setActions("actions", $data);
    }
}
