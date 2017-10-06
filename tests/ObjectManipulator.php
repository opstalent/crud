<?php

namespace Opstalent\CrudBundle\Tests;

/**
 * Class ObjectManipulator
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class ObjectManipulator
{
    /**
     * @param $object
     * @param $method
     * @param array $args
     * @return mixed
     */
    public static function callProtectedMethod($object, $method, array $args=array())
    {
        $class = new \ReflectionClass(get_class($object));
        $method = $class->getMethod($method);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }
}
