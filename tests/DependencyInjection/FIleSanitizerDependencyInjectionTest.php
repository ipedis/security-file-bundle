<?php

namespace Tests\DependencyInjection;

use Ipedis\FileSanitizer\Pipeline\Steps\PhpTagCleanupStep;
use Ipedis\FileSanitizer\Sanitizer\Html\HtmlSanitizer;
use Ipedis\FileSanitizer\Sanitizer\Xml\XmlSanitizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\DummyService\DummyHtml;
use Tests\DummyService\DummyHtmlWithConfig;
use Tests\DummyService\DummyXml;
use Tests\Kernel\SecurityFileKernel;

class FIleSanitizerDependencyInjectionTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $kernel = new SecurityFileKernel(environment: 'test', debug: true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    public function testDummyHtml(): void
    {
        $dummyHtml = $this->container->get(DummyHtml::class);
        $this->assertInstanceOf(DummyHtml::class, $dummyHtml);
        $this->assertInstanceOf(HtmlSanitizer::class, $dummyHtml->getSanitizerService());
    }

    public function testDummyXml(): void
    {
        $dummyXml = $this->container->get(DummyXml::class);
        $this->assertInstanceOf(DummyXml::class, $dummyXml);
        $this->assertInstanceOf(XmlSanitizer::class, $dummyXml->getSanitizerService());
    }

    public function testDummyHtmlWithConfig(): void
    {
        $dummyHtmlWithConfig = $this->container->get(DummyHtmlWithConfig::class);
        $configuration = $dummyHtmlWithConfig->getConfiguration();
        $this->assertInstanceOf(DummyHtmlWithConfig::class, $dummyHtmlWithConfig);
        $this->assertInstanceOf(HtmlSanitizer::class, $dummyHtmlWithConfig->getSanitizerService());
        $this->assertContains(PhpTagCleanupStep::class, $configuration->ignoredSteps);
    }

}
