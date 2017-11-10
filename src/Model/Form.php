<?php

namespace Opstalent\CrudBundle\Model;

use Opstalent\CrudBundle\Traits\AvailableActionTrait;
use Opstalent\CrudBundle\Exception\ActionUnavailableException;

/**
 * Class Form
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class Form
{
    use AvailableActionTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $action = '';

    /**
     * @var Field[]
     */
    protected $fields = [];

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Form
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $action
     * @return Form
     */
    public function setAction(string $action): Form
    {
        if ($this->isActionAvailable($action)) {
            $this->action = $action;
            return $this;
        }
        throw new ActionUnavailableException(sprintf(
            'The annotation action "%s" is not available.',
            $action
        ));
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     * @return Form
     */
    public function setFields(array $fields): Form
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param Field $field
     * @return Form
     */
    public function addField(Field $field): Form
    {
        $this->fields[$field->getName()] = $field;
        return $this;
    }

    /**
     * @param string $name
     * @return Form
     */
    public function removeField(string $name): Form
    {
        unset($this->fields[$name]);
        return $this;
    }
}
