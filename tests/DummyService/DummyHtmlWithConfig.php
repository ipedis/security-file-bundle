<?php

declare(strict_types=1);

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class DummyHtmlWithConfig extends AbstractFileService
{
    public function __construct(SanitizerInterface $htmlConfigSanitizer)
    {
        parent::__construct($htmlConfigSanitizer);
    }
}
