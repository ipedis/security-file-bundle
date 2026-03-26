<?php

declare(strict_types=1);

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Configuration\Configuration;
use Ipedis\FileSanitizer\Contract\SanitizerInterface;
use Ipedis\FileSanitizer\Pipeline\PipelineSanitizerAbstract;

abstract class AbstractFileService
{
    public function __construct(protected readonly SanitizerInterface $sanitizer)
    {
    }

    public function sanitize(string $content): string
    {
        return $this->sanitizer->sanitize(content: $content)->getContent();
    }

    public function getSanitizerService(): SanitizerInterface
    {
        return $this->sanitizer;
    }

    public function getConfiguration(): ?Configuration
    {
        if ($this->sanitizer instanceof PipelineSanitizerAbstract) {
            return $this->sanitizer->configuration;
        }

        return null;
    }
}
