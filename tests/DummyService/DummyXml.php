<?php

namespace Tests\DummyService;

use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class DummyXml extends AbstractFileService
{
    public function __construct(SanitizerInterface $xmlSanitizer)
    {
        Parent::__construct($xmlSanitizer);
    }

}
