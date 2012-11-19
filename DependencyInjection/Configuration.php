<?php

namespace WXR\EventBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wxr_event');

        $rootNode
            ->children()
                ->scalarNode('translation_domain')->defaultValue('WXREventBundle')->end()
                ->arrayNode('event')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('wxr_event.event.manager.default')->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('WXR\EventBundle\Admin\Entity\EventAdmin')->end()
                                ->scalarNode('controller')->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('category')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('wxr_event.category.manager.default')->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('WXR\EventBundle\Admin\Entity\CategoryAdmin')->end()
                                ->scalarNode('controller')->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('tag')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('wxr_event.tag.manager.default')->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('WXR\EventBundle\Admin\Entity\TagAdmin')->end()
                                ->scalarNode('controller')->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
