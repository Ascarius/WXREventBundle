<?php

namespace WXR\EventBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class WXREventExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('wxr_event.translation_domain', $config['translation_domain']);

        $container->setAlias('wxr_event.event.manager', $config['event']['manager']);
        $container->setParameter('wxr_event.event.admin.class', $config['event']['admin']['class']);
        $container->setParameter('wxr_event.event.admin.controller', $config['event']['admin']['controller']);

        $container->setAlias('wxr_event.category.manager', $config['category']['manager']);
        $container->setParameter('wxr_event.category.admin.class', $config['category']['admin']['class']);
        $container->setParameter('wxr_event.category.admin.controller', $config['category']['admin']['controller']);

        $container->setAlias('wxr_event.tag.manager', $config['tag']['manager']);
        $container->setParameter('wxr_event.tag.admin.class', $config['tag']['admin']['class']);
        $container->setParameter('wxr_event.tag.admin.controller', $config['tag']['admin']['controller']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
