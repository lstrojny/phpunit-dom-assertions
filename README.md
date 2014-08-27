# PHPUnit DOM Assertions

A work in progress, drop-in replacement for the following deprecated PHPUnit assertions:

 * `assertSelectCount()`
 * `assertSelectRegExp()`
 * `assertSelectEquals()`
 * `assertTag()` (not yet ported)
 * `assertNotTag()` (not yet ported)

# TODO

 * Port `assertTag()` and `assertNotTag()`.
 * Improve tests.
 * Improve error messages.
 * Improve comments and documentation.
 * Add XPath support.

## Requirements

The PHPUnit DOM assertions require PHP 5.3.3 or later.

## Installation

The recommended way to install the PHPUnit DOM assertions is
[through composer](http://getcomposer.org). Just create a `composer.json` file
and run the `php composer.phar install` command to install it:

~~~json
{
    "require-dev": {
        "phpunit/phpunit-dom-assertions": "1.0.*@dev"
    }
}
~~~

## Usage

Extend `PHPUnit_Framework_DOMTestCase` to use the DOM assertions:

~~~php
class DOMTest extends PHPUnit_Framework_DOMTestCase
{
    public function testSelectEquals()
    {
        $html = file_get_contents('test.html');
        $selector = 'span.test_class';
        $content  = 'Test Class Text';

        $this->assertSelectEquals($selector, $content, true, $html);
    }
}
~~~

## Tests

[![Build Status](https://travis-ci.org/phpunit/phpunit-dom-assertions.png?branch=master)](https://travis-ci.org/phpunit/phpunit-dom-assertions)

To run the test suite, you need [composer](http://getcomposer.org).

    $ php composer.phar install
    $ vendor/bin/phpunit

## License

The PHPUnit DOM assertions library is licensed under the [BSD 3-Clause license](LICENSE).
