<?php

namespace Ipedis\SecurityFileBundle\DependencyInjection\Compiler;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;
use Ipedis\SecurityFileBundle\DependencyInjection\Factory\SanitizerDefinitionFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SanitizerCompilerPass implements CompilerPassInterface
{

    public function __construct(
        private readonly SanitizerDefinitionFactory $sanitizerDefinitionFactory = new SanitizerDefinitionFactory()
    ) {
    }

    public function process(ContainerBuilder $container)
    {
        $sanitizersConfig = $container->getParameter('sanitizers');

        foreach ($sanitizersConfig as $sanitizerName => $sanitizerConfig) {
            $definition = $this->createDefinition(config: $sanitizerConfig);
            $container->setDefinition($sanitizerName, $definition)->setPublic(false);
            $container->registerAliasForArgument($sanitizerName, SanitizerInterface::class, $sanitizerName);
        }

        $container->getParameterBag()->remove('sanitizers');
    }

    private function createDefinition(array $config): Definition
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(['type', 'config'])
            ->setAllowedTypes('type', 'string')
            ->setAllowedTypes('config', 'array');
        $resolver->resolve($config);

        return $this->sanitizerDefinitionFactory->createDefinition(
            type: $config['type'],
            config: $config['config'] ?? []
        );
    }

}
