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
use RoadBunch\Csv\Header\HeaderInterface;

/**
 * Class ArrayToCsvTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Csv
 */
class ArrayToCsvTest extends TestCase
{
    public function testAddDataSet()
    {
        // empty array
        $data = [];
        $csv = new ArrayToCsvSpy($data);
        $this->assertEquals($data, $csv->getRawData());

        // no string indexes
        $data = [['dan', 'mcadams',],['john','doe'],['lara','johnson']];
        $csv = new ArrayToCsvSpy($data);
        $this->assertEquals($data, $csv->getRawData());

        // named indexes
        $data = $this->getSampleCsvData();
        $csv = new ArrayToCsvSpy($data);
        $this->assertEquals($data, $csv->getRawData());
    }

    public function testSetHeaderFromIndexesNotTwoDimensionalArrayThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $data = ['dan', 'mcadams', 'invalid', 'array'];

        $csv = new ArrayToCsvSpy($data);
        $csv->setHeaderFromIndexes();
    }

    public function testSetHeaderFromIndexesEmptyArray()
    {
        $data = [];

        $csv = new ArrayToCsvSpy($data);
        $csv->setHeaderFromIndexes();
        $this->assertInstanceOf(HeaderInterface::class, $csv->getHeader());
        $this->assertEquals([], $csv->getHeader()->getColumns());
    }

    public function testSetHeaderFromIndexes()
    {
        $data = $this->getSampleCsvData();

        $csv = new ArrayToCsvSpy($data);
        $csv->setHeaderFromIndexes();

        $this->assertInstanceOf(HeaderInterface::class, $csv->getHeader());
        $this->assertEquals(array_keys($data[0]), $csv->getHeader()->getColumns());
    }

    public function getSampleCsvData(): array
    {
        $data = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'employee_id' => '742617000027'],
            ['first_name' => 'Jane', 'last_name' => 'Jackson', 'employee_id' => '0003645'],
            ['first_name' => 'Dede', 'last_name' => 'Gore', 'employee_id' => 'OMG12324']
        ];
        return $data;
    }
}
