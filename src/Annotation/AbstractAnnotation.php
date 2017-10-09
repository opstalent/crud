<?php

/**
 * @author Szyon Kunowski <szymon.kunowski@gmail.com>
 */

namespace Opstalent\CrudBundle\Annotation;

/**
 * Class AbstractAnnotation
 * @package Opstalent\CrudBundle
 */
abstract class AbstractAnnotation
{
    abstract protected function getAvailableActions(): array;

    abstract protected function addAvailableAction(string $name): int;

    abstract protected function isActionAvailable(string $action): bool;

    abstract protected function extractActions(string $key, array $data): array;

    abstract protected function enableAction(string $action): AbstractAnnotation;
}
