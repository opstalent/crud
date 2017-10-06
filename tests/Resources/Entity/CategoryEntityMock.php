<?php

namespace Opstalent\CrudBundle\Tests\Resources\Entity;

use Opstalent\CrudBundle\Annotation\Entity;

/**
 * Class CategoryEntityMock
 * @package Opstalent\CrudBundle
 * @Entity(actions={"addable", "deletable"})
 */
class CategoryEntityMock
{
    protected $id;
}