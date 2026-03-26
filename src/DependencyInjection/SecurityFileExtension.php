<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SecurityFileExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        /** @var array<string, array{type: string, config: array<string, mixed>}> $sanitizers */
        $sanitizers = $config['sanitizers'];
        $container->setParameter('sanitizers', $sanitizers);

        /** @var array{engines?: array<string>} $scanner */
        $scanner = $config['scanner'] ?? [];
        $engines = $scanner['engines'] ?? [];
        $container->setParameter('scanner.engines', $engines);

        $yamlFileLoader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );

        $yamlFileLoader->load('services.yaml');
    }
}
