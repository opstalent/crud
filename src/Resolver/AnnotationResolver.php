<?php

namespace Opstalent\CrudBundle\Resolver;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Column;
use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;
use Opstalent\CrudBundle\Exception\AnnotationNotDefinedException;
use Opstalent\CrudBundle\Exception\ClassNotFoundException;
use ReflectionClass;
use ReflectionProperty;

/**
 * Class AnnotationResolver
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class AnnotationResolver
{
    protected static $reader;

    /**
     * @param string $className
     * @return array
     */
    public static function resolve(string $className): array
    {
        $reflection = self::getReflectionClass($className);
        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            if (self::getReader()->getPropertyAnnotation($property, Field::class)) {
                $column = self::getColumnAnnotation($property);
                $properties[$property->getName()] = $column->type;
            }
        }

        return $properties;
    }

    /**
     * @return AnnotationReader
     */
    protected function getReader()
    {
        if (!self::$reader) {
            self::$reader = new AnnotationReader();
        }

        return self::$reader;
    }

    /**
     * @param string $className
     * @return ReflectionClass move to class
     */
    protected function getReflectionClass(string $className): ReflectionClass
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException();
        }

        $reflection = new ReflectionClass(new $className);

        if (!self::getReader()->getClassAnnotation($reflection, Entity::class)) {
            throw new AnnotationNotDefinedException();
        }

        return $reflection;
    }

    /**
     * @param ReflectionProperty $property
     * @return null|object move to class
     */
    protected function getColumnAnnotation(ReflectionProperty $property)
    {
        /* @var Column */
        $column = self::getReader()->getPropertyAnnotation($property, Column::class);
        if (!$column) {
            throw new AnnotationNotDefinedException("Column Annotation not defined.");
        }

        return $column;
    }
}
