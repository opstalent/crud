<?php

namespace Opstalent\CrudBundle\Model;

use Opstalent\CrudBundle\Traits\FieldTypeTrait;
use Opstalent\CrudBundle\Exception\TypeNotAllowedException;

/**
 * Class Field
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class Field
{
    use FieldTypeTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Field
     */
    public function setName(string $name): Field
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Field
     * @throws TypeNotAllowedException
     */
    public function setType(string $type): Field
    {
        if ($this->isTypeAvailable($type)) {
            $this->type = $type;
            return $this;
        }
        throw new TypeNotAllowedException();
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return Field
     */
    public function setOptions(array $options): Field
    {
        $this->options = $options;
        return $this;
    }
}
