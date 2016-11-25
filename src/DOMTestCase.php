<?php
/*
 * This file is part of PHPUnit DOM Assertions.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\DomCrawler\Crawler;

/**
 * @package    PHPUnit_Framework_DOMTestCase
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeff Welch <whatthejeff@gmail.com>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/phpunit/phpunit-dom-assertions
 * @since      Class available since Release 1.0.0
 */
abstract class PHPUnit_Framework_DOMTestCase extends PHPUnit_Framework_TestCase
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
     * @param array                 $selector
     * @param integer|boolean|array $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     */
    public static function assertSelectCount($selector, $count, $actual, $message = '', $isHtml = true)
    {
        self::assertSelectEquals(
            $selector, true, $count, $actual, $message, $isHtml
        );
    }

    /**
     * assertSelectRegExp("#binder .name", "/Mike|Derek/", true, $xml); // any?
     * assertSelectRegExp("#binder .name", "/Mike|Derek/", 3, $xml);    // 3?
     *
     * @param array                 $selector
     * @param string                $pattern
     * @param integer|boolean|array $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
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
     * @param array                 $selector
     * @param string                $content
     * @param integer|boolean|array $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     *
     * @throws PHPUnit_Framework_Exception
     */
    public static function assertSelectEquals($selector, $content, $count, $actual, $message = '', $isHtml = true)
    {
        $crawler = self::createCrawler($actual, $isHtml);

        $crawler = $crawler->filter($selector);

        if (is_string($content)) {
            $crawler = self::filterCrawler($crawler, $content);
        }

        self::assertCrawlerContents($crawler, $count, $message);
    }

    /**
     * Assert the presence, absence, or count of elements in a document matching
     * the XPath $selector, regardless of the contents of those elements.
     *
     * The first argument, $selector, is the XPath selector used to match
     * the elements in the $actual document.
     *
     * The second argument, $count, can be either boolean or numeric.
     * When boolean, it asserts for presence of elements matching the selector
     * (true) or absence of elements (false).
     * When numeric, it asserts the count of elements.
     *
     * assertXPathCount('//*[@id="login"]', true, $html);  // any?
     * assertXPathCount('/html/head/script', 1, $html);     // exactly 1?
     *
     * @param $selector
     * @param $count
     * @param $actual
     * @param string $message
     * @param bool $isHtml
     */
    public static function assertXPathCount($selector, $count, $actual, $message = '', $isHtml = true)
    {
        self::assertXPathEquals(
            $selector, true, $count, $actual, $message, $isHtml
        );
    }

    /**
     * //*[@id="test_children"]/text()
     *
     * assertXPathRegExp("//*[@id="test_children"]/text()", "/Children/", true, $html); // any?
     * assertXPathRegExp("//*[@id="test_children"]/text()", "/Children/", 1, $html);    // 3?
     *
     * @param array                 $selector
     * @param string                $pattern
     * @param integer|boolean|array $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     */
    public static function assertXPathRegExp($selector, $pattern, $count, $actual, $message = '', $isHtml = true)
    {
        self::assertXPathEquals(
            $selector, "regexp:$pattern", $count, $actual, $message, $isHtml
        );
    }

    /**
     *
     * @param array                 $selector
     * @param string                $content
     * @param integer|boolean|array $count
     * @param mixed                 $actual
     * @param string                $message
     * @param boolean               $isHtml
     * @since Method available since Release 1.0.0
     *
     * @throws PHPUnit_Framework_Exception
     */
    public static function assertXPathEquals($selector, $content, $count, $actual, $message = '', $isHtml = true)
    {
        $crawler = self::createCrawler($actual, $isHtml);

        $crawler = $crawler->filterXPath($selector);

        if (is_string($content)) {
            $crawler = self::filterCrawler($crawler, $content);
        }

        self::assertCrawlerContents($crawler, $count, $message);

    }

    /**
     * @param $actual string
     * @param $isHtml boolean
     * @return Crawler
     */
    private static function createCrawler($actual, $isHtml)
    {
        $crawler = new Crawler;

        if ($actual instanceof DOMDocument) {
            $crawler->addDocument($actual);
        } else if ($isHtml) {
            $crawler->addHtmlContent($actual);
        } else {
            $crawler->addXmlContent($actual);
        }

        return $crawler;
    }

    /**
     * @param Crawler $crawler
     * @param $count
     * @param $message
     */
    private static function assertCrawlerContents(Crawler $crawler, $count, $message)
    {
        $found = count($crawler);

        if (is_numeric($count)) {
            self::assertEquals($count, $found, $message);
        }

        else if (is_bool($count)) {
            $found = $found > 0;

            if ($count) {
                self::assertTrue($found, $message);
            } else {
                self::assertFalse($found, $message);
            }
        }

        else if (is_array($count) &&
            (isset($count['>']) || isset($count['<']) ||
                isset($count['>=']) || isset($count['<=']))) {

            if (isset($count['>'])) {
                self::assertTrue($found > $count['>'], $message);
            }

            if (isset($count['>='])) {
                self::assertTrue($found >= $count['>='], $message);
            }

            if (isset($count['<'])) {
                self::assertTrue($found < $count['<'], $message);
            }

            if (isset($count['<='])) {
                self::assertTrue($found <= $count['<='], $message);
            }
        }

        else {
            throw new PHPUnit_Framework_Exception('Invalid count format. ' . $count);
        }
    }

    /**
     * @param Crawler $crawler
     * @param $content
     * @return Crawler
     */
    private static function filterCrawler(Crawler $crawler, $content)
    {
        return $crawler->reduce(function (Crawler $node, $i) use ($content) {
            if ($content === '') {
                return $node->text() === '';
            }

            if (preg_match('/^regexp\s:*\s*(?P<matchName>.*)/i', $content, $matches)) {
                return (bool) preg_match($matches['matchName'], $node->text());
            }

            return strstr($node->text(), $content) !== false;
        });
    }
}
