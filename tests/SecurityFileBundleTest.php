<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Kernel\SecurityFileKernel;

class SecurityFileBundleTest extends TestCase
{
    #[Test]
    public function boot_kernel(): void
    {
        $kernel = new SecurityFileKernel(environment: 'test', debug: true);
        $kernel->boot();
        $this->assertArrayHasKey('SecurityFileBundle', $kernel->getBundles());
    }
}
