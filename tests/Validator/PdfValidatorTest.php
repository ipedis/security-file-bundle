<?php

namespace Tests\Validator;

use Ipedis\ValidationHandler\Validator\FileSizeValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\DummyService\PdfValidator;
use Tests\Kernel\SecurityFileKernel;

class PdfValidatorTest extends TestCase
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
        $this->assertTrue($this->container->has(PdfValidator::class));
        $pdfValidator = $this->container->get(PdfValidator::class);
        $that = $this;
        $constraintsClosure = function () use ($that) {
            $that->assertInstanceOf(
                FileSizeValidator::class,
                $this->handler
            );
        };
        $constraintsClosure = $constraintsClosure
            ->bindTo($pdfValidator, $pdfValidator::class);

        $constraintsClosure();
    }

}
