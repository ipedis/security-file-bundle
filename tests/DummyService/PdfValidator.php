<?php

namespace Tests\DummyService;

use Ipedis\SecurityFileBundle\Service\Validator\ValidatorAbstract;
use Ipedis\ValidationHandler\Data\Constraints\FileSize;
use Ipedis\ValidationHandler\Data\Constraints\Mimes\PdfMimeType;
use Ipedis\ValidationHandler\Data\Constraints\MimeTypes;

class PdfValidator extends ValidatorAbstract
{
    protected function registeredConstraints(): array
    {
        return [
            new FileSize('1', 'M'),
            MimeTypes::with(PdfMimeType::class)
        ];
    }

}
