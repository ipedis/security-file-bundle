<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Kernel\SecurityFileKernel;

final class SecurityFileBundleTest extends TestCase
{
    #[Test]
    public function boot_kernel(): void
    {
        $securityFileKernel = new SecurityFileKernel(environment: 'test', debug: true);
        $securityFileKernel->boot();
        $this->assertArrayHasKey('SecurityFileBundle', $securityFileKernel->getBundles());
    }
}
