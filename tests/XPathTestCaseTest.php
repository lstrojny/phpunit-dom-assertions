<?php
/*
 *  @author timrodger
 */
class PHPUnit_Framework_XPathTestCaseTest extends PHPUnit_Framework_DOMTestCase
{
    private $html;

    protected function setUp()
    {
        $this->html = file_get_contents(
            __DIR__ . '/_files/SelectorAssertionsFixture.html'
        );
    }
    
    /**
     * @covers            PHPUnit_Framework_DOMTestCase::assertXPathCount
     */
    public function testAssertXPathCountPresentTrue()
    {
        $selector = '//*[@id="login"]';
        $count    = true;

        $this->assertXPathCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit_Framework_DOMTestCase::assertXPathCount
     * @expectedException PHPUnit_Framework_AssertionFailedError
     * @expectedExceptionMessage Failed asserting that false is true.
     */
    public function testAssertXPathCountPresentFalse()
    {
        $selector = '//*[@id="non_existent"]';
        $count    = true;

        $this->assertXPathCount($selector, $count, $this->html);
    }

    /**
     * @covers PHPUnit_Framework_DOMTestCase::assertXPathCount
     */
    public function testAssertXPathCountNotPresentTrue()
    {
        $selector = '//*[@id="non_existent"]';
        $count    = false;

        $this->assertXPathCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit_Framework_DOMTestCase::assertXPathCount
     * @expectedException PHPUnit_Framework_AssertionFailedError
     * @expectedExceptionMessage Failed asserting that true is false.
     */
    public function testAssertXPathCountNotPresentFalse()
    {
        $selector = '//*[@id="login"]';
        $count    = false;

        $this->assertXPathCount($selector, $count, $this->html);
    }

    /**
     * @covers PHPUnit_Framework_DOMTestCase::assertXPathRegExp
     */
    public function testAssertXPathRegExpContentPresentTrue()
    {
        $selector = '//*[@id="test_children"]/text()';
        $regexp   = '/My Children/';

        $this->assertXPathRegExp($selector, $regexp, true, $this->html);
    }

    /**
     * @covers PHPUnit_Framework_DOMTestCase::assertXPathRegExp
     */
    public function testAssertXPathRegExpContentPresentFalse()
    {
        $selector = '//*[@id="test_children"]/text()';
        $regexp   = '/Your Children/';

        $this->assertXPathRegExp($selector, $regexp, false, $this->html);
    }

    /**
     * @covers PHPUnit_Framework_DOMTestCase::assertXPathRegExp
     * @expectedException PHPUnit_Framework_AssertionFailedError
     * @expectedExceptionMessage Failed asserting that true is false.
     */
    public function testAssertXPathRegExpContentNotPresentTrue()
    {
        $selector = '//*[@id="test_children"]/text()';
        $regexp   = '/My Children/';

        $this->assertXPathRegExp($selector, $regexp, false, $this->html);
    }

    /**
     * @covers PHPUnit_Framework_DOMTestCase::assertXPathRegExp
     * @expectedException PHPUnit_Framework_AssertionFailedError
     * @expectedExceptionMessage Failed asserting that false is true.
     */
    public function testAssertXPathRegExpContentNotPresentFalse()
    {
        $selector = '//*[@id="test_children"]/text()';
        $regexp   = '/Your Children/';

        $this->assertXPathRegExp($selector, $regexp, true, $this->html);
    }
}
