<?php

declare(strict_types=1);

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class DummyHtml extends AbstractFileService
{
    public function __construct(SanitizerInterface $htmlSanitizer)
    {
        parent::__construct($htmlSanitizer);
    }
}
