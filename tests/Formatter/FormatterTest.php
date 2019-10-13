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
use RoadBunch\Csv\Formatter\Formatter;
use RoadBunch\Csv\Formatter\FormatterInterface;
use RoadBunch\Csv\Formatter\NonStringElementException;

/**
 * Class FormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatters
 */
class FormatterTest extends TestCase
{
    protected const CALLABLE = 'strtolower';

    /** @var FormatterInterface */
    private $formatter;

    public function testElementNotStringThrowsException(): void
    {
        $this->expectException(NonStringElementException::class);
        $this->formatter->format([[]]);
    }

    public function testFormatStringElements(): void
    {
        $testArray = ['ONE', 'TWO', 'THREE'];
        $this->assertEquals(array_map(self::CALLABLE, $testArray), $this->formatter->format($testArray));
    }

    protected function setUp()
    {
        $this->formatter = new Formatter(self::CALLABLE);
    }
}
