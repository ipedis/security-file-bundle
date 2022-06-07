<?php

namespace Tests\DependencyInjection;

use Ipedis\SecurityFileBundle\Service\BombScanner\BombScannerDecorator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\Kernel\SecurityFileKernel;

class BombScannerDependencyInjectionTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $kernel = new SecurityFileKernel(environment: 'test', debug: true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    public function testBombScannerDecoratorService(): void
    {
        $this->assertTrue($this->container->has(BombScannerDecorator::class));
    }

}
