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


use function foo\func;
use PHPUnit\Framework\TestCase;
use RoadBunch\Csv\Exception\FormatterResultException;
use RoadBunch\Csv\Formatter\Formatter;

/**
 * Class FormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatters
 */
class FormatterTest extends TestCase
{
    public function testArrayOfNonStrings()
    {
        $this->expectException(\InvalidArgumentException::class);

        $formatter = new Formatter(function ($var) {
            return strtoupper($var);
        });

        $multiArray = [
            ['an array'],
            new \stdClass(),
            $this
        ];
        $formatter->format($multiArray);
    }

    public function testFormatArrayStrings()
    {
        $formatter = new Formatter(function ($var) {
            return strtoupper($var);
        });

        $testArray = ['one', 'two', 'three'];
        $this->assertEquals(['ONE', 'TWO', 'THREE'], $formatter->format($testArray));
    }

    public function testFormatterReturnsNonArray()
    {
        $this->expectException(FormatterResultException::class);
        $formatter = new Formatter(function ($var) {
            return explode('_', $var);
        });

        $testArray = ['first_name'];
        $formatter->format($testArray);
    }
}
