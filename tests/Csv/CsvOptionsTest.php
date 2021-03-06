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
use Psr\Log\NullLogger;
use RoadBunch\Csv as Csv;

/**
 * Class CsvTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Csv
 */
class CsvOptionsTest extends TestCase
{
    public function testCsvAcceptsLogger()
    {
        $csv = new CsvSpy(new NullLogger());
        $this->assertNotNull($csv);
    }

    public function testDefaultOptions()
    {
        $csv = new CsvSpy();
        $this->assertEquals(Csv\Delimiter::DELIMITER_COMMA          , $csv->getDelimiter());
        $this->assertEquals(Csv\Enclosure::ENCLOSURE_DOUBLE_QUOTE   , $csv->getEnclosure());
        $this->assertEquals(Csv\Newline::NEWLINE_LF                 , $csv->getNewline());
        $this->assertEquals(Csv\Escape::ESCAPE_CHAR                 , $csv->getEscapeCharacter());
    }

    public function testSetDelimiter()
    {
        $csv           = new CsvSpy();
        $testDelimiter = Csv\Delimiter::DELIMITER_COLON;

        $csv->setDelimiter($testDelimiter);
        $this->assertEquals($testDelimiter, $csv->getDelimiter());
    }

    public function testSetEnclosure()
    {
        $csv           = new CsvSpy();
        $testEnclosure = Csv\Enclosure::ENCLOSURE_SINGLE_QUOTE;

        $csv->setEnclosure($testEnclosure);
        $this->assertEquals($testEnclosure, $csv->getEnclosure());
    }

    public function testSetNewline()
    {
        $csv         = new CsvSpy();
        $testNewline = Csv\Newline::NEWLINE_CRLF;

        $csv->setNewline($testNewline);
        $this->assertEquals($testNewline, $csv->getNewline());
    }

    public function testSetEscape()
    {
        $csv        = new CsvSpy();
        $testEscape = "esc";

        $csv->setEscape($testEscape);
        $this->assertEquals($testEscape, $csv->getEscapeCharacter());
    }
}
