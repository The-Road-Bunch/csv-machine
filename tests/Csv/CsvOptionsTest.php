<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Csv;


use PHPUnit\Framework\TestCase;
use RoadBunch\Csv as Csv;

/**
 * Class CsvTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Csv
 */
class CsvOptionsTest extends TestCase
{
    public function testSetDefaults()
    {
        $csv = new CsvSpy();
        $this->assertEquals(Csv\Delimiter::DELIMITER_COMMA, $csv->getDelimiter(), 'test message');
        $this->assertEquals(Csv\Enclosure::ENCLOSURE_DOUBLE_QUOTE, $csv->getEnclosure());
        $this->assertEquals(Csv\Newline::NEWLINE_LF, $csv->getNewline());
        $this->assertEquals(Csv\Escape::ESCAPE_CHAR, $csv->getEscapeCharacter());
    }

    public function testSetDelimiter()
    {
        $csv           = new CsvSpy();
        $testDelimiter = ":";

        $csv->setDelimiter($testDelimiter);
        $this->assertEquals($testDelimiter, $csv->getDelimiter());
    }

    public function testSetEnclosure()
    {
        $csv           = new CsvSpy();
        $testEnclosure = "'";

        $csv->setEnclosure($testEnclosure);
        $this->assertEquals($testEnclosure, $csv->getEnclosure());
    }

    public function testSetNewline()
    {
        $csv        = new CsvSpy();
        $testNewline = "\r\n";

        $csv->setNewline($testNewline);
        $this->assertEquals($testNewline, $csv->getNewline());
    }

    public function testSetEscape()
    {
        $csv = new CsvSpy();
        $testEscape = "/";

        $csv->setEscape($testEscape);
        $this->assertEquals($testEscape, $csv->getEscapeCharacter());
    }
}
