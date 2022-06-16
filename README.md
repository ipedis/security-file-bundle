# security-file-bundle

This bundle includes three libraries for the security of files.

- <a href="https://bitbucket.org/ipedis/file-sanitizer/src/master/">file-sanitizer library</a>
- <a href="https://bitbucket.org/ipedis/validation-handler/src/master/">validation-handler library</a>
- <a href="https://github.com/selective-php/archive-bomb-scanner"> bombScanner library </a>

# Installation :

add on your composer.json the repository:
```
"repositories": [
{
"type": "vcs",
"url": "bitbucket.org:ipedis/security-file-bundle.git"
},
{
"type": "vcs",
"url": "bitbucket:ipedis/file-sanitizer.git"
},
{
"type": "vcs",
"url": "bitbucket:ipedis/validation-handler.git"
}
...
```
then

`composer require "ipedis/security-file-bundle"`

# Usage :

### file sanitizer :

Configuration of file sanitizer is on the `security_file.yaml` :

```yaml
# config/packages/security_file.yaml
security_file:
  sanitizers:
    html_sanitizer:
      type: html
      config:
        ignored_step:
        custom_step:
    xml_sanitizer:
      type:  xml
      config:
        ignored_step:
        custom_step:
    ......
```

We can add many configuration .
We use the camelCase of the name 
of the configuration to use it on service

**ex:**
to use html_sanitizer on this configuration above :
```phpt
class DummyHtml
{

    public function __construct(SanitizerInterface $htmlSanitizer)
    {}
    .....
```
<a href="https://bitbucket.org/ipedis/file-sanitizer/src/master/Readme.md">Library documentation</a>

----

### bomb scanner :
 To use Bomb scanner we can use `BombScannerDecorator` service.
 
By default, engine used on this service is zip.
But we can modify it or add more engine with configuration in  `security_file`:

```yaml
# config/packages/security_file.yaml
security_file:
    ......
    scanner:
      engines:
        - zip
        - rar
```

<a href="https://github.com/selective-php/archive-bomb-scanner#readme">Library documentation</a>

---

### validation handler :

Use service `FileValidator`

<a href="https://bitbucket.org/ipedis/validation-handler/src/master/README.md">Library documentation</a>


