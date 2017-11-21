<?php

namespace Opstalent\CrudBundle;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;

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
            KernelEvents::REQUEST => [
                ['handleForm', -255],
            ],
        ];
    }

    /**
     * @param GetResponseEvent $event
     * @return FormInterface|void
     */
    public function handleForm(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        /**
         * @var CrudHandlingInterface $crud
         */
        if (!$crud = $this->resolveCrudRequest($request)) {
            return;
        }

        $formModel = $this->resolver->resolve($crud->getAction(), $crud->getClassName());
        $form = $this->factory->createForm($formModel);
        $form->handleRequest($request);

        return $form;
    }

    /**
     * @param Request $request
     * @return mixed|null|CrudHandlingInterface
     */
    protected function resolveCrudRequest(Request $request)
    {
        $crud = $request->attributes->get('crud');
        return $crud instanceof CrudHandlingInterface ? $crud : null;
    }
}
