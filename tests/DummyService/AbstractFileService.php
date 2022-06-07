<?php

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Configuration\Configuration;
use Ipedis\FileSanitizer\Contract\SanitizerInterface;

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
        return $this->sanitizer->configuration;
    }

}
