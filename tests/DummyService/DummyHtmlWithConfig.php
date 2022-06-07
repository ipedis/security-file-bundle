<?php

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class DummyHtmlWithConfig extends AbstractFileService
{

    public function __construct(SanitizerInterface $htmlConfigSanitizer)
    {
        Parent::__construct($htmlConfigSanitizer);
    }

}
