<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\DependencyInjection\Compiler;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;
use Ipedis\FileSanitizer\Exception\InvalidSanitizerTypeException;
use Ipedis\SecurityFileBundle\DependencyInjection\Factory\SanitizerDefinitionFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SanitizerCompilerPass implements CompilerPassInterface
{
    public function __construct(
        private readonly SanitizerDefinitionFactory $sanitizerDefinitionFactory = new SanitizerDefinitionFactory(),
    ) {
    }

    /**
     * @throws InvalidSanitizerTypeException
     */
    public function process(ContainerBuilder $container): void
    {
        /** @var array<string, array{type: string, config: array<string, mixed>}> $sanitizersConfig */
        $sanitizersConfig = $container->getParameter('sanitizers');

        foreach ($sanitizersConfig as $sanitizerName => $sanitizerConfig) {
            $definition = $this->createDefinition(config: $sanitizerConfig);
            $container->setDefinition($sanitizerName, $definition)->setPublic(false);
            $container->registerAliasForArgument($sanitizerName, SanitizerInterface::class, $sanitizerName);
        }

        $container->getParameterBag()->remove('sanitizers');
    }

    /**
     * @param array{type: string, config: array<string, mixed>} $config
     *
     * @throws InvalidSanitizerTypeException
     */
    private function createDefinition(array $config): Definition
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setRequired(['type', 'config'])
            ->setAllowedTypes('type', 'string')
            ->setAllowedTypes('config', 'array');
        $optionsResolver->resolve($config);

        return $this->sanitizerDefinitionFactory->createDefinition(
            type: $config['type'],
            config: $config['config']
        );
    }
}
