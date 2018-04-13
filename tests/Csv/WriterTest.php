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
        $writer = new WriterSpy($this->filename);
        $this->assertEquals($this->filename, $writer->getFilename());
    }

    public function testCreateFile()
    {
        new Csv\Writer($this->filename);
        $this->assertTrue(is_file($this->filename), 'File does not exist');
    }

    public function testAddRow()
    {
        $writer = new WriterSpy($this->filename);
        $rowOne = ['Dan', 'McAdams'];
        $rowTwo = ['Lara', 'McAdams'];

        $writer->addRow($rowOne)
               ->addRow($rowTwo);

        $this->assertCount(2, $writer->getRows());
    }

    public function testAddRowsNotArrayOfArrays()
    {
        $this->expectException(Csv\Exception\InvalidInputArrayException::class);
        $writer = new Csv\Writer($this->filename);
        $rows   = ['Dan', 'McAdams'];

        $writer->addRows($rows);
    }

    public function testAddRows()
    {
        $writer = new WriterSpy($this->filename);
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

        $writer = new WriterSpy($this->filename);
        $writer->setHeader($header);

        $this->assertEquals($header, $writer->getHeader());
    }

    /**
     * @depends testAddRows
     * @param Csv\WriterInterface|WriterSpy $writer
     */
    public function testSetHeaderPutsHeaderRowBeforeData(Csv\WriterInterface $writer)
    {
        $header = ['first_name', 'last_name'];

        $writer->setHeader($header);
        $this->assertEquals($header, $writer->getRows()[0]);
    }
}
