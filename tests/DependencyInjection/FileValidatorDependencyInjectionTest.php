<?php

declare(strict_types=1);

namespace Tests\DependencyInjection;

use Ipedis\SecurityFileBundle\Service\Validator\FileValidatorInterface;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function file_validator_service(): void
    {
        $this->assertTrue($this->container->has(FileValidatorInterface::class));
    }
}
