<?php

declare(strict_types=1);
/*
 * This file is part of PHPUnit DOM Assertions.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\DOMAssert;
use PHPUnit\Framework\TestCase;

/**
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeff Welch <whatthejeff@gmail.com>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 *
 * @internal
 */
final class DOMAssertTest extends TestCase
{
    private string $html;

    protected function setUp(): void
    {
        $html = file_get_contents(
            __DIR__.'/_files/SelectorAssertionsFixture.html'
        );

        self::assertNotFalse($html);

        $this->html = $html;
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountPresentTrue(): void
    {
        $selector = 'div#test_id';
        $count = true;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountPresentFalse(): void
    {
        $selector = 'div#non_existent';
        $count = true;

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/'.preg_quote($selector, '/').'/');

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountNotPresentTrue(): void
    {
        $selector = 'div#non_existent';
        $count = false;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectNotPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'div#test_id';
        $count = false;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountChildTrue(): void
    {
        $selector = '#my_ul > li';
        $count = 3;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountChildFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $count = 4;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountAdjacentSiblingTrue(): void
    {
        $selector = 'div + div + div';
        $count = 2;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountAdjacentSiblingFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#test_children + div';
        $count = 1;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountDescendantTrue(): void
    {
        $selector = '#my_ul li';
        $count = 3;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountDescendantFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul li';
        $count = 4;

        DOMAssert::assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['>' => 2];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['>' => 3];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanEqualToTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['>=' => 3];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanEqualToFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['>=' => 4];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountLessThanTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['<' => 4];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountLessThanFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['<' => 3];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountLessThanEqualToTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['<=' => 3];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountLessThanEqualToFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['<=' => 2];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountRangeTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['>' => 2, '<' => 4];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectCount
     */
    public function testAssertSelectCountRangeFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['>' => 1, '<' => 3];

        DOMAssert::assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectEquals
     */
    public function testAssertSelectEqualsContentPresentTrue(): void
    {
        $selector = 'span.test_class';
        $content = 'Test Class Text';

        DOMAssert::assertSelectEquals($selector, $content, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectEquals
     */
    public function testAssertSelectEqualsContentPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'span.test_class';
        $content = 'Test Nonexistent';

        DOMAssert::assertSelectEquals($selector, $content, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectEquals
     */
    public function testAssertSelectEqualsContentNotPresentTrue(): void
    {
        $selector = 'span.test_class';
        $content = 'Test Nonexistent';

        DOMAssert::assertSelectEquals($selector, $content, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectEquals
     */
    public function testAssertSelectEqualsContentNotPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'span.test_class';
        $content = 'Test Class Text';

        DOMAssert::assertSelectEquals($selector, $content, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectEquals
     */
    public function testDOMDocument(): void
    {
        $dom = new \DOMDocument();
        DOMAssert::assertSelectEquals('', null, false, $dom);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectRegExp
     */
    public function testAssertSelectRegExpContentPresentTrue(): void
    {
        $selector = 'span.test_class';
        $regexp = '/Test.*Text/';

        DOMAssert::assertSelectRegExp($selector, $regexp, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectRegExp
     */
    public function testAssertNormalizedWhitespace(): void
    {
        $selector = 'span.test_class';
        $regexp = '/^Test.*Text$/';

        DOMAssert::assertSelectRegExp($selector, $regexp, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertSelectRegExp
     */
    public function testAssertSelectRegExpContentPresentFalse(): void
    {
        $selector = 'span.test_class';
        $regexp = '/Nonexistant/';

        DOMAssert::assertSelectRegExp($selector, $regexp, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertXPathCount
     */
    public function testAssertXPathCountTrue(): void
    {
        $xpath = '//li[@class="my_li"]';

        DOMAssert::assertXPathCount($xpath, 4, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertXPathCount
     */
    public function testAssertXPathCountZero(): void
    {
        $xpath = '//li[@class="nonexistent_element"]';

        DOMAssert::assertXPathCount($xpath, 0, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertXPathEquals
     */
    public function testAssertSelectXPathContentPresentTrue(): void
    {
        $xpath = '//span[@class="test_class"]';
        $content = 'Test Class Text';

        DOMAssert::assertXPathEquals($xpath, $content, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertXPathEquals
     */
    public function testAssertSelectXPathContentPresentFalse(): void
    {
        $xpath = '//span[@class="test_class"]';
        $content = 'nonexistent string';

        DOMAssert::assertXPathEquals($xpath, $content, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertXPathSelectRegExp
     */
    public function testAssertXPathSelectRegExpContentPresentTrue(): void
    {
        $xpath = '//span[@class="test_class"]';
        $regexp = '/Test.*Text/';

        DOMAssert::assertXPathSelectRegExp($xpath, $regexp, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMAssert::assertXPathSelectRegExp
     */
    public function testAssertXPathSelectRegExpContentPresentFalse(): void
    {
        $xpath = '//span[@class="test_class"]';
        $regexp = '/Nonexistant/';

        DOMAssert::assertXPathSelectRegExp($xpath, $regexp, false, $this->html);
    }
}
