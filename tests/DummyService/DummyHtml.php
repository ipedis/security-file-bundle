<?php

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class DummyHtml extends AbstractFileService
{

    public function __construct(SanitizerInterface $htmlSanitizer)
    {
        Parent::__construct($htmlSanitizer);
    }

}
