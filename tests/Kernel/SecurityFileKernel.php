<?php

declare(strict_types=1);

namespace Tests\Kernel;

use Ipedis\SecurityFileBundle\SecurityFileBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class SecurityFileKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        yield new SecurityFileBundle();
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/security_file.yaml', 'yaml');
        $loader->load(__DIR__ . '/config/services.yaml', 'yaml');
    }
}
