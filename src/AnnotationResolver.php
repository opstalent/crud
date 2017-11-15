<?php

namespace Opstalent\CrudBundle;

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
    /**
     * @var AnnotationReader
     */
    protected static $reader;

    /**
     * @param string $action
     * @param string $className
     * @return array
     */
    public static function resolve(string $action, string $className): array
    {
        $reflection = static::getReflectionClass($className);
        if (!static::isEntity($reflection, $action)) {
            throw new AnnotationNotDefinedException();
        }
        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            $field = static::getReader()->getPropertyAnnotation($property, Field::class);
            if (!$field || !$field->isValidAction($action)) {
                continue;
            }

            $column = static::getColumnAnnotation($property);
            $properties[$property->getName()] = $column->type;
        }

        return $properties;
    }

    /**
     * @return AnnotationReader
     */
    protected static function getReader()
    {
        if (!static::$reader) {
            static::$reader = new AnnotationReader();
        }

        return static::$reader;
    }

    /**
     * @param string $className
     * @return ReflectionClass move to class
     */
    protected static function getReflectionClass(string $className): ReflectionClass
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException();
        }

        $reflection = new ReflectionClass($className);

        return $reflection;
    }

    /**
     * @param ReflectionProperty $property
     * @return null|object move to class
     */
    protected static function getColumnAnnotation(ReflectionProperty $property)
    {
        /* @var Column */
        $column = static::getReader()->getPropertyAnnotation($property, Column::class);
        if (!$column) {
            throw new AnnotationNotDefinedException("Column Annotation not defined.");
        }

        return $column;
    }

    /**
     * @param ReflectionClass $reflection
     * @param string $action
     * @return bool
     */
    protected static function isEntity(ReflectionClass $reflection, string $action): bool
    {
        $entityAnnotation = static::getReader()->getClassAnnotation($reflection, Entity::class);

        return $entityAnnotation && $entityAnnotation->isValidAction($action);
    }
}
