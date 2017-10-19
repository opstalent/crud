<<<<<<< HEAD

namespace Opstalent\CrudBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Column;
use Opstalent\CrudBundle\Annotation\Entity;
use Opstalent\CrudBundle\Annotation\Field;
use Opstalent\CrudBundle\Exception\AnnotationNotDefinedException;
use Opstalent\CrudBundle\Exception\ClassNotFoundException;
use Opstalent\CrudBundle\Model\Field as FieldModel;
use Opstalent\CrudBundle\Model\Form;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class FormConfigResolver
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormConfigResolver
{
    /**
     * @var AnnotationReader
     */
    protected $reader;

    /**
     * FormConfigResolver constructor.
     * @param AnnotationReader $reader
     */
    public function __construct()
    {
        $this->reader = new AnnotationReader();
    }

    /**
     * @param string $action
     * @param string $className
     * @return Form
     */
    public function resolve(string $action, string $className): Form
    {
        $reflection = $this->getReflectionClass($className);

        $form = new Form();
        $form->setAction($action);
        $form->setName($className);
        $form->setFields($this->prepareFields($reflection->getProperties()));

        return $form;
    }

    /**
     * @param string $className
     * @return ReflectionClass
     */
    public function getReflectionClass(string $className): ReflectionClass
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException();
        }

        $reflection = new \ReflectionClass(new $className);

        if (!$this->reader->getClassAnnotation($reflection, Entity::class)) {
            throw new AnnotationNotDefinedException();
        }

        return $reflection;
    }

    /**
     * @param array $properties
     * @return array
     */
    protected function prepareFields(array $properties): array
    {
        $fields = [];
        foreach ($properties as $property) {
            if (!$this->reader->getPropertyAnnotation($property, Field::class)) {
                continue;
            }

            $column = $this->getColumnAnnotation($property);
            $fields[] = $this->prepareField($property->getName(), $column->type);
        }

        return $fields;
    }

    /**
     * @param ReflectionProperty $property
     * @return null|object
     */
    protected function getColumnAnnotation(ReflectionProperty $property)
    {
        /* @var Column */
        $column = $this->reader->getPropertyAnnotation($property, Column::class);
        if (!$column) {
            throw new AnnotationNotDefinedException("Column Annotation not defined.");
        }
        return $column;
    }

    /**
     * @param string $name
     * @param string $type
     * @return FieldModel
     */
    protected function prepareField(string $name, string $type): FieldModel
    {
        $field = new FieldModel();
        $field->setName($name);
        $field->setType($this->resolveType($type));

        return $field;
    }

    /**
     * @param string $type
     * @return string
     */
    protected function resolveType(string $type)
    {
        switch ($type) {
            case 'integer':
                return NumberType::class;
                break;
            case 'text':
            default:
                return TextType::class;
                break;
        }
    }
}
