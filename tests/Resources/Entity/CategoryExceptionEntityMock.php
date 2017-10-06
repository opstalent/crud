<?php

namespace Opstalent\CrudBundle\Tests\Resources\Entity;

use Opstalent\CrudBundle\Annotation\Entity;

/**
 * Class CategoryExceptionEntityMock
 * @package Opstalent\CrudBundle
 * @Entity(actions={"wrong_value"})
 */
class CategoryExceptionEntityMock
{
    protected $id;
}