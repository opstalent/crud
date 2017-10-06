<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Tests\Resources\Entity;

use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;

/**
 * Class CategoryEntityMock
 * @package Opstalent\CrudBundle
 * @Entity(actions={"addable", "deletable"})
 */
class CategoryEntityMock
{
    /**
     * @Field(actions={"addable", "editable"})
     */
    protected $id;
}
