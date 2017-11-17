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
 
    Function needed by EventSubscriberInterface to register class as listener. 
    Provides array of events that FormEventListener listen to.
    
 - ``public function saveData(FormEvent $event)``
 
    Checks if Form provided by FormEvent is valid and save data to database.
