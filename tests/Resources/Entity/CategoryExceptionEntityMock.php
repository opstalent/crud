<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Tests\Resources\Entity;

use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;

/**
 * Class CategoryExceptionEntityMock
 * @package Opstalent\CrudBundle
 * @Entity(actions={"Wrong"})
 */
class CategoryExceptionEntityMock
{
    /**
     * @Field(actions={"deletable"})
     */
    protected $id;
}
