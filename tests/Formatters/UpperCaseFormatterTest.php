<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Formatters;


use PHPUnit\Framework\TestCase;
use RoadBunch\Csv\Formatters\UpperCaseFormatter;

/**
 * Class UpperCaseFormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatters
 */
class UpperCaseFormatterTest extends TestCase
{
    public function testCreateFormatter()
    {
        $formatter = new UpperCaseFormatter();
        $this->assertNotNull($formatter);
    }

    public function testConvertsLowerCaseToUpperCase()
    {
        $testLowerCaseHeader = ['firstname', 'lastname', 'email'];
        $testUpperCaseHeader = ['FIRSTNAME', 'LASTNAME', 'EMAIL'];

        $formatter   = new UpperCaseFormatter();
        $formattedHeader = $formatter->format($testLowerCaseHeader);

        $this->assertEquals($testUpperCaseHeader, $formattedHeader);
    }
}
