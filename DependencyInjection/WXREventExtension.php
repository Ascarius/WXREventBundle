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
    	$defaultEventAdmin = 'wxr_event.event.admin.default';
    	$defaultCategoryAdmin = 'wxr_event.category.admin.default';
    	$defaultTagAdmin = 'wxr_event.tag.admin.default';

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('wxr_event.translation_domain', $config['translation_domain']);

        $container->setParameter('wxr_event.event.class', $config['event']['class']);
        $container->setAlias('wxr_event.event.admin',     $config['event']['admin']);
        $container->setAlias('wxr_event.event.manager',   $config['event']['manager']);

        $container->setParameter('wxr_event.category.class', $config['category']['class']);
        $container->setAlias('wxr_event.category.admin',     $config['category']['admin']);
        $container->setAlias('wxr_event.category.manager',   $config['category']['manager']);

        $container->setParameter('wxr_event.tag.class', $config['tag']['class']);
        $container->setAlias('wxr_event.tag.admin',     $config['tag']['admin']);
        $container->setAlias('wxr_event.tag.manager',   $config['tag']['manager']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($config['event']['admin'] == $defaultEventAdmin) {
        	$definition = $container->getDefinition($defaultEventAdmin);
        	$attributes = $definition->getTag('sonata.admin.disabled');
        	$definition->clearTag('sonata.admin.disabled');
        	$definition->addTag('sonata.admin', $attributes[0]);
        } else {
        	$container->removeDefinition($defaultEventAdmin);
        }

        if ($config['category']['admin'] == $defaultCategoryAdmin) {
        	$definition = $container->getDefinition($defaultCategoryAdmin);
        	$attributes = $definition->getTag('sonata.admin.disabled');
        	$definition->clearTag('sonata.admin.disabled');
        	$definition->addTag('sonata.admin', $attributes[0]);
        } else {
        	$container->removeDefinition($defaultCategoryAdmin);
        }

        if ($config['tag']['admin'] == $defaultTagAdmin) {
        	$definition = $container->getDefinition($defaultTagAdmin);
        	$attributes = $definition->getTag('sonata.admin.disabled');
        	$definition->clearTag('sonata.admin.disabled');
        	$definition->addTag('sonata.admin', $attributes[0]);
        } else {
        	$container->removeDefinition($defaultTagAdmin);
        }

    }
}
