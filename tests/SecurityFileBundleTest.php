<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Kernel\SecurityFileKernel;

class SecurityFileBundleTest extends TestCase
{

    public function testBootKernel(): void
    {
        $kernel = new SecurityFileKernel(environment: 'test', debug: true);
        $kernel->boot();
        $this->assertArrayHasKey('SecurityFileBundle', $kernel->getBundles());
    }

}
