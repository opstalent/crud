<?php

namespace Opstalent\CrudBundle\Tests;

use Opstalent\CrudBundle\Request\CrudRequestInterface;
use Opstalent\CrudBundle\Request\RequestListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Opstalent\CrudBundle\FormConfigResolver;
use Opstalent\CrudBundle\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Opstalent\CrudBundle\Tests\Entity\EntityWithAnnotation;

/**
 * Class RequestListenerTest
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class RequestListenerTest extends TestCase
{
    /**
     * @param bool $master
     * @param Request $request
     * @return GetResponseEvent
     */
    public function getResponseEventMock(bool $master = false, Request $request)
    {
        $mock = $this
            ->getMockBuilder(GetResponseEvent::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mock->method('isMasterRequest')->willReturn($master);
        $mock->method('getRequest')->willReturn($request);
        return $mock;
    }

    /**
     * @return FormConfigResolver
     */
    public function getFormConfigResolverMock()
    {
        return $this
            ->getMockBuilder(FormConfigResolver::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return FormFactory
     */
    public function getFormFactoryMock()
    {
        return $this
            ->getMockBuilder(FormFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param bool $attributes
     * @return \PHPUnit_Framework_MockObject_MockObject|Request
     */
    public function getRequestMock(bool $attributes = false)
    {
        $crudHandlingInterfaceMock = $this
            ->getMockBuilder(CrudRequestInterface::class)
            ->getMock();
        $crudHandlingInterfaceMock
            ->method('getAction')
            ->willReturn('addable');

        $crudHandlingInterfaceMock
            ->method('getClassName')
            ->willReturn(EntityWithAnnotation::class);

        $requestMock = new Request();

        if ($attributes) {
            $attributesMock = $this
                ->getMockBuilder(ParameterBag::class)
                ->disableOriginalConstructor()
                ->getMock();
            $attributesMock
                ->method('get')
                ->willReturn($crudHandlingInterfaceMock);

            $requestMock->attributes = $attributesMock;
        }

        return $requestMock;
    }

    /**
     * @group RequestListener
     * @test
     */
    public function handlesFormReturnsFormInterface()
    {
        $resolver = $this->getFormConfigResolverMock();
        $resolver
            ->expects($resolveSpy = $this->once())
            ->method('resolve');

        $factory = $this->getFormFactoryMock();
        $factory
            ->expects($createFormSpy = $this->once())
            ->method('createForm');

        $request = $this->getRequestMock(true);

        $listener = new RequestListener($resolver, $factory);
        $result = $listener->handleForm($this->getResponseEventMock(true, $request));
        $this->assertEquals(1, $resolveSpy->getInvocationCount());
        $this->assertEquals(1, $createFormSpy->getInvocationCount());
    }

    /**
     * @group RequestListener
     * @test
     */
    public function getsKernelEventRequestFromSubscribedEvents()
    {
        $events = RequestListener::getSubscribedEvents();
        $this->assertContains(KernelEvents::REQUEST, array_keys($events));
    }

    /**
     * @group RequestListener
     * @test
     */
    public function handlesFormReturnsVoidForChildrenRequest()
    {
        $listener = new RequestListener($this->getFormConfigResolverMock(), $this->getFormFactoryMock());
        $result = $listener->handleForm($this->getResponseEventMock(false, $this->getRequestMock(true)));
        $this->assertNull($result);
    }

    /**
     * @group RequestListener
     * @test
     */
    public function handlesFormReturnsVoidForRequestWithoutCrudInterface()
    {
        $listener = new RequestListener($this->getFormConfigResolverMock(), $this->getFormFactoryMock());
        $result = $listener->handleForm($this->getResponseEventMock(true, $this->getRequestMock(false)));
        $this->assertNull($result);
    }

}
