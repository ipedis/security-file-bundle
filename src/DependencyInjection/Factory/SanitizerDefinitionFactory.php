<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\DependencyInjection\Factory;

use Ipedis\FileSanitizer\Configuration\Configuration;
use Ipedis\FileSanitizer\Exception\InvalidSanitizerTypeException;
use Ipedis\FileSanitizer\Sanitizer\Html\HtmlSanitizer;
use Ipedis\FileSanitizer\Sanitizer\Xml\XmlSanitizer;
use Symfony\Component\DependencyInjection\Definition;

class SanitizerDefinitionFactory
{
    private const HTML = 'html';
    private const XML = 'xml';

    public function createDefinition(string $type, array $config): Definition
    {
        $configuration = new Definition(Configuration::class,
            [
                $config['ignored_step'] ?? [],
                $config['custom_step'] ?? [],
            ]
        );

        return match ($type) {
            self::HTML => new Definition(HtmlSanitizer::class, [$configuration]),
            self::XML => new Definition(XmlSanitizer::class, [$configuration]),
            default => throw new InvalidSanitizerTypeException(type: $type),
        };
    }
}
