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
use RoadBunch\Csv;

/**
 * Class WriterTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Csv
 */
class WriterTest extends TestCase
{
    protected $filename;

    public function setUp()
    {
        $this->filename = sprintf('%s/%s.csv', __DIR__, md5(uniqid()));
    }

    public function tearDown()
    {
        if (is_file($this->filename)) {
            unlink($this->filename);
        }
    }

    public function testAddRow()
    {
        $writer = new WriterSpy();
        $rowOne = ['Dan', 'McAdams'];
        $rowTwo = ['Lara', 'McAdams'];

        $writer->addRow($rowOne);
        $writer->addRow($rowTwo);

        $this->assertCount(2, $writer->getRows());
    }

    public function testAddRowsNotArrayOfArrays()
    {
        $this->expectException(Csv\Exception\InvalidInputArrayException::class);
        $writer = new Csv\Writer();
        $rows   = ['Dan', 'McAdams'];

        $writer->addRows($rows);
    }

    public function testAddRows()
    {
        $writer = new WriterSpy();
        $rows   = [
            ['Dan', 'McAdams'],
            ['Lara', 'McAdams'],
            ['Test', 'User']
        ];
        $writer->addRows($rows);
        $moreRows = [
            ['more1', 'row1'],
            ['more2', 'row2'],
            ['more3', 'row3']
        ];
        $writer->addRows($moreRows);
        $this->assertCount(6, $writer->getRows());

        return $writer;
    }

    public function testSetHeader()
    {
        $header = ['first_name', 'last_name'];

        $writer = new WriterSpy();
        $writer->setHeader($header);

        $this->assertInstanceOf(Csv\Header\HeaderInterface::class, $writer->getHeader());
    }

    public function testSetHeaderWithFormatters()
    {
        $writer = new Csv\Writer();
        $rows   = ['fname_one', 'lname_one', 'one@test.com'];
        $writer->addRow($rows);

        $header = ['first_name', 'last_name', 'email_address'];
        $expectedFormattedHeader = ['First Name', 'Last Name', 'Email Address'];
        $formatters = [
            Csv\Formatter\UnderscoreToSpaceFormatter::class,
            Csv\Formatter\UpperCaseWordsFormatter::class
        ];
        $writer->setHeader($header, $formatters);

        $writer->saveToFile($this->filename);
        $this->assertCsvWrittenToFile($expectedFormattedHeader, [$rows]);
    }

    public function testThrowExceptionWhenCantOpenFile()
    {
        $this->expectException(\Exception::class);

        $writer = new Csv\Writer();
        error_reporting(0);
        $writer->saveToFile('');
        error_reporting(1);
    }

    public function testWriteCsvToFile()
    {
        $header = ['first_name', 'last_name', 'email_address'];
        $rows   = [
            ['fname_one', 'lname_one', 'one@test.com'],
            ['fname_two', 'lname_two', 'two@test.com'],
            ['fname_three', 'lname_three', 'three@test.com']
        ];
        $writer = new Csv\Writer();
        $writer->setHeader($header);
        $writer->addRow();
        $writer->addRows($rows);
        $writer->saveToFile($this->filename);

        $handle = fopen($this->filename, 'r');
        $this->assertEquals($header, fgetcsv($handle));
        fclose($handle);

        return $writer;
    }

    /**
     * @depends testWriteCsvToFile
     */
    public function testWriteCsvToNonSeekableStream(Csv\WriterInterface $writer)
    {
        $header = ['first_name', 'last_name', 'email_address'];
        $writer->setHeader($header);

        ob_start();
        $writer->saveToFile('php://output');
        $output = ob_get_clean();

        $this->assertContains(implode(',', $header), $output);
    }

    /**
     * @depends testWriteCsvToFile
     */
    public function testWriteToString(Csv\WriterInterface $writer)
    {
        $header = ['first_name', 'last_name', 'email_address'];
        $writer->setHeader($header);

        $this->assertContains(implode(',', $header), $writer->writeToString());
    }

    /**
     * @depends testWriteCsvToFile
     */
    public function testWriteCsvDifferentLineEndings(Csv\Writer $writer)
    {
        $writer->setNewline(Csv\Newline::NEWLINE_CRLF);
        $writer->saveToFile($this->filename);
        $this->assertLineEnding(Csv\Newline::NEWLINE_CRLF);
    }

    private function assertCsvWrittenToFile($header, $rows)
    {
        $this->assertGreaterThan(0, filesize($this->filename), 'No data written to file');

        $handle = fopen($this->filename, 'r');
        $this->assertEquals($header, fgetcsv($handle));

        foreach ($rows as $row) {
            $this->assertEquals($row, fgetcsv($handle));
        }

        fclose($handle);
    }

    private function assertLineEnding($lineEnding)
    {
        $line = fgets(fopen($this->filename, 'r'));
        $this->assertEquals($lineEnding, substr($line, -2));
    }
}
