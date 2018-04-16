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

    public function testCreateWriter()
    {
        $writer = new WriterSpy();
        $this->assertNotNull($writer);
    }

    public function testAddRow()
    {
        $writer = new WriterSpy();
        $rowOne = ['Dan', 'McAdams'];
        $rowTwo = ['Lara', 'McAdams'];

        $writer->addRow($rowOne)
               ->addRow($rowTwo);

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

        $this->assertCount(count($rows), $writer->getRows());

        return $writer;
    }

    public function testSetHeader()
    {
        $header = ['first_name', 'last_name'];

        $writer = new WriterSpy();
        $writer->setHeader($header);

        $this->assertEquals($header, $writer->getHeader());
    }

    public function testWriteCsvToFile()
    {
        $header = ['first_name', 'last_name', 'email_address'];
        $rows   = [
            ['Dan', 'McAdams', 'dan@test.com'],
            ['Lara', 'McAdams', 'lara@test.com'],
            ['Test', 'User', 'test@test.com']
        ];
        $writer = new Csv\Writer();
        $writer->addRows($rows);
        $writer->setHeader($header);

        $writer->write($this->filename);
        $this->assertCsvWrittenToFile($header, $rows);

        return $writer;
    }

    private function assertCsvWrittenToFile($header, $rows)
    {
        $this->assertGreaterThan(0, filesize($this->filename), 'No data written to file');

        $handle        = fopen($this->filename, 'r');
        $headerFromCSV = fgetcsv($handle);

        $this->assertEquals($header, $headerFromCSV);
        foreach ($rows as $row) {
            $this->assertEquals($row, fgetcsv($handle));
        }

        fclose($handle);
    }

    /**
     * @depends testWriteCsvToFile
     */
    public function testWriteCsvDifferentLineEndings(Csv\Writer $writer)
    {
        $writer->setNewline(Csv\Newline::NEWLINE_CRLF);
        $writer->write($this->filename);
        $this->assertLineEnding(Csv\Newline::NEWLINE_CRLF);
    }

    private function assertLineEnding($lineEnding)
    {
        $line = fgets(fopen($this->filename, 'r'));
        $this->assertEquals($lineEnding, substr($line, -2));
    }
}
