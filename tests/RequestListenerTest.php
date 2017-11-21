<?php

namespace Opstalent\CrudBundle\Tests;

use Opstalent\CrudBundle\CrudHandlingInterface;
use Opstalent\CrudBundle\RequestListener;
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
     * @return \PHPUnit_Framework_MockObject_MockObject
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
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getFormConfigResolverMock()
    {
        return $this
            ->getMockBuilder(FormConfigResolver::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getFormFactoryMock()
    {
        return $this
            ->getMockBuilder(FormFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getRequestMock()
    {
        $requestMock =  $this
            ->getMockBuilder(Request::class)
            ->setConstructorArgs([[], [], [], [], [], [], null])
            ->getMock();

        $requestMock->query = new ParameterBag();
        $requestMock->request = new ParameterBag();
        $requestMock->attributes = new ParameterBag();
        $requestMock->cookies = new ParameterBag();
        $requestMock->files = new ParameterBag();
        $requestMock->server = new ParameterBag();
        $requestMock->headers = new ParameterBag();

        return $requestMock;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getCrudHandlingInterfaceMock()
    {
        $crudHandlingInterfaceMock = $this
            ->getMockBuilder(CrudHandlingInterface::class)
            ->getMock();
        $crudHandlingInterfaceMock
            ->method('getAction')
            ->willReturn('addable');

        $crudHandlingInterfaceMock
            ->method('getClassName')
            ->willReturn(EntityWithAnnotation::class);

        $attributesMock = $this
            ->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();
        $attributesMock
            ->method('get')
            ->willReturn($crudHandlingInterfaceMock);

        $requestMock = $this->getRequestMock();
        $requestMock->attributes = $attributesMock;
        return $requestMock;
    }

    /**
     * @group RequestListener
     * @test
     */
    public function handleFormReturnsFormInterface()
    {
        $listener = new RequestListener($this->getFormConfigResolverMock(), $this->getFormFactoryMock());
        $result = $listener->handleForm($this->getResponseEventMock(true, $this->getCrudHandlingInterfaceMock()));
        $this->assertInstanceOf(FormInterface::class, $result);
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
    public function handleFormReturnsVoidForChildrenRequest()
    {
        $listener = new RequestListener($this->getFormConfigResolverMock(), $this->getFormFactoryMock());
        $result = $listener->handleForm($this->getResponseEventMock(false, $this->getCrudHandlingInterfaceMock()));
        $this->assertNull($result);
    }

    /**
     * @group RequestListener
     * @test
     */
    public function handleFormReturnsVoidForRequestWithoutCrudInterface()
    {
        $listener = new RequestListener($this->getFormConfigResolverMock(), $this->getFormFactoryMock());
        $result = $listener->handleForm($this->getResponseEventMock(true, $this->getRequestMock()));
        $this->assertNull($result);
    }

}
