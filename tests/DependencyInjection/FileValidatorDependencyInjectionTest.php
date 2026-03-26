<?php

declare(strict_types=1);

namespace Tests\DependencyInjection;

use Ipedis\SecurityFileBundle\Service\Validator\FileValidatorInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\Kernel\SecurityFileKernel;

final class FileValidatorDependencyInjectionTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $securityFileKernel = new SecurityFileKernel(environment: 'test', debug: true);
        $securityFileKernel->boot();

        $this->container = $securityFileKernel->getContainer();
    }

    #[Test]
    public function file_validator_service(): void
    {
        $this->assertTrue($this->container->has(FileValidatorInterface::class));
    }
}
