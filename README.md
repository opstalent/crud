Crud Bundle
===================

[![Build Status](https://travis-ci.org/auamarto/crud-bundle.svg?branch=master)](https://travis-ci.org/auamarto/crud-bundle)
[![Coverage Status](https://coveralls.io/repos/github/opstalent/crud/badge.svg?branch=master)](https://coveralls.io/github/opstalent/crud?branch=master)

This bundle provides basic CRUD functionality. We provide simple entity annotations to create forms on the fly.

----------


Install
-------------

#### <i class="icon-file"></i> Composer
Install package via composer:

```bash
$ composer require opstalent/crud
```

Enable `OpstalentCrudBundle` in `/app/AppKernel.php`

```php
$bundles = [
    new Opstalent\CrudBundle\OpstalentCrudBundle(),
];
```


----------

Documentation
-------------

####Entity Annotation

Entity annotation provide easy way to define if annotated doctrine entity can is ``addable, getable, listable, editable, deletable``.
In order to use Entity Annotation you need to add
```php
use Opstalent\CrudBundle\Annotation\Entity;

/**
 * Class Category
 * @Entity(actions={"addable", "deletable"}) //Here you define available actions
 */
 class Category
 {
 }
```
All other actions will raise ``Doctrine\Common\Annotations\AnnotationException``.

####Field Annotation

Field annotation provide east way to define if assigned property can be modified on ``addable, getable, listable, editable`` action.

```php
use Opstalent\CrudBundle\Annotation\Field;

 /**
 * Class Category
 */
 class Category
 {
    /**
    * @Field(actions={"addable", "editable"}) //Here you define available actions
    */
    protected $name;
 }
```
All other actions will raise ``Doctrine\Common\Annotations\AnnotationException``.

----------

License
-------------

This bundle is under the MIT license.
