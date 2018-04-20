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
use RoadBunch\Csv\Formatter\AbstractFormatter;
use RoadBunch\Csv\Formatter\SplitCamelCaseWordsFormatter;

/**
 * Class SplitCamelCaseWordsFormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatter
 */
class SplitCamelCaseWordsFormatterTest extends TestCase
{
    public function testSplitCamelCase()
    {
        $this->assertEquals(
            ['', 'stay_the_same', 'Test String One', 'Test String Two'],
            SplitCamelCaseWordsFormatter::format(['', 'stay_the_same', 'TestStringOne', 'TestStringTwo'])
        );
    }

    public function testSplitCamelCaseWithAcronym()
    {
        dump(SplitCamelCaseWordsFormatter::format(['theCSVMachine', 'SomeNASAStuff', 'DoesT.H.I.S.Work...']));
        $this->assertEquals(
            ['the CSV Machine', 'Some NASA Stuff', 'Does T.H.I.S. Work...'],
            SplitCamelCaseWordsFormatter::format(['theCSVMachine', 'SomeNASAStuff', 'DoesT.H.I.S.Work...'])
        );
    }
}
