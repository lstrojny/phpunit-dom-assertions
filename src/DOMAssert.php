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

namespace PHPUnit\Framework;

use Symfony\Component\DomCrawler\Crawler;

/**
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeff Welch <whatthejeff@gmail.com>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */
final class DOMAssert
{
    /**
     * Assert the presence, absence, or count of elements in a document matching
     * the CSS $selector, regardless of the contents of those elements.
     *
     * The first argument, $selector, is the CSS selector used to match
     * the elements in the $actual document.
     *
     * The second argument, $count, can be either boolean or numeric.
     * When boolean, it asserts for presence of elements matching the selector
     * (true) or absence of elements (false).
     * When numeric, it asserts the count of elements.
     *
     * assertSelectCount("#binder", true, $xml);  // any?
     * assertSelectCount(".binder", 3, $xml);     // exactly 3?
     *
     * @param array{"<"?: int, ">"?: int, "<="?: int, ">="?: int}|bool|int $count
     *
     * @throws Exception
     */
    public static function assertSelectCount(
        string $selector,
        array|bool|int $count,
        \DOMDocument|string $actual,
        string $message = '',
        bool $isHtml = true
    ): void {
        self::assertSelectEquals(
            $selector,
            null,
            $count,
            $actual,
            $message,
            $isHtml
        );
    }

    /**
     * assertSelectRegExp("#binder .name", "/Mike|Derek/", true, $xml); // any?
     * assertSelectRegExp("#binder .name", "/Mike|Derek/", 3, $xml);    // 3?
     *
     * @param array{"<"?: int, ">"?: int, "<="?: int, ">="?: int}|bool|int $count
     *
     * @throws Exception
     */
    public static function assertSelectRegExp(
        string $selector,
        string $pattern,
        array|bool|int $count,
        \DOMDocument|string $actual,
        string $message = '',
        bool $isHtml = true
    ): void {
        self::assertSelectEquals(
            $selector,
            "regexp:{$pattern}",
            $count,
            $actual,
            $message,
            $isHtml
        );
    }

    /**
     * @param array{"<"?: int, ">"?: int, "<="?: int, ">="?: int}|bool|int $count
     *
     * @throws Exception
     */
    public static function assertXPathCount(
        string $selector,
        array|bool|int $count,
        \DOMDocument|string $actual,
        string $message = '',
        bool $isHtml = true
    ): void {
        self::assertSelectEquals(
            $selector,
            null,
            $count,
            $actual,
            $message,
            $isHtml,
            true
        );
    }

    /**
     * @param array{"<"?: int, ">"?: int, "<="?: int, ">="?: int}|bool|int $count
     *
     * @throws Exception
     */
    public static function assertXPathEquals(
        string $selector,
        string $content,
        array|bool|int $count,
        \DOMDocument|string $actual,
        string $message = '',
        bool $isHtml = true
    ): void {
        self::assertSelectEquals(
            $selector,
            $content,
            $count,
            $actual,
            $message,
            $isHtml,
            true
        );
    }

    /**
     * @param array{"<"?: int, ">"?: int, "<="?: int, ">="?: int}|bool|int $count
     *
     * @throws Exception
     */
    public static function assertXPathSelectRegExp(
        string $xpath,
        string $pattern,
        array|bool|int $count,
        \DOMDocument|string $actual,
        string $message = '',
        bool $isHtml = true
    ): void {
        self::assertSelectEquals(
            $xpath,
            "regexp:{$pattern}",
            $count,
            $actual,
            $message,
            $isHtml,
            true
        );
    }

    /**
     * assertSelectEquals("#binder .name", "Chuck", true,  $xml);  // any?
     * assertSelectEquals("#binder .name", "Chuck", false, $xml);  // none?
     *
     * @param array{"<"?: int, ">"?: int, "<="?: int, ">="?: int}|bool|int $count
     *
     * @throws Exception
     */
    public static function assertSelectEquals(
        string $selector,
        ?string $content,
        array|bool|int $count,
        \DOMDocument|string $actual,
        string $message = '',
        bool $isHtml = true,
        bool $isXPath = false
    ): void {
        $crawler = new Crawler();

        if ($actual instanceof \DOMDocument) {
            $crawler->addDocument($actual);
        } elseif ($isHtml) {
            $crawler->addHtmlContent($actual);
        } else {
            $crawler->addXmlContent($actual);
        }

        if (true === $isXPath) {
            $crawler = $crawler->filterXPath($selector);
        } else {
            $crawler = $crawler->filter($selector);
        }

        if (\is_string($content)) {
            $crawler = $crawler->reduce(static function (Crawler $node) use ($content) {
                $text = $node->text(null, true);

                if ('' === $content) {
                    return '' === $text;
                }

                if (preg_match('/^regexp\s*:\s*(.*)/i', $content, $matches)) {
                    return (bool) preg_match($matches[1], $text);
                }

                return str_contains($text, $content);
            });
        }

        $found = \count($crawler);

        if (is_numeric($count)) {
            Assert::assertSame($count, $found, $message);
        } elseif (\is_bool($count)) {
            if ($count) {
                Assert::assertGreaterThan(0, $found, $message);
            } else {
                Assert::assertSame(0, $found, $message);
            }
        } elseif (\is_array($count)
            && (isset($count['>']) || isset($count['<'])
                || isset($count['>=']) || isset($count['<=']))) {
            if (isset($count['>'])) {
                Assert::assertGreaterThan($count['>'], $found, $message);
            }

            if (isset($count['>='])) {
                Assert::assertGreaterThanOrEqual($count['>='], $found, $message);
            }

            if (isset($count['<'])) {
                Assert::assertLessThan($count['<'], $found, $message);
            }

            if (isset($count['<='])) {
                Assert::assertLessThanOrEqual($count['<='], $found, $message);
            }
        } else {
            throw new Exception('Invalid count format');
        }
    }
}
