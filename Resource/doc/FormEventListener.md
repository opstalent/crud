FormEventListener
==================

```php
public function __construct(EntityManagerInterface $entityManager)
```

Listen on [`FormEvents::POST_SUBMIT`](https://github.com/symfony/form/blob/master/FormEvents.php) event 
and save data to database via 
[`EntityManagerInterface`](https://github.com/doctrine/doctrine2/blob/master/lib/Doctrine/ORM/EntityManagerInterface.php)

``FormEventListener`` is registered under name ``opstalent.form.event.listener``

``FormEventListener`` provides following methods:

 - ``public static function getSubscribedEvents(): array``
 
    Function needed by 
    [`EventSubscriberInterface`](https://github.com/symfony/symfony/blob/master/src/Symfony/Component/EventDispatcher/EventSubscriberInterface.php) 
    to register class as listener. 
    Provides array of events that [`FormEventListener`](../../src/FormEventListener.php) listen to.
    
 - ``public function saveData(FormEvent $event)``
 
    Checks if [`Form`](https://github.com/symfony/form/blob/master/Form.php) provided by 
    [`FormEvent`](https://github.com/symfony/form/blob/master/FormEvent.php) is valid and save data to database.
