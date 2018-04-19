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
use RoadBunch\Csv\Formatter\FormatterInterface;
use RoadBunch\Csv\Formatter\UnderscoreToSpaceFormatter;

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

        $formatter = $this->getMockFormatter();

        $multiArray = [
            ['an array'],
            new \stdClass(),
            $this
        ];
        $formatter::format($multiArray);
    }

    public function testFormatArrayStrings()
    {
        $formatter = $this->getMockFormatter();

        $testArray = ['one', 'two', 'three'];
        $this->assertEquals(['ONE', 'TWO', 'THREE'], $formatter::format($testArray));
    }

    public function testFormatterReturnsNonArray()
    {
        $this->expectException(FormatterResultException::class);

        $formatter = new class extends Formatter
        {
            /**
             * @param array $data
             *
             * @return array
             * @throws FormatterResultException
             */
            public static function format(array $data): array
            {
                $callback = function ($var) {
                    return explode('_', $var);
                };

                return parent::applyFilter($callback, $data);
            }
        };

        $testArray = ['first_name'];
        $formatter::format($testArray);
    }

    /**
     * @return FormatterInterface
     */
    private function getMockFormatter()
    {
        $formatter = new class extends Formatter
        {
            /**
             * @param array $data
             *
             * @return array
             * @throws FormatterResultException
             */
            public static function format(array $data): array
            {
                $callback = function ($var) {
                    return strtoupper($var);
                };
                return parent::applyFilter($callback, $data);
            }
        };
        return $formatter;
    }
}
