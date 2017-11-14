<?php

namespace Opstalent\CrudBundle\Resolver;

use Opstalent\CrudBundle\Exception\TypeNotAllowedException;
use Opstalent\CrudBundle\Model\Field as FieldModel;
use Opstalent\CrudBundle\Model\Form;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class FormConfigResolver
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormConfigResolver
{
    protected $formTypes = [
        'string' => TextType::class,
        'text' => TextType::class,
        'integer' => NumberType::class,
    ];

    /**
     * @param string $action
     * @param string $className
     * @return Form
     */
    public function resolve(string $action, string $className): Form
    {
        $form = new Form();
        $form->setFields($this->resolveFields($className));
        $form->setAction($action);
        $form->setName($className);

        return $form;
    }

    /**
     * @param string $className
     * @return array
     * split foreach to second class and use map
     */
    protected function resolveFields(string $className): array
    {
        $fields = [];
        foreach (AnnotationResolver::resolve($className) as $key => $type) {
            $fields[] = $this->buildField($key, $type);
        }

        return $fields;
    }

    /**
     * @param string $name
     * @param string $type
     * @return FieldModel
     */
    protected function buildField(string $name, string $type): FieldModel
    {
        $field = new FieldModel();
        $field->setName($name);
        $field->setType($this->resolveType($type));

        return $field;
    }

    /**
     * @param string $type
     * @return string to table
     */
    protected function resolveType(string $type)
    {
        if (array_key_exists($type, $this->formTypes)) {
            return $this->formTypes[$type];
        }

        throw new TypeNotAllowedException("Type Unsupported");
    }
}
