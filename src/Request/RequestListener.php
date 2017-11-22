<?php

namespace Opstalent\CrudBundle\Request;

use Opstalent\CrudBundle\FormConfigResolver;
use Opstalent\CrudBundle\FormFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class RequestListener
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class RequestListener implements EventSubscriberInterface
{
    /**
     * @var FormConfigResolver
     */
    protected $resolver;

    /**
     * @var FormFactory
     */
    protected $factory;

    /**
     * RequestListener constructor.
     * @param FormConfigResolver $resolver
     * @param FormFactory $factory
     */
    public function __construct(FormConfigResolver $resolver, FormFactory $factory)
    {
        $this->resolver = $resolver;
        $this->factory = $factory;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['handleForm', -255]
        ];
    }

    /**
     * @param GetResponseEvent $event
     * @return FormInterface|null
     */
    public function handleForm(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();

        $crud = $this->resolveCrudRequest($request);
        if (!$crud) {
            return null;
        }

        $formModel = $this->resolver->resolve($crud->getAction(), $crud->getClassName());
        $form = $this->factory->createForm($formModel);
        $form->handleRequest($request);

        return $form;
    }

    /**
     * @param Request $request
     * @return CrudRequestInterface|null
     * @throws /Exception
     */
    protected function resolveCrudRequest(Request $request): ?CrudRequestInterface
    {
        $crud = $request->attributes->get('crudBundle.handler');
        return $crud;
    }
}
