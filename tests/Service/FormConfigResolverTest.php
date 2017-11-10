<?php

namespace Opstalent\CrudBundle\Tests\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Opstalent\CrudBundle\Exception\AnnotationNotDefinedException;
use Opstalent\CrudBundle\Exception\ClassNotFoundException;
use Opstalent\CrudBundle\Service\FormConfigResolver;
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
}
