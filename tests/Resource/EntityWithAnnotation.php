<?php

namespace Opstalent\CrudBundle\Tests\Resource;

use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntityWithAnnotation
 * @Entity(actions={"addable", "deletable"})
 */
class EntityWithAnnotation
{
    /**
     * @Field(actions={"addable", "editable"})
     * @ORM\Column(type="text")
     */
    protected $name;

    /**
     * @Field(actions={"addable", "editable"})
     * @ORM\Column(type="integer")
     */
    protected $number;
}
