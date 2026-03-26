<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\Service\BombScanner;

use Ipedis\SecurityFileBundle\Exception\InvalidEngineTypeException;
use Selective\ArchiveBomb\Scanner\BombScanner;
use Selective\ArchiveBomb\Scanner\BombScannerResult;
use SplFileObject;

final readonly class BombScannerDecorator implements BombScannerInterface
{
    /**
     * @throws InvalidEngineTypeException
     */
    /**
     * @param array<string> $engines
     */
    public function __construct(private BombScanner $bombScanner, array $engines)
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

    /**
     * @param array<string> $engines
     *
     * @throws InvalidEngineTypeException
     */
    private function buildDefaultEngines(array $engines): void
    {
        if ($engines === []) {
            $this->addEngine(BombScannerEngine::ZIP);

            return;
        }

        foreach ($engines as $engine) {
            $this->addEngine(BombScannerEngine::fromString($engine));
        }
    }
}
