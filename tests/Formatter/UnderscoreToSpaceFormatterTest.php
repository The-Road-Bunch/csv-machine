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
use RoadBunch\Csv\Formatter\FormatterInterface;
use RoadBunch\Csv\Formatter\UnderscoreToSpaceFormatter;

/**
 * Class UnderscoreToSpaceFormatterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Formatters
 */
class UnderscoreToSpaceFormatterTest extends TestCase
{
    /** @var FormatterInterface */
    private $formatter;

    public function testCreateFormatter()
    {
        $this->assertNotNull($this->formatter);
    }

    public function testReplacesUnderscoresWithSpaces()
    {
        $testLowerCaseHeader = ['first___name', 'last_name', 'email address'];
        $testUpperCaseHeader = ['first   name', 'last name', 'email address'];

        $this->assertEquals($testUpperCaseHeader, $this->formatter->format($testLowerCaseHeader));
    }

    protected function setUp()
    {
        $this->formatter = UnderscoreToSpaceFormatter::create();
    }
}
