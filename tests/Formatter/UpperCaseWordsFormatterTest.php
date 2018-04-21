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
use RoadBunch\Csv\Formatter\UpperCaseWordsFormatter;

/**
 * Class UpperCaseWordsFormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatters
 */
class UpperCaseWordsFormatterTest extends TestCase
{
    public function testCreateFormatter()
    {
        $formatter = new UpperCaseWordsFormatter();
        $this->assertNotNull($formatter);
    }

    public function testConvertsLowerCaseToUpperCase()
    {
        $testLowerCaseHeader = ['first name', 'last_name', 'email-address', 'user.id'];
        $testUpperCaseHeader = ['First Name', 'Last_Name', 'Email-Address', 'User.Id'];

        $this->assertEquals($testUpperCaseHeader, UpperCaseWordsFormatter::format($testLowerCaseHeader));
    }
}
