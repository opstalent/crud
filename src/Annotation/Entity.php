<?php

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;
use Opstalent\CrudBundle\Traits\ActionTrait;
use Opstalent\CrudBundle\Traits\AvailableActionTrait;

/**
 * Class Entity
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 *
 * @Annotation
 * @Target("CLASS")
 */
class Entity
{
    use ActionTrait;
    use AvailableActionTrait;

    /**
     * Entity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setAvailableActions([
            'addable',
            'getable',
            'listable',
            'editable',
            'deletable'
        ]);
        $this->setActions($data['actions']);
    }
}
