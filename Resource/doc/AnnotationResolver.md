AnnotationResolver
==================

Provide array of field properties that have a annotation [`Field`](../../src/Annotation/Field.php) passed action and annotation [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html)

``AnnotationResolver`` provide methods:

 - ``public static function resolve(string $action, string $className): array``
 
    Provide array of field properties that have a annotation [`Field`](../../src/Annotation/Field.php) passed action and annotation [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html).
    This function uses getReflectionClass and getColumnAnnotation to read all needed annotations from class.
    
 - ``protected static function getReader()y``
 
    Provides static access to [`AnnotationReader`](http://www.doctrine-project.org/api/common/2.3/class-Doctrine.Common.Annotations.AnnotationReader.html).
    
 - ``protected static function getReflectionClass(string $className): ReflectionClass``
 
    This function check if $className exist and have proper [`Entity`](../../src/Annotation/Entity.php) Annotation. Then return ReflectionClass

 - ``protected static function getColumnAnnotation(ReflectionProperty $property)``

    This function check if passed ReflectionProperty have Doctrine [`Column`](http://www.doctrine-project.org/api/orm/2.3/class-Doctrine.ORM.Mapping.Column.html) annotation. then return this annotation.

 - ``protected static function isEntity(ReflectionClass $reflection, string $action): bool``
    This function check if ReflectionClass have Entity Annotation and passed action.
