FormConfigResolver
==================

Create [`Form`](../../src/Model/Form.php) Model based on action and className. 
This Resolver uses AnnotationResolver to get all fields from class that are annotated 
with [`Field`](../../src/Model/Field.php) annotation and have supported Doctrine [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html) type.

``FormConfigResolver`` provide methods:

 - ``public function resolve(string $action, string $className): Form``
 
    Create [`Form`](../../src/Model/Form.php) model with resolved fields.
    
 - ``protected function resolveFields(string $action, string $className): array``
 
    Create Array of fields based on action and class passed. 
    This Function reads (using [`AnnotationResolver`](../../src/Resolver/AnnotationResolver.php)) every property of class 
    thats have [`Field`](../../src/Annotation/Field.php) Annotation with passed action. 
    Next Check if Doctrine [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html) Annotation exist and ads
    
 - ``protected function buildField(string $name, string $type): FieldModel``
 
    Create Form Model for specific type.

 - ``protected function resolveType(string $type): string``

    Resolve Doctrine column type string to Symfony [`type`](http://symfony.com/doc/current/reference/forms/types.html) className.
