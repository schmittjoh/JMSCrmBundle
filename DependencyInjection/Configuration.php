<?php

namespace JMS\CrmBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();

        $tb
            ->root('jms_crm', 'array')
                ->children()
                    ->scalarNode('from_email')->isRequired()->cannotBeEmpty()->end()
                    ->arrayNode('receiver_emails')
                        ->requiresAtLeastOneElement()
                        ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $tb;
    }
}