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

use PHPUnit\Framework\AssertionFailedError;
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
    /**
     * @var string
     */
    private $html;

    /** @before */
    protected function backwardsCompatibleSetUp(): void
    {
        $html = file_get_contents(
            __DIR__ . '/_files/SelectorAssertionsFixture.html'
        );

        self::assertNotFalse($html);

        $this->html = $html;
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = ['tag' => 'html'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = ['tag' => 'code'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagIdTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = ['id' => 'test_text'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagIdFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = ['id' => 'test_text_doesnt_exist'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagStringContentTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_text',
            'content' => 'My test tag content',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagStringContentFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'id' => 'test_text',
            'content' => 'My non existent tag content',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagRegexpContentTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_text',
            'content' => 'regexp:/test tag/',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagRegexpModifierContentTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_text',
            'content' => 'regexp:/TEST TAG/i',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagRegexpContentFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'id' => 'test_text',
            'content' => 'regexp:/asdf/',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagCdataContentTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'script',
            'content' => 'alert(\'Hello, world!\');',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagCdataontentFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'script',
            'content' => 'asdf',
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesTrueA(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'span',
            'attributes' => ['class' => 'test_class'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesTrueB(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'attributes' => ['id' => 'test_child_id'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'span',
            'attributes' => ['class' => 'test_missing_class'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpTrueA(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'span',
            'attributes' => ['class' => 'regexp:/.+_class/'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpTrueB(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'attributes' => ['id' => 'regexp:/.+_child_.+/'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpModifierTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'attributes' => ['id' => 'regexp:/.+_CHILD_.+/i'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpModifierFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'div',
            'attributes' => ['id' => 'regexp:/.+_CHILD_.+/'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesRegexpFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'span',
            'attributes' => ['class' => 'regexp:/.+_missing_.+/'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesMultiPartClassTrueA(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'id' => 'test_multi_class',
            'attributes' => ['class' => 'multi class'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesMultiPartClassTrueB(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'id' => 'test_multi_class',
            'attributes' => ['class' => 'multi'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAttributesMultiPartClassFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'div',
            'id' => 'test_multi_class',
            'attributes' => ['class' => 'mul'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagParentTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'head',
            'parent' => ['tag' => 'html'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagParentFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'head',
            'parent' => ['tag' => 'div'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagMultiplePossibleChildren(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'li',
            'parent' => [
                'tag' => 'ul',
                'id' => 'another_ul',
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'html',
            'child' => ['tag' => 'head'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'html',
            'child' => ['tag' => 'div'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAdjacentSiblingTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'img',
            'adjacent-sibling' => ['tag' => 'input'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAdjacentSiblingFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'img',
            'adjacent-sibling' => ['tag' => 'div'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAncestorTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'ancestor' => ['tag' => 'html'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagAncestorFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'html',
            'ancestor' => ['tag' => 'div'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagDescendantTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'html',
            'descendant' => ['tag' => 'div'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagDescendantFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'div',
            'descendant' => ['tag' => 'html'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenCountTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'ul',
            'children' => ['count' => 3],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenCountFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'ul',
            'children' => ['count' => 5],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenLessThanTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'ul',
            'children' => ['less_than' => 10],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenLessThanFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'ul',
            'children' => ['less_than' => 2],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenGreaterThanTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'ul',
            'children' => ['greater_than' => 2],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenGreaterThanFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'ul',
            'children' => ['greater_than' => 10],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenOnlyTrue(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'ul',
            'children' => ['only' => ['tag' => 'li']],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagChildrenOnlyFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'ul',
            'children' => ['only' => ['tag' => 'div']],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdTrueA(): void
    {
        $this->markTestIncomplete();
        $matcher = ['tag' => 'ul', 'id' => 'my_ul'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdTrueB(): void
    {
        $this->markTestIncomplete();
        $matcher = ['id' => 'my_ul', 'tag' => 'ul'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdTrueC(): void
    {
        $this->markTestIncomplete();
        $matcher = ['tag' => 'input', 'id' => 'input_test_id'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagTypeIdFalse(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = ['tag' => 'div', 'id' => 'my_ul'];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertTagContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'content' => 'Test Id Text',
            'attributes' => [
                'id' => 'test_id',
                'class' => 'my_test_class',
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertParentContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'content' => 'Test Id Text',
            'attributes' => [
                'id' => 'test_id',
                'class' => 'my_test_class',
            ],
            'parent' => ['tag' => 'body'],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertChildContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'content' => 'Test Id Text',
            'attributes' => [
                'id' => 'test_id',
                'class' => 'my_test_class',
            ],
            'child' => [
                'tag' => 'div',
                'attributes' => ['id' => 'test_child_id'],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertAdjacentSiblingContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'tag' => 'div',
            'content' => 'Test Id Text',
            'attributes' => [
                'id' => 'test_id',
                'class' => 'my_test_class',
            ],
            'adjacent-sibling' => [
                'tag' => 'div',
                'attributes' => ['id' => 'test_children'],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertChildSubChildren(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_id',
            'child' => [
                'id' => 'test_child_id',
                'child' => ['id' => 'test_subchild_id'],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertAdjacentSiblingSubAdjacentSibling(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_id',
            'adjacent-sibling' => [
                'id' => 'test_children',
                'adjacent-sibling' => ['class' => 'test_class'],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertAncestorContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_subchild_id',
            'content' => 'My Subchild',
            'attributes' => ['id' => 'test_subchild_id'],
            'ancestor' => [
                'tag' => 'div',
                'attributes' => ['id' => 'test_id'],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertDescendantContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_id',
            'content' => 'Test Id Text',
            'attributes' => ['id' => 'test_id'],
            'descendant' => [
                'tag' => 'span',
                'attributes' => ['id' => 'test_subchild_id'],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertTag
     */
    public function testAssertChildrenContentAttributes(): void
    {
        $this->markTestIncomplete();
        $matcher = [
            'id' => 'test_children',
            'content' => 'My Children',
            'attributes' => ['class' => 'children'],

            'children' => [
                'less_than' => '25',
                'greater_than' => '2',
                'only' => [
                    'tag' => 'div',
                    'attributes' => ['class' => 'my_child'],
                ],
            ],
        ];
        $this->assertTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertNotTag
     */
    public function testAssertNotTagTypeIdFalse(): void
    {
        $this->markTestIncomplete();
        $matcher = ['tag' => 'div', 'id' => 'my_ul'];
        $this->assertNotTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertNotTag
     */
    public function testAssertNotTagContentAttributes(): void
    {
        $this->markTestIncomplete();
        $this->expectException(AssertionFailedError::class);
        $matcher = [
            'tag' => 'div',
            'content' => 'Test Id Text',
            'attributes' => [
                'id' => 'test_id',
                'class' => 'my_test_class',
            ],
        ];
        $this->assertNotTag($matcher, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountPresentTrue(): void
    {
        $selector = 'div#test_id';
        $count = true;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'div#non_existent';
        $count = true;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountNotPresentTrue(): void
    {
        $selector = 'div#non_existent';
        $count = false;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectNotPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'div#test_id';
        $count = false;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountChildTrue(): void
    {
        $selector = '#my_ul > li';
        $count = 3;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountChildFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $count = 4;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountAdjacentSiblingTrue(): void
    {
        $selector = 'div + div + div';
        $count = 2;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountAdjacentSiblingFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#test_children + div';
        $count = 1;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountDescendantTrue(): void
    {
        $selector = '#my_ul li';
        $count = 3;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountDescendantFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul li';
        $count = 4;

        $this->assertSelectCount($selector, $count, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['>' => 2];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['>' => 3];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanEqualToTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['>=' => 3];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountGreaterThanEqualToFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['>=' => 4];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountLessThanTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['<' => 4];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountLessThanFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['<' => 3];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountLessThanEqualToTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['<=' => 3];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountLessThanEqualToFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['<=' => 2];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountRangeTrue(): void
    {
        $selector = '#my_ul > li';
        $range = ['>' => 2, '<' => 4];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectCount
     */
    public function testAssertSelectCountRangeFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = '#my_ul > li';
        $range = ['>' => 1, '<' => 3];

        $this->assertSelectCount($selector, $range, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectEquals
     */
    public function testAssertSelectEqualsContentPresentTrue(): void
    {
        $selector = 'span.test_class';
        $content = 'Test Class Text';

        $this->assertSelectEquals($selector, $content, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectEquals
     */
    public function testAssertSelectEqualsContentPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'span.test_class';
        $content = 'Test Nonexistent';

        $this->assertSelectEquals($selector, $content, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectEquals
     */
    public function testAssertSelectEqualsContentNotPresentTrue(): void
    {
        $selector = 'span.test_class';
        $content = 'Test Nonexistent';

        $this->assertSelectEquals($selector, $content, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectEquals
     */
    public function testAssertSelectEqualsContentNotPresentFalse(): void
    {
        $this->expectException(AssertionFailedError::class);
        $selector = 'span.test_class';
        $content = 'Test Class Text';

        $this->assertSelectEquals($selector, $content, false, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectRegExp
     */
    public function testAssertSelectRegExpContentPresentTrue(): void
    {
        $selector = 'span.test_class';
        $regexp = '/Test.*Text/';

        $this->assertSelectRegExp($selector, $regexp, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectRegExp
     */
    public function testAssertNormalizedWhitespace(): void
    {
        $selector = 'span.test_class';
        $regexp = '/^Test.*Text$/';

        $this->assertSelectRegExp($selector, $regexp, true, $this->html);
    }

    /**
     * @covers \PHPUnit\Framework\DOMTestCase::assertSelectRegExp
     */
    public function testAssertSelectRegExpContentPresentFalse(): void
    {
        $selector = 'span.test_class';
        $regexp = '/Nonexistant/';

        $this->assertSelectRegExp($selector, $regexp, false, $this->html);
    }

    public function testDOMDocument(): void
    {
        $dom = new \DOMDocument();
        $this->assertSelectEquals('', null, false, $dom);
    }
}
