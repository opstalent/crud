FormFactoryService
==================

```php
public function __construct(FormFactoryInterface $formFactory)
```

Converts [`Form`](../../src/Model/Form.php) Model (with array of [`Field`](../../src/Model/Field.php) Model) into fully qualified Symfony Form.
``FormFactoryService`` is registered under name ``opstalent.form_factory.service``

``FormFactoryService`` provide methods:

 - ``public function createForm(Form $formModel): FormInterface``
 
    Provides Symfony [`Form`](https://github.com/symfony/form/blob/master/Form.php) from [`Form`](../../src/Model/Form.php) Model. 
    This method use parse & getForm together for user convenience.
    
 - ``protected function parse(Form $formModel): FormFactory``
 
    Use Symfony [`FormBuilder`](https://github.com/symfony/form/blob/master/FormBuilder.php) and [`Form`](../../src/Model/Form.php) Model to create Form with fields inside builder. 
    This function set form method and add all fields to form.
    
 - ``protected function addField(Field $fieldModel): FormFactory``
 
    Use [`FormBuilder`](https://github.com/symfony/form/blob/master/FormBuilder.php) to add fields from [`Field`](../../src/Model/Field.php) Model into [`Form`](https://github.com/symfony/form/blob/master/Form.php). 
    This function return FormFactory (itself) for chain actions.

 - ``public function getForm(): FormInterface``

    This function return current form from FormBuilder used inside FormFactory
