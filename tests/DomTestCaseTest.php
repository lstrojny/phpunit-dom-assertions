<?php
/*
 * This file is part of PHPUnit DOM Assertions.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Tests;

use PHPUnit\Framework\DOMTestCase;

/**
 * @package    DOMTestCase
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeff Welch <whatthejeff@gmail.com>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/phpunit/phpunit-dom-assertions
 * @since      Class available since Release 1.0.0
 */
class DOMTestCaseTest extends DOMTestCase
{
    private $html;

    protected function setUp()
    {
        $this->html = file_get_contents(
            __DIR__ . '/_files/SelectorAssertionsFixture.html'
        );
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'html');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagTypeFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'code');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagIdTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagIdFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text_doesnt_exist');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagStringContentTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text',
            'content' => 'My test tag content');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagStringContentFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text',
            'content' => 'My non existent tag content');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagRegexpContentTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text',
            'content' => 'regexp:/test tag/');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagRegexpModifierContentTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text',
            'content' => 'regexp:/TEST TAG/i');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagRegexpContentFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_text',
            'content' => 'regexp:/asdf/');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagCdataContentTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'script',
            'content' => 'alert(\'Hello, world!\');');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagCdataontentFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'script',
            'content' => 'asdf');
        $this->assertTag($matcher, $this->html);
    }



    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesTrueA()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'span',
            'attributes' => array('class' => 'test_class'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesTrueB()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'attributes' => array('id' => 'test_child_id'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagAttributesFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'span',
            'attributes' => array('class' => 'test_missing_class'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpTrueA()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'span',
            'attributes' => array('class' => 'regexp:/.+_class/'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpTrueB()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'attributes' => array('id' => 'regexp:/.+_child_.+/'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpModifierTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'attributes' => array('id' => 'regexp:/.+_CHILD_.+/i'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagAttributesRegexpModifierFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'attributes' => array('id' => 'regexp:/.+_CHILD_.+/'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagAttributesRegexpFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'span',
            'attributes' => array('class' => 'regexp:/.+_missing_.+/'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesMultiPartClassTrueA()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'id'  => 'test_multi_class',
            'attributes' => array('class' => 'multi class'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesMultiPartClassTrueB()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'id'  => 'test_multi_class',
            'attributes' => array('class' => 'multi'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagAttributesMultiPartClassFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'id'  => 'test_multi_class',
            'attributes' => array('class' => 'mul'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagParentTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'head',
            'parent' => array('tag' => 'html'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagParentFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'head',
            'parent' => array('tag' => 'div'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagMultiplePossibleChildren()
    {
        $this->markTestIncomplete();
        $matcher = array(
            'tag' => 'li',
            'parent' => array(
                'tag' => 'ul',
                'id' => 'another_ul'
            )
        );
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'html',
            'child' => array('tag' => 'head'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagChildFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'html',
            'child' => array('tag' => 'div'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAdjacentSiblingTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'img',
            'adjacent-sibling' => array('tag' => 'input'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagAdjacentSiblingFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'img',
            'adjacent-sibling' => array('tag' => 'div'));
        $this->assertTag($matcher, $this->html);
    }


    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAncestorTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'ancestor' => array('tag' => 'html'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagAncestorFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'html',
            'ancestor' => array('tag' => 'div'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagDescendantTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'html',
            'descendant' => array('tag' => 'div'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagDescendantFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'descendant' => array('tag' => 'html'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenCountTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('count' => 3));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagChildrenCountFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('count' => 5));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenLessThanTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('less_than' => 10));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagChildrenLessThanFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('less_than' => 2));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenGreaterThanTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('greater_than' => 2));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagChildrenGreaterThanFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('greater_than' => 10));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenOnlyTrue()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('only' => array('tag' =>'li')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagChildrenOnlyFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul',
            'children' => array('only' => array('tag' =>'div')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdTrueA()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'ul', 'id' => 'my_ul');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdTrueB()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'my_ul', 'tag' => 'ul');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdTrueC()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'input', 'id'  => 'input_test_id');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers            \PHPUnit\Framework\DOMTestCase::assertTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertTagTypeIdFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div', 'id'  => 'my_ul');
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'content'    => 'Test Id Text',
            'attributes' => array('id' => 'test_id',
                'class' => 'my_test_class'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertParentContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('tag'        => 'div',
            'content'    => 'Test Id Text',
            'attributes' => array('id'    => 'test_id',
                'class' => 'my_test_class'),
            'parent'     => array('tag' => 'body'));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertChildContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('tag'        => 'div',
            'content'    => 'Test Id Text',
            'attributes' => array('id'    => 'test_id',
                'class' => 'my_test_class'),
            'child'      => array('tag'        => 'div',
                'attributes' => array('id' => 'test_child_id')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertAdjacentSiblingContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('tag'              => 'div',
            'content'          => 'Test Id Text',
            'attributes'       => array('id'    => 'test_id',
                'class' => 'my_test_class'),
            'adjacent-sibling' => array('tag'        => 'div',
                'attributes' => array('id' => 'test_children')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertChildSubChildren()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_id',
            'child' => array('id' => 'test_child_id',
                'child' => array('id' => 'test_subchild_id')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertAdjacentSiblingSubAdjacentSibling()
    {
        $this->markTestIncomplete();
        $matcher = array('id' => 'test_id',
            'adjacent-sibling' => array('id' => 'test_children',
                'adjacent-sibling' => array('class' => 'test_class')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertAncestorContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('id'         => 'test_subchild_id',
            'content'    => 'My Subchild',
            'attributes' => array('id' => 'test_subchild_id'),
            'ancestor'   => array('tag'        => 'div',
                'attributes' => array('id' => 'test_id')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertDescendantContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('id'         => 'test_id',
            'content'    => 'Test Id Text',
            'attributes' => array('id'  => 'test_id'),
            'descendant' => array('tag'        => 'span',
                'attributes' => array('id' => 'test_subchild_id')));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertChildrenContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('id'         => 'test_children',
            'content'    => 'My Children',
            'attributes' => array('class'  => 'children'),

            'children' => array('less_than'    => '25',
                'greater_than' => '2',
                'only'         => array('tag' => 'div',
                    'attributes' => array('class' => 'my_child'))
            ));
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertNotTag
     */
    public function testAssertNotTagTypeIdFalse()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div', 'id'  => 'my_ul');
        $this->assertNotTag($matcher, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertNotTag
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertNotTagContentAttributes()
    {
        $this->markTestIncomplete();
        $matcher = array('tag' => 'div',
            'content'    => 'Test Id Text',
            'attributes' => array('id' => 'test_id',
                'class' => 'my_test_class'));
        $this->assertNotTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountPresentTrue()
    {
        $selector = 'div#test_id';
        $count    = true;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountPresentFalse()
    {
        $selector = 'div#non_existent';
        $count    = true;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountNotPresentTrue()
    {
        $selector = 'div#non_existent';
        $count    = false;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectNotPresentFalse()
    {
        $selector = 'div#test_id';
        $count    = false;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountChildTrue()
    {
        $selector = '#my_ul > li';
        $count    = 3;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountChildFalse()
    {
        $selector = '#my_ul > li';
        $count    = 4;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountAdjacentSiblingTrue()
    {
        $selector = 'div + div + div';
        $count    = 2;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountAdjacentSiblingFalse()
    {
        $selector = '#test_children + div';
        $count    = 1;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountDescendantTrue()
    {
        $selector = '#my_ul li';
        $count    = 3;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountDescendantFalse()
    {
        $selector = '#my_ul li';
        $count    = 4;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanTrue()
    {
        $selector = '#my_ul > li';
        $range    = array('>' => 2);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountGreaterThanFalse()
    {
        $selector = '#my_ul > li';
        $range    = array('>' => 3);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanEqualToTrue()
    {
        $selector = '#my_ul > li';
        $range    = array('>=' => 3);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountGreaterThanEqualToFalse()
    {
        $selector = '#my_ul > li';
        $range    = array('>=' => 4);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountLessThanTrue()
    {
        $selector = '#my_ul > li';
        $range    = array('<' => 4);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountLessThanFalse()
    {
        $selector = '#my_ul > li';
        $range    = array('<' => 3);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountLessThanEqualToTrue()
    {
        $selector = '#my_ul > li';
        $range    = array('<=' => 3);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountLessThanEqualToFalse()
    {
        $selector = '#my_ul > li';
        $range  = array('<=' => 2);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountRangeTrue()
    {
        $selector = '#my_ul > li';
        $range    = array('>' => 2, '<' => 4);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectCount
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectCountRangeFalse()
    {
        $selector = '#my_ul > li';
        $range    = array('>' => 1, '<' => 3);

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectEquals
     */
    public function testAssertSelectEqualsContentPresentTrue()
    {
        $selector = 'span.test_class';
        $content  = 'Test Class Text';

        $this->assertSelectEquals($selector, $content, true, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectEquals
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectEqualsContentPresentFalse()
    {
        $selector = 'span.test_class';
        $content  = 'Test Nonexistent';

        $this->assertSelectEquals($selector, $content, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectEquals
     */
    public function testAssertSelectEqualsContentNotPresentTrue()
    {
        $selector = 'span.test_class';
        $content  = 'Test Nonexistent';

        $this->assertSelectEquals($selector, $content, false, $this->html);
    }

    /**
     * @covers            PHPUnit\Framework\DOMTestCase::assertSelectEquals
     * @expectedException \PHPUnit\Framework\AssertionFailedError
     */
    public function testAssertSelectEqualsContentNotPresentFalse()
    {
        $selector = 'span.test_class';
        $content  = 'Test Class Text';

        $this->assertSelectEquals($selector, $content, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectRegExp
     */
    public function testAssertSelectRegExpContentPresentTrue()
    {
        $selector = 'span.test_class';
        $regexp   = '/Test.*Text/';

        $this->assertSelectRegExp($selector, $regexp, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectRegExp
     */
    public function testAssertSelectRegExpContentPresentFalse()
    {
        $selector = 'span.test_class';
        $regexp   = '/Nonexistant/';

        $this->assertSelectRegExp($selector, $regexp, false, $this->html);
    }
}
