<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2014, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_Framework_DOMTestCase
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeff Welch <whatthejeff@gmail.com>
 * @copyright  2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/phpunit/phpunit-dom-assertions
 * @since      File available since Release 1.0.0
 */

use Symfony\Component\DomCrawler\Crawler;

/**
 *
 *
 * @package    PHPUnit_Framework_DOMTestCase
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeff Welch <whatthejeff@gmail.com>
 * @copyright  2014 Sebastian Bergmann <sebastian@phpunit.de>
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
     */
    public static function assertSelectEquals($selector, $content, $count, $actual, $message = '', $isHtml = true)
    {
        $crawler = new Crawler;

        if ($actual instanceof DOMDocument) {
            $crawler->addDocument($actual);
        } else if ($isHtml) {
            $crawler->addHtmlContent($actual);
        } else {
            $crawler->addXmlContent($actual);
        }

        $crawler = $crawler->filter($selector);

        if (is_string($content)) {
            $crawler = $crawler->reduce(function (Crawler $node, $i) use ($content) {
                if ($content === '') {
                    return $node->text() === '';
                }

                if (preg_match('/^regexp\s*:\s*(.*)/i', $content, $matches)) {
                    return (bool) preg_match($matches[1], $node->text());
                }

                return strstr($node->text(), $content) !== false;
            });
        }

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
            throw new PHPUnit_Framework_Exception('Invalid count format');
        }
    }
}
