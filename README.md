# PHPUnit DOM Assertions

[![Latest Stable Version](https://img.shields.io/packagist/v/phpunit/phpunit-dom-assertions.svg)](https://packagist.org/packages/phpunit/phpunit-dom-assertions)
[![Downloads](https://img.shields.io/packagist/dt/phpunit/phpunit-dom-assertions.svg)](https://packagist.org/packages/phpunit/phpunit-dom-assertions)
[![Integrate](https://github.com/lstrojny/phpunit-dom-assertions/workflows/CI/badge.svg?branch=master)](https://github.com/lstrojny/phpunit-dom-assertions/actions)

A work in progress, drop-in replacement for the following deprecated PHPUnit assertions:

 * `assertSelectCount()`
 * `assertSelectRegExp()`
 * `assertXPathCount()`
 * `assertXPathEquals()`
 * `assertXPathSelectRegExp()`
 * `assertSelectEquals()`

## Installation

```console
$ composer require --dev phpunit/phpunit-dom-assertions
```

## Usage

Extend `PHPUnit\Framework\DOMTestCase` to use the DOM assertions:

```php
namespace My\Tests;

use PHPUnit\Framework\DOMAssert;
use PHPUnit\Framework\TestCase;

final class DOMTest extends TestCase
{
    public function testSelectEquals(): void
    {
        $html = file_get_contents('test.html');
        $selector = 'span.test_class';
        $content  = 'Test Class Text';

        DOMAssert::assertSelectEquals($selector, $content, true, $html);
    }
}
```

## License

The PHPUnit DOM assertions library is licensed under the [BSD 3-Clause license](LICENSE).
