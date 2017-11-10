<?php

namespace Opstalent\CrudBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Exception\AnnotationNotDefinedException;
use Opstalent\CrudBundle\Exception\ClassNotFoundException;
use Opstalent\CrudBundle\Model\Form;

/**
 * Class FormConfigResolver
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormConfigResolver
{
    /**
     * @var AnnotationReader
     */
    protected $reader;

    /**
     * FormConfigResolver constructor.
     * @param AnnotationReader $reader
     */
    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    public function resolve(string $action, string $className): Form
    {
        if (class_exists($className)) {
            $reflection = new \ReflectionClass($className);
            if( $this->reader->getClassAnnotation($reflection, Entity::class)) {

            }
            throw new AnnotationNotDefinedException();
        }
        throw new ClassNotFoundException();
    }
}
