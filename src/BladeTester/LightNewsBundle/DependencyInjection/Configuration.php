<?php

namespace BladeTester\LightNewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('blade_tester_light_news');

        $rootNode
            ->children()
                ->scalarNode('driver')->defaultValue('doctrine/orm')->end()
                ->scalarNode('engine')->defaultValue('twig')->end()
            ->end();

        $this->addClassesSection($rootNode);
        $this->addServicesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds `classes` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('news')
                            ->isRequired()
                            ->children()
                                ->scalarNode('form')->defaultValue('BladeTester\\LightNewsBundle\\Form\\Type\\NewsFormType')->end()
                                ->scalarNode('entity')->defaultValue('BladeTester\\LightNewsBundle\\Entity\\News')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }


    /**
     * Adds `services` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addServicesSection(ArrayNodeDefinition $node)
    {
    }
}
