<?php

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Field
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 *
 * @Annotation
 * @Target("PROPERTY")
 */
class Field extends AbstractAnnotation
{
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
            'editable'
        ]);
        $this->setActions($data);
    }
}
