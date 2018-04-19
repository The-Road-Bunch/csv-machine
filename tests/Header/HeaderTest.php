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
use RoadBunch\Csv\Exception\FormatterException;
use RoadBunch\Csv\Exception\InvalidInputArrayException;
use RoadBunch\Csv\Formatter\Formatter;
use RoadBunch\Csv\Formatter\SplitCamelCaseWordsFormatter;
use RoadBunch\Csv\Formatter\UnderscoreToSpaceFormatter;
use RoadBunch\Csv\Formatter\UpperCaseWordsFormatter;
use RoadBunch\Csv\Header\Header;
use RoadBunch\Csv\Header\HeaderInterface;

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
        $this->assertInternalType('array', $header->getFormattedColumns());
    }

    public function testAddColumn()
    {
        $header = new Header();
        $header->addColumn('First Name');

        $this->assertCount(1, $header->getFormattedColumns());
    }

    public function testAddMultipleColumns()
    {
        $header = new Header();

        $this->assertCount(0, $header->getFormattedColumns());

        $header->addColumn('one');
        $this->assertCount(1, $header->getFormattedColumns());

        $header->addColumn('two');
        $this->assertCount(2, $header->getFormattedColumns());

        $header->addColumn('three');
        $this->assertCount(3, $header->getFormattedColumns());
    }

    public function testCreateFromArray()
    {
        $testHeaderArray = $this->getTestHeaderArray();

        $header = new Header($testHeaderArray);
        $this->assertCount(count($testHeaderArray), $header->getFormattedColumns());

        $header->addColumn('employee id');
        $this->assertCount(count($testHeaderArray) + 1, $header->getFormattedColumns());
    }

    public function testAddFormatters()
    {
        $header = new HeaderSpy(['first_name', 'last_name', 'camelCased']);
        $header->addFormatter(UnderscoreToSpaceFormatter::class);
        $this->assertCount(1, $header->getFormatters());
        $header->addFormatter(UpperCaseWordsFormatter::class);
        $this->assertCount(2, $header->getFormatters());
        $header->addFormatter(SplitCamelCaseWordsFormatter::class);
        $this->assertCount(3, $header->getFormatters());

        $formattedHeader = $header->getFormattedColumns();
        $this->assertEquals(['First Name', 'Last Name', 'Camel Cased'], $formattedHeader);
    }

    public function testAddInvalidFormatterString()
    {
        $this->expectException(FormatterException::class);

        $testHeaderArray = $this->getTestHeaderArray();
        $header = new Header($testHeaderArray);

        $header->addFormatter('fakeformatter');
    }

    public function testAddInvalidFormatterObject()
    {
        $this->expectException(FormatterException::class);

        $testHeaderArray = $this->getTestHeaderArray();
        $header = new Header($testHeaderArray);

        $header->addFormatter(new Header([]));
    }

    /**
     * @throws InvalidInputArrayException
     */
    public function testArrayOfNonStrings()
    {
        $this->expectException(InvalidInputArrayException::class);

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
