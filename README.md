# Security File Bundle

[![CI](https://github.com/ipedis/security-file-bundle/actions/workflows/ci.yml/badge.svg)](https://github.com/ipedis/security-file-bundle/actions/workflows/ci.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ipedis/security-file-bundle.svg)](https://packagist.org/packages/ipedis/security-file-bundle)
[![PHP Version](https://img.shields.io/packagist/php-v/ipedis/security-file-bundle.svg)](https://packagist.org/packages/ipedis/security-file-bundle)
[![License](https://img.shields.io/packagist/l/ipedis/security-file-bundle.svg)](https://packagist.org/packages/ipedis/security-file-bundle)

Symfony bundle providing file security: HTML/XML sanitization, archive bomb detection, and file validation. Combines [`ipedis/file-sanitizer`](https://github.com/ipedis/file-sanitizer) and [`ipedis/validation-handler`](https://github.com/ipedis/validation-handler) with a configurable bomb scanner.

## Installation

```bash
composer require ipedis/security-file-bundle
```

## Configuration

```yaml
# config/packages/security_file.yaml
security_file:
    sanitizers:
        html_sanitizer:
            type: html
        xml_sanitizer:
            type: xml
        html_strict:
            type: html
            config:
                ignored_step:
                    - Ipedis\FileSanitizer\Pipeline\Steps\PhpTagCleanupStep

    scanner:
        engines:
            - zip
            - rar
            - png
```

## Quick Start

### Sanitize file content

```php
use Ipedis\FileSanitizer\Contract\SanitizerInterface;

class FileProcessor
{
    public function __construct(
        private SanitizerInterface $htmlSanitizer,
    ) {}

    public function clean(string $html): string
    {
        return $this->htmlSanitizer->sanitize($html)->getContent();
    }
}
```

Sanitizers are injected by argument name matching the configuration key in camelCase (`html_sanitizer` → `$htmlSanitizer`).

### Scan for archive bombs

```php
use Ipedis\SecurityFileBundle\Service\BombScanner\BombScannerInterface;

class UploadHandler
{
    public function __construct(
        private BombScannerInterface $bombScanner,
    ) {}

    public function handle(\SplFileObject $file): void
    {
        $result = $this->bombScanner->scanFile($file);

        if ($result->isBomb()) {
            throw new \RuntimeException('Archive bomb detected');
        }
    }
}
```

### Validate files

```php
use Ipedis\SecurityFileBundle\Service\Validator\FileValidatorInterface;
use Ipedis\ValidationHandler\Data\Constraints\FileSize;
use Ipedis\ValidationHandler\Data\Constraints\MimeTypes;

class UploadValidator
{
    public function __construct(
        private FileValidatorInterface $fileValidator,
    ) {}

    public function validate(\SplFileInfo $file): void
    {
        $result = $this->fileValidator->validate($file, [
            new FileSize(5, 'M'),
            new MimeTypes(['application/pdf', 'image/png']),
        ]);

        if ($result->isFailed()) {
            throw new \RuntimeException($result->getErrorMessage());
        }
    }
}
```

## Available Services

| Interface | Description |
|-----------|-------------|
| `SanitizerInterface` | Inject by argument name matching config key |
| `BombScannerInterface` | Archive bomb scanner (zip, rar, png engines) |
| `FileValidatorInterface` | File validation against constraints |

## Dependencies

- [`ipedis/file-sanitizer`](https://github.com/ipedis/file-sanitizer) — HTML/XML sanitization engine
- [`ipedis/validation-handler`](https://github.com/ipedis/validation-handler) — file validation chain

## Compatibility

| PHP | Symfony | Status |
|-----|---------|--------|
| 8.2 | 7.x | ✅ |
| 8.3 | 7.x | ✅ |
| 8.4 | 7.x | ✅ |
| 8.5 | 7.x | ✅ |

## Local Development

Requires [Docker](https://www.docker.com/).

```bash
make up        # Start container
make install   # Install dependencies
make qa        # Run full QA suite (rector + pint + phpstan + tests)
```

Available targets:

| Command | Description |
|---------|-------------|
| `make up` | Start container |
| `make down` | Stop container |
| `make install` | Install Composer dependencies |
| `make update` | Update Composer dependencies |
| `make test` | Run PHPUnit tests |
| `make phpstan` | Run static analysis (level max) |
| `make pint` | Fix code style (PSR-12) |
| `make rector` | Run automated refactoring |
| `make qa` | Run all checks |
| `make shell` | Open container shell |

## Disclaimer

This package is maintained by [Ipedis](https://www.ipedis.com). It is provided as-is under the terms of its license.
