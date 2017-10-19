<?php

namespace Opstalent\CrudBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class OpstalentCrudExtension
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class OpstalentCrudExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $ymlLoader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../Resource/config')
        );
        $ymlLoader->load('services.yml');
    }
}
