<?php

namespace Opstalent\CrudBundle\Tests\Entity;

use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;
use Doctrine\ORM\Mapping\Column;

/**
 * Class EntityWithAnnotation
 * @Entity(actions={"addable", "deletable"})
 */
class EntityWithAnnotation
{
    /**
     * @Field(actions={"addable", "editable"})
     * @Column(type="text")
     */
    protected $name;

    /**
     * @Field(actions={"addable", "editable"})
     * @Column(type="integer")
     */
    protected $number;
}
