AnnotationResolver
==================

Provide array of field properties that have a annotation 
[`Field`](../../src/Annotation/Field.php) passed action and annotation 
[`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html)

``AnnotationResolver`` provides following methods:

 - ``public static function resolve(string $action, string $className): array``
 
    Provides array of field properties that have a annotation 
    [`Field`](../../src/Annotation/Field.php) passed action and annotation 
    [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html).
    This function uses ``getReflectionClass`` and ``getColumnAnnotation`` 
    methods to read all needed annotations from class.
    
 - ``protected static function getReader(): AnnotationReader``
 
    Provides static access to 
    [`AnnotationReader`](http://www.doctrine-project.org/api/common/2.3/class-Doctrine.Common.Annotations.AnnotationReader.html).
    
 - ``protected static function getReflectionClass(string $className): ReflectionClass``
 
    This function checks if ``$className`` exists and has proper 
    [`Entity`](../../src/Annotation/Entity.php) annotation. 
    Then returns ``ReflectionClass``.

 - ``protected static function resolveType(ReflectionProperty $property):string``

    This function checks if passed ``ReflectionProperty`` have Doctrine 
    [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html) annotation. 
    Then returns this annotation type.

 - ``protected static function isEntity(ReflectionClass $reflection, string $action): bool``
    This function checks if passed ``ReflectionClass`` has 
    [`Entity`](../../src/Annotation/Entity.php) annotation and passes action.
