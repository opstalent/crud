<?php

namespace Opstalent\CrudBundle\Tests;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\DocParser;
use PHPUnit\Framework\Constraint\Constraint;

/**
 * Class AnnotationConstraint
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class AnnotationConstraint extends Constraint
{
    /**
     * @param mixed $class
     * @return bool
     */
    public function matches($class)
    {
        $reflection = new \ReflectionClass($class);
        $docParser = $this->prepareDocParser();
        $annot = $docParser->parse($reflection->getDocComment(), 'class ' . $reflection->getName());
        foreach ($annot as $annotation) {
            if ($annotation instanceof Annotation\Target) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString()
    {
        return sprintf('is proper %s', Annotation::class);
    }

    /**
     * @return DocParser
     */
    protected function prepareDocParser(): DocParser
    {
        $docParser = new DocParser();
        $docParser->setIgnoreNotImportedAnnotations(true);
        $docParser->setIgnoredAnnotationNames(['Annotation' => false]);
        $docParser->setIgnoredAnnotationNamespaces([Annotation::class => false]);
        $docParser->addNamespace(Annotation::class);
        return $docParser;
    }
}
