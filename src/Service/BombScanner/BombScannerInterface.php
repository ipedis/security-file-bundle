<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\Service\BombScanner;

use Selective\ArchiveBomb\Scanner\BombScannerResult;
use SplFileObject;

interface BombScannerInterface
{
    public function scanFile(SplFileObject $file): BombScannerResult;

    public function addEngine(BombScannerEngine $bombScannerEngine): void;
}
