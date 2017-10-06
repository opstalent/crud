<?php
/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Tests\Annotation;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Tests\Resources\Entity\CategoryEntityMock;
use Opstalent\CrudBundle\Tests\Resources\Entity\CategoryExceptionEntityMock;
use PHPUnit\Framework\TestCase;

/**
 * Class EntityTest
 * @package Opstalent\CrudBundle
 */
class EntityTest extends TestCase
{
    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     */
    public function entityAnnotationHaveAnnotationAnnotation()
    {
        $entityAnnotation = new \ReflectionClass(Entity::class);
        $this->assertContains("@Annotation", $entityAnnotation->getDocComment());
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     */
    public function entityAnnotationHaveTargetAnnotation()
    {
        $entityAnnotation = new \ReflectionClass(Entity::class);
        $this->assertContains("@Target(\"CLASS\")", $entityAnnotation->getDocComment());
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     **/
    public function actionIsHandledProperly()
    {
        $reader = new AnnotationReader();
        $metadata = $reader->getClassAnnotation(
            new \ReflectionClass(CategoryEntityMock::class),
            "Opstalent\\CrudBundle\\Annotation\\Entity"
        );
        $this->assertNotNull($metadata);
        $this->assertNotNull($metadata->actions);
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     **/
    public function actionAddableIsHandledProperly()
    {
        $reader = new AnnotationReader();
        $metadata = $reader->getClassAnnotation(
            new \ReflectionClass(CategoryEntityMock::class),
            "Opstalent\\CrudBundle\\Annotation\\Entity"
        );
        $this->assertContains('addable', $metadata->actions);
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     **/
    public function actionDeletableIsHandledProperly()
    {
        $reader = new AnnotationReader();
        $metadata = $reader->getClassAnnotation(
            new \ReflectionClass(CategoryEntityMock::class),
            "Opstalent\\CrudBundle\\Annotation\\Entity"
        );
        $this->assertContains('deletable', $metadata->actions);
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     */
    public function actionWrongInEntityThrowAnnotationException()
    {
        $reader = new AnnotationReader();
        $this->expectException(AnnotationException::class);

        $reader->getClassAnnotation(
            new \ReflectionClass(CategoryExceptionEntityMock::class),
            "Opstalent\\CrudBundle\\Annotation\\Entity"
        );
    }
}
