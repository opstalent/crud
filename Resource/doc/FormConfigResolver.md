FormConfigResolver
==================

Creates [`Form`](../../src/Model/Form.php) Model based on action and class name. 
This Resolver uses AnnotationResolver to get all fields from class that is annotated 
with [`Field`](../../src/Model/Field.php) annotation and has supported Doctrine 
[`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html) type.

``FormConfigResolver`` provides following methods:

 - ``public function resolve(string $action, string $className): Form``
 
    Creates [`Form`](../../src/Model/Form.php) model with resolved fields.
    
 - ``protected function resolveFields(string $action, string $className): array``
 
    Creates array of fields based on action and class passed. 
    This Function reads every property of class 
    thats have [`Field`](../../src/Annotation/Field.php) annotation with passed action. 
    Next it checks if Doctrine 
    [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html) 
    annotation exist.
    
 - ``protected function buildField(string $name, string $type): FieldModel``
 
    Creates [`Form`](../../src/Model/Form.php) model for specific type.

 - ``protected function resolveType(string $type): string``

    Resolves Doctrine column type string to Symfony 
    [`type`](http://symfony.com/doc/current/reference/forms/types.html) class name.
