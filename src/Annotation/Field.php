<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Opstalent\CrudBundle\Annotation\Traits\ActionTrait;
use Opstalent\CrudBundle\Annotation\AbstractAnnotation;

/**
 * Class Field
 * @package Opstalent\CrudBundle
 * @Annotation
 * @Target("PROPERTY")
 */
class Field extends AbstractAnnotation
{
    use ActionTrait;

    /**
     * Entity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->extractActions("actions", $data);
    }
}
