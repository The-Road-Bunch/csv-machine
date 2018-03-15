<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Header;


use PHPUnit\Framework\TestCase;
use RoadBunch\Csv\Exception\InvalidHeaderArrayException;
use RoadBunch\Csv\Formatter\UnderscoreToSpaceFormatter;
use RoadBunch\Csv\Formatter\UpperCaseWordsFormatter;
use RoadBunch\Csv\Header\Header;

/**
 * Class HeaderTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests
 */
class HeaderTest extends TestCase
{
    public function testCreateHeader()
    {
        $header = new Header();
        $this->assertNotNull($header);
    }

    public function testGetColumns()
    {
        $header = new Header();
        $this->assertInternalType('array', $header->getColumns());
    }

    public function testAddColumn()
    {
        $header = new Header();
        $header->addColumn('First Name');

        $this->assertCount(1, $header->getColumns());
    }

    public function testAddMultipleColumns()
    {
        $header = new Header();

        $this->assertCount(0, $header->getColumns());

        $header->addColumn('one');
        $this->assertCount(1, $header->getColumns());

        $header->addColumn('two');
        $this->assertCount(2, $header->getColumns());

        $header->addColumn('three');
        $this->assertCount(3, $header->getColumns());
    }

    public function testCreateFromArray()
    {
        $testHeaderArray = $this->getTestHeaderArray();

        $header = new Header($testHeaderArray);
        $this->assertCount(count($testHeaderArray), $header->getColumns());

        $header->addColumn('employee id');
        $this->assertCount(count($testHeaderArray) + 1, $header->getColumns());
    }

    public function testAddFormatters()
    {
        $header = new HeaderSpy(['first_name', 'last_name']);
        $header->addFormatter(new UpperCaseWordsFormatter());
        $this->assertCount(1, $header->getFormatters());
        $header->addFormatter(new UnderscoreToSpaceFormatter());
        $this->assertCount(2, $header->getFormatters());

        $this->assertEquals(['First Name', 'Last Name'], $header->getColumns());
    }

    /**
     * @throws InvalidHeaderArrayException
     */
    public function testArrayOfNonStrings()
    {
        $this->expectException(InvalidHeaderArrayException::class);

        $multiArray = [
            ['an array'],
            new \stdClass(),
            $this
        ];
        new Header($multiArray);
    }

    /**
     * @return array
     */
    private function getTestHeaderArray(): array
    {
        return ['first_name', 'last_name', 'birthday', 'phone_number', 'email_address'];
    }
}
