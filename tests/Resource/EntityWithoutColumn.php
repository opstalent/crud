<?php

namespace Opstalent\CrudBundle\Tests\Resource;

use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntityWithoutColumn
 * @Entity(actions={"addable", "deletable"})
 */
class EntityWithoutColumn
{
    /**
     * @Field(actions={"addable", "editable"})
     */
    protected $name;
}
