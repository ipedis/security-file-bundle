<?php

namespace Ipedis\SecurityFileBundle\Service\BombScanner;

use Selective\ArchiveBomb\Scanner\BombScanner;
use Selective\ArchiveBomb\Scanner\BombScannerResult;
use SplFileObject;

final class BombScannerDecorator implements BombScannerInterface
{

    public function __construct(private readonly BombScanner $bombScanner, array $engines)
    {
        $this->buildDefaultEngines($engines);
    }

    public function scanFile(SplFileObject $file): BombScannerResult
    {
        return $this->bombScanner->scanFile($file);
    }

    public function addEngine(BombScannerEngine $bombScannerEngine): void
    {
        $this->bombScanner->addEngine($bombScannerEngine->buildEngine());
    }

    private function buildDefaultEngines(array $engines): void
    {
        if (empty($engines)) {
            $this->addEngine(BombScannerEngine::ZIP);
            return;
        }
        foreach ($engines as $engine) {
            $this->addEngine(BombScannerEngine::fromString($engine));
        }
    }
}
