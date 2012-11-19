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
                        ->scalarNode('class')->defaultValue('WXR\EventBundle\Entity\Event')->end()
                        ->scalarNode('admin')->defaultValue('wxr_event.event.admin.default')->end()
                        ->scalarNode('manager')->defaultValue('wxr_event.event.manager.default')->end()
                    ->end()
                ->end()
                ->arrayNode('category')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('WXR\EventBundle\Entity\Category')->end()
                        ->scalarNode('admin')->defaultValue('wxr_event.category.admin.default')->end()
                        ->scalarNode('manager')->defaultValue('wxr_event.category.manager.default')->end()
                    ->end()
                ->end()
                ->arrayNode('tag')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('WXR\EventBundle\Entity\Tag')->end()
                        ->scalarNode('admin')->defaultValue('wxr_event.tag.admin.default')->end()
                        ->scalarNode('manager')->defaultValue('wxr_event.tag.manager.default')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
