Crud Bundle
===================

[![Build Status](https://travis-ci.org/opstalent/crud.svg?branch=master)](https://travis-ci.org/opstalent/crud)
[![Coverage Status](https://coveralls.io/repos/github/opstalent/crud/badge.svg?branch=master)](https://coveralls.io/github/opstalent/crud?branch=master)

This bundle provides basic CRUD functionality. We provide simple entity annotations to create forms on the fly.

----------


Install
-------------

#### Composer
Install package via composer:

```bash
$ composer require opstalent/crud
```

Enable `OpstalentCrudBundle` in `/app/AppKernel.php`

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Opstalent\CrudBundle\OpstalentCrudBundle(),
        // ...
    );
}
```


----------

Annotations
-------------

#### Entity

Entity annotation provides easy way to define possible CRUD actions for each entity. 

Allowed actions are:
* `addable` for entities which can be added through `crud` bundle,
* `getable` for entities which can be get through `crud` bundle,
* `listable` for entities which can be listed through `crud` bundle,
* `editable` for entities which can be edited through `crud` bundle,
* `deletable` for entities which can be deleted through `crud` bundle.

All other actions will raise ``Doctrine\Common\Annotations\AnnotationException``.

In order to use Entity Annotation you need to add

```php
use Opstalent\CrudBundle\Annotation\Entity;

/**
 * Class Category
 * @Entity(actions={"addable", "deletable"}) // Define available actions here
 */
 class Category
 {
    // ...
 }
```

#### Field

Field annotation provides easy way to define possible fields for every CRUD actions for entity. 

Allowed actions are:
* `addable` for entities which can be added through `crud` bundle,
* `getable` for entities which can be get through `crud` bundle,
* `listable` for entities which can be listed through `crud` bundle,
* `editable` for entities which can be edited through `crud` bundle,
* `deletable` for entities which can be deleted through `crud` bundle.

All other actions will raise ``Doctrine\Common\Annotations\AnnotationException``.

```php
use Opstalent\CrudBundle\Annotation\Field;

 /**
 * Class Category
 */
 class Category
 {
    /**
    * @Field(actions={"addable", "editable"}) // Define available actions here
    */
    protected $name;
    
    // ...
 }
```
All other actions will raise ``Doctrine\Common\Annotations\AnnotationException``.

----------

API Reference
-------------
[FormFactoryService](Resources/doc/FormFactoryService.md)

[FormConfigResolver](Resources/doc/FormConfigResolver.md)

[AnnotationResolver](Resources/doc/AnnotationResolver.md)

[FormEventListener](Resources/doc/FormEventListener.md)

[RequestListener](Resources/doc/RequestListener.md)

License
-------------

[This bundle is under the MIT license.](LICENSE)
