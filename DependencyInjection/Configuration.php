<?php

namespace DTL\Bundle\TimeDistanceTBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    /**
     * Returns the config tree builder.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('dtl_distance_time')
            ->children()
            ->scalarNode('normalized_distance_unit')
                ->defaultValue('m')
            ->end()
        ;

        return $treeBuilder;
    }
}

