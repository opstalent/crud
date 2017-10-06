<?php
/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Tests\Annotation;

use Doctrine\Common\Annotations\AnnotationReader;
use Opstalent\CrudBundle\Tests\Resources\Entity\CategoryEntityMock;
use Opstalent\CrudBundle\Tests\Resources\Entity\CategoryExceptionEntityMock;

/**
 * Class EntityTest
 * @package Opstalent\CrudBundle
 */
class EntityTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @group EntityAnnotation
     * @group Annotation
     * @test
     **/
    public function checkForExistingAction()
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
     * @expectedException
     */
    public function checkForUnExistingAction()
    {
        $reader = new AnnotationReader();
        $metadata = $reader->getClassAnnotation(
            new \ReflectionClass(CategoryExceptionEntityMock::class),
            "Opstalent\\CrudBundle\\Annotation\\Entity"
        );
        $this->assertNull($metadata->actions);
    }
}
