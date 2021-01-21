<?php
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
 * @link       http://github.com/phpunit/phpunit-dom-assertions
 * @since      Class available since Release 1.0.0
 */
abstract class DOMTestCase extends TestCase
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
     * @param string                $selector
     * @param integer|boolean|array{"<"?: int, ">"?: int, "<="?: int, ">="?: int} $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     *
     * @return void
     */
    public static function assertSelectCount($selector, $count, $actual, $message = '', $isHtml = true)
    {
        self::assertSelectEquals(
            $selector, null, $count, $actual, $message, $isHtml
        );
    }

    /**
     * assertSelectRegExp("#binder .name", "/Mike|Derek/", true, $xml); // any?
     * assertSelectRegExp("#binder .name", "/Mike|Derek/", 3, $xml);    // 3?
     *
     * @param string                $selector
     * @param string                $pattern
     * @param integer|boolean|array{"<"?: int, ">"?: int, "<="?: int, ">="?: int} $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     *
     * @return void
     */
    public static function assertSelectRegExp($selector, $pattern, $count, $actual, $message = '', $isHtml = true)
    {
        self::assertSelectEquals(
            $selector, "regexp:$pattern", $count, $actual, $message, $isHtml
        );
    }

    /**
     * assertSelectEquals("#binder .name", "Chuck", true,  $xml);  // any?
     * assertSelectEquals("#binder .name", "Chuck", false, $xml);  // none?
     *
     * @param string                $selector
     * @param string|null           $content
     * @param integer|boolean|array{"<"?: int, ">"?: int, "<="?: int, ">="?: int} $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     *
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public static function assertSelectEquals($selector, $content, $count, $actual, $message = '', $isHtml = true)
    {
        $crawler = new Crawler;

        if ($actual instanceof \DOMDocument) {
            $crawler->addDocument($actual);
        } else if ($isHtml) {
            $crawler->addHtmlContent($actual);
        } else {
            $crawler->addXmlContent($actual);
        }

        $crawler = $crawler->filter($selector);

        if (is_string($content)) {
            $crawler = $crawler->reduce(static function (Crawler $node) use ($content) {
                $text = $node->text(null, true);

                if ($content === '') {
                    return $text === '';
                }

                if (preg_match('/^regexp\s*:\s*(.*)/i', $content, $matches)) {
                    return (bool)preg_match($matches[1], $text);
                }

                return strstr($text, $content) !== false;
            });
        }

        $found = count($crawler);

        if (is_numeric($count)) {
            self::assertEquals($count, $found, $message);
        } else if (is_bool($count)) {
            if ($count) {
                self::assertGreaterThan(0, $found, $message);
            } else {
                self::assertEquals(0, $found, $message);
            }
        } else if (is_array($count) &&
            (isset($count['>']) || isset($count['<']) ||
                isset($count['>=']) || isset($count['<=']))) {

            if (isset($count['>'])) {
                self::assertGreaterThan($count['>'], $found, $message);
            }

            if (isset($count['>='])) {
                self::assertGreaterThanOrEqual($count['>='], $found, $message);
            }

            if (isset($count['<'])) {
                self::assertLessThan($count['<'], $found, $message);
            }

            if (isset($count['<='])) {
                self::assertLessThanOrEqual($count['<='], $found, $message);
            }
        } else {
            throw new \PHPUnit\Framework\Exception('Invalid count format');
        }
    }
}
