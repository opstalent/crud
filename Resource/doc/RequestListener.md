RequestListener
==================

```php
public function __construct(FormConfigResolver $resolver, FormFactory $factory)
```

Listens on every request. Checks if it master request and has attribute crud of type 
[`CrudHandlingInterface`](../../src/CrudHandlingInterface.php). Then uses [`FormConfigResolver`](FormConfigResolver.md)
and [`FormFactory`](FormFactoryService.md) to creates and handle form.

``RequestListener`` is registered under name ``opstalent.form.request.listener``

``RequestListener`` provides following methods:

 - ``public static function getSubscribedEvents(): array``
 
    Function needed by 
    [`EventSubscriberInterface`](https://github.com/symfony/symfony/blob/master/src/Symfony/Component/EventDispatcher/EventSubscriberInterface.php) 
    to register class as listener. 
    Provides array of events that [`FormEventListener`](../../src/FormEventListener.php) listen to.
    
 - ``public function handleForm(GetResponseEvent $event)``
 
    This function takes request with provided [`CrudHandlingInterface`](../../src/CrudHandlingInterface.php) 
    in attributes, then creates [`Form`](https://github.com/symfony/form/blob/master/Form.php) 
    and use request data to submit form.
