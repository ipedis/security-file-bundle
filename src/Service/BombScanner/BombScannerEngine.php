<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\Service\BombScanner;

use Ipedis\SecurityFileBundle\Exception\InvalidEngineTypeException;
use Selective\ArchiveBomb\Engine\EngineInterface;
use Selective\ArchiveBomb\Engine\PngBompEngine;
use Selective\ArchiveBomb\Engine\RarBombEngine;
use Selective\ArchiveBomb\Engine\ZipBombEngine;

enum BombScannerEngine: string
{
    case ZIP = 'zip';
    case RAR = 'rar';
    case PNG = 'png';

    /**
     * @throws InvalidEngineTypeException
     */
    public static function fromString(string $type): self
    {
        return match ($type) {
            self::ZIP->value => self::ZIP,
            self::RAR->value => self::RAR,
            self::PNG->value => self::PNG,
            default => throw new InvalidEngineTypeException($type),
        };
    }

    public function buildEngine(): EngineInterface
    {
        return match ($this) {
            self::ZIP => new ZipBombEngine,
            self::RAR => new RarBombEngine,
            self::PNG => new PngBompEngine,
        };
    }
}
