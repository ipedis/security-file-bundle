<?php

declare(strict_types=1);

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class DummyXml extends AbstractFileService
{
    public function __construct(SanitizerInterface $xmlSanitizer)
    {
        parent::__construct($xmlSanitizer);
    }
}
