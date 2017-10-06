<?php
/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Tests\Annotation;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Opstalent\CrudBundle\Annotation\Field;
use Opstalent\CrudBundle\Tests\Resources\Entity\CategoryEntityMock;
use Opstalent\CrudBundle\Tests\Resources\Entity\CategoryExceptionEntityMock;
use PHPUnit\Framework\TestCase;

/**
 * Class FieldTest
 * @package Opstalent\CrudBundle
 */
class FieldTest extends TestCase
{
    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     */
    public function entityAnnotationHaveAnnotationAnnotation()
    {
        $entityAnnotation = new \ReflectionClass(Field::class);
        $this->assertContains("@Annotation", $entityAnnotation->getDocComment());
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     */
    public function entityAnnotationHaveTargetAnnotation()
    {
        $entityAnnotation = new \ReflectionClass(Field::class);
        $this->assertContains("@Target(\"PROPERTY\")", $entityAnnotation->getDocComment());
    }

    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     **/
    public function actionIsHandledProperly()
    {
        $reader = new AnnotationReader();
        $categoryReflection = new \ReflectionClass(CategoryEntityMock::class);
        $fieldProperty = $categoryReflection->getProperty("id");
        $metadata = $reader->getPropertyAnnotation(
            $fieldProperty,
            "Opstalent\\CrudBundle\\Annotation\\Field"
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
        $categoryReflection = new \ReflectionClass(CategoryEntityMock::class);
        $fieldProperty = $categoryReflection->getProperty("id");
        $metadata = $reader->getPropertyAnnotation(
            $fieldProperty,
            "Opstalent\\CrudBundle\\Annotation\\Field"
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
        $categoryReflection = new \ReflectionClass(CategoryEntityMock::class);
        $fieldProperty = $categoryReflection->getProperty("id");
        $metadata = $reader->getPropertyAnnotation(
            $fieldProperty,
            "Opstalent\\CrudBundle\\Annotation\\Field"
        );

        $this->assertNotContains('deletable', $metadata->actions);
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

        $categoryReflection = new \ReflectionClass(CategoryExceptionEntityMock::class);
        $fieldProperty = $categoryReflection->getProperty("id");
        $metadata = $reader->getPropertyAnnotation(
            $fieldProperty,
            "Opstalent\\CrudBundle\\Annotation\\Field"
        );
    }
}
