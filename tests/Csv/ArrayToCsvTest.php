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

class ArrayToCsvTest extends TestCase
{
    public function testAddDataSet()
    {
        $data = [];

        $csv = new CsvSpy($data);
        $this->assertEquals($data, $csv->getRawData());

        $data = [['dan', 'mcadams',],['john','doe'],['lara','johnson']];
        $csv = new CsvSpy($data);
        $this->assertEquals($data, $csv->getRawData());

        $data = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'employee_id' => '742617000027'],
            ['first_name' => 'Jane', 'last_name' => 'Jackson', 'employee_id' => '0003645'],
            ['first_name' => 'Dede', 'last_name' => 'Gore', 'employee_id' => 'OMG12324']
        ];
        $csv = new CsvSpy($data);
        $this->assertEquals($data, $csv->getRawData());
    }
}