<?php

namespace Opstalent\CrudBundle\Tests\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Opstalent\CrudBundle\Exception\AnnotationNotDefinedException;
use Opstalent\CrudBundle\Exception\ClassNotFoundException;
use Opstalent\CrudBundle\Model\Field;
use Opstalent\CrudBundle\Model\Form;
use Opstalent\CrudBundle\Service\FormConfigResolver;
use Opstalent\CrudBundle\Tests\Resource\EntityWithAnnotation;
use Opstalent\CrudBundle\Tests\Resource\EntityWithoutColumn;
use PHPUnit\Framework\TestCase;

/**
 * Class FormConfigResolverTest
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormConfigResolverTest extends TestCase
{
    /**
     * @var FormConfigResolver
     */
    protected $service;

    /**
     * setUp FormConfigResolver
     * @before
     */
    public function setUpFormFactory()
    {
        $reader = $this->getMockBuilder(AnnotationReader::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->service = new FormConfigResolver($reader);
    }

    /**
     * @group FormConfigResolver
     * @test
     */
    public function throwsClassNotExistExceptionWhenPassedClassNotExist()
    {
        $this->expectException(ClassNotFoundException::class);
        $resolved = $this->service->resolve('action', 'NotExistingClass');
    }

    /**
     * @group FormConfigResolver
     * @test
     */
    public function throwsAnnotationNotDefinedExceptionWhenClassDontHaveAnnotationForm()
    {
        $this->expectException(AnnotationNotDefinedException::class);
        $resolved = $this->service->resolve('action', \DateTime::class);
    }

    /**
     * @group FormConfigResolver
     * @test
     */
    public function getsFormModelWhenUseClassAnotatedWithFormAnnotation()
    {
        $resolver = $this->service->resolve('addable', EntityWithAnnotation::class);
        $this->assertInstanceOf(Form::class, $resolver);
    }

    /**
     * @group FormConfigResolver
     * @test
     * @depends getsFormModelWhenUseClassAnotatedWithFormAnnotation
     */
    public function formModelContainsAllFieldsDefinedByFieldAnnotation()
    {
        $resolver = $this->service->resolve('addable', EntityWithAnnotation::class);
        foreach ($resolver->getFields() as $field) {
            $this->assertInstanceOf(Field::class, $field);
        }
    }

    /**
     * @group FormConfigResolver
     * @test
     */
    public function throwsAnnotationNotDefinedExceptionWhenPropertyDontHaveAnnotationColumn()
    {
        $this->expectException(AnnotationNotDefinedException::class);
        $resolver = $this->service->resolve('addable', EntityWithoutColumn::class);
        foreach ($resolver->getFields() as $field) {
            $this->assertInstanceOf(Field::class, $field);
        }
    }

}
