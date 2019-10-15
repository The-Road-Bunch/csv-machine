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
use RoadBunch\Csv\ArrayToCsv;

class ArrayToCsvTest extends TestCase
{
    const PATH   = __DIR__ . '/temp.csv';
    const HEADER = ['header', 'header'];

    private $handle;

    protected function tearDown()
    {
        if ($this->handle) {
            $this->closeCsv();
        }

        if (is_file(self::PATH)) {
            unlink(self::PATH);
        }
    }

    public function testSetHeader(): void
    {
        $csv = new ArrayToCsv([]);
        $csv->setHeader(self::HEADER);
        $csv->writeToPath(self::PATH);

        $this->assertCsvHasData([], self::HEADER);
    }

    public function testWriteRowsAfterHeader(): void
    {
        $data = [
            ['row1col1', 'row1col2'],
            ['row2col1', 'row2col2']
        ];

        $csv = new ArrayToCsv($data);
        $csv->setHeader(self::HEADER);
        $csv->writeToPath(self::PATH);

        $this->assertCsvHasData($data, self::HEADER);
    }

    private function openCsv()
    {
        $this->handle = fopen(self::PATH, 'r');
    }

    private function closeCsv()
    {
        fclose($this->handle);
    }

    private function assertCsvHasData(array $data, array $header = null): void
    {
        $this->openCsv();

        if ($header) {
            $this->assertEquals($header, fgetcsv($this->handle));
        }

        $csvData = [];
        while ($realRow = fgetcsv($this->handle)) {
            $csvData[] = $realRow;
        }
        $this->assertEquals($data, $csvData);
    }
}
