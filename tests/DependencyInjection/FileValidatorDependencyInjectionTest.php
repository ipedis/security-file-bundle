<?php

namespace Tests\DependencyInjection;

use Ipedis\SecurityFileBundle\Service\Validator\FileValidatorInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\Kernel\SecurityFileKernel;

class FileValidatorDependencyInjectionTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $kernel = new SecurityFileKernel(environment: 'test', debug: true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    public function testFileValidatorService(): void
    {
        $this->assertTrue($this->container->has(FileValidatorInterface::class));
    }

}
