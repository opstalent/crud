<?php

namespace Opstalent\CrudBundle\Traits;

use Opstalent\CrudBundle\Exception\MethodNotAllowedException;

/**
 * Trait MethodResolverTrait
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
trait MethodResolverTrait
{
    public $methods = [
        'addable' => "POST",
        'getable' => "GET",
        'listable' => "GET",
        'editable' => "PUT",
        'deletable' => "DELETE"
    ];

    /**
     * @param string $action
     * @return string
     * @throws MethodNotAllowedException
     */
    public function resolveMethod(string $action): string
    {
        if (array_key_exists($action, $this->methods)) {
            return $this->methods[$action];
        }

        throw new MethodNotAllowedException();
    }
}
