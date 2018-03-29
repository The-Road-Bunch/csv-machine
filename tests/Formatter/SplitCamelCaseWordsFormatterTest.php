<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Formatter;


use PHPUnit\Framework\TestCase;
use RoadBunch\Csv\Formatter\SplitCamelCaseWordsFormatter;

/**
 * Class SplitCamelCaseWordsFormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatter
 */
class SplitCamelCaseWordsFormatterTest extends TestCase
{
    public function testCreateFormatter()
    {
        $ccWordFormatter = new SplitCamelCaseWordsFormatter();
        $this->assertNotNull($ccWordFormatter);
    }

    public function testSplitCamelCase()
    {
        $ccHeader = ['TestString', 'TheseShouldSeparate', 'AndCSVShouldWork', 'andThisShouldWork'];
        $expected = ['Test String', 'These Should Separate', 'And CSV Should Work', 'and This Should Work'];

        $formatter = new SplitCamelCaseWordsFormatter();
        $formattedHeader = $formatter->format($ccHeader);

        $this->assertEquals($expected, $formattedHeader);
    }
}
