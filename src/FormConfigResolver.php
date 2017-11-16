<?php

namespace Opstalent\CrudBundle;

use Opstalent\CrudBundle\Exception\TypeNotAllowedException;
use Opstalent\CrudBundle\Model\Field as FieldModel;
use Opstalent\CrudBundle\Model\Form;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;

/**
 * Class FormConfigResolver
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormConfigResolver
{
    /**
     * @var array
     */
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
        $form->setFields($this->resolveFields($action, $className));
        $form->setAction($action);
        $form->setName($className);

        return $form;
    }

    /**
     * @param string $action
     * @param string $className
     * @return array
     */
    protected function resolveFields(string $action, string $className): array
    {
        $fields = AnnotationResolver::resolve($action, $className);

        return array_map([$this, 'buildField'], array_keys($fields), $fields);
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
     * @return string
     * @throws TypeNotAllowedException
     */
    protected function resolveType(string $type): string
    {
        if (array_key_exists($type, $this->formTypes)) {
            return $this->formTypes[$type];
        }

        throw new TypeNotAllowedException("Type Unsupported");
    }
}
