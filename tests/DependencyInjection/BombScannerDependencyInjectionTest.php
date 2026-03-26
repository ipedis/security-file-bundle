<?php

declare(strict_types=1);

namespace Tests\DependencyInjection;

use Ipedis\SecurityFileBundle\Service\BombScanner\BombScannerInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\Kernel\SecurityFileKernel;

final class BombScannerDependencyInjectionTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $securityFileKernel = new SecurityFileKernel(environment: 'test', debug: true);
        $securityFileKernel->boot();

        $this->container = $securityFileKernel->getContainer();
    }

    #[Test]
    public function bomb_scanner_decorator_service(): void
    {
        $this->assertTrue($this->container->has(BombScannerInterface::class));
    }
}
