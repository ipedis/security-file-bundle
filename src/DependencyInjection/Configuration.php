<?php

namespace Ipedis\SecurityFileBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('security_file');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
              ->arrayNode('sanitizers')
                  ->defaultValue([])
                  ->useAttributeAsKey('name')
                  ->arrayPrototype()
                      ->children()
                        ->scalarNode('type')->isRequired()->end()
                        ->arrayNode('config')
                              ->children()
                                ->arrayNode('ignored_step')
                                  ->scalarPrototype()->end()
                                ->end()
                                ->arrayNode('custom_step')
                                  ->scalarPrototype()->end()
                                ->end()
                              ->end()
                        ->end()
                      ->end()
                  ->end()
              ->end()
              ->arrayNode('scanner')
                    ->children()
                      ->arrayNode('engines')
                        ->scalarPrototype()->end()
                      ->end()
                    ->end()
                ->end()
              ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
