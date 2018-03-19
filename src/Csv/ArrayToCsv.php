<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv;


use RoadBunch\Csv\Header\Header;
use RoadBunch\Csv\Header\HeaderInterface;

/**
 * Class ArrayToCsv
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class ArrayToCsv
{
    /** @var array */
    protected $rawData;

    /** @var HeaderInterface */
    protected $header;

    /**
     * Csv constructor.
     *
     * Passed data array should be a two dimensional array only or an exception will be thrown
     * when the time comes to build the CSV
     *
     * $data = [
     *      ['first_name' => 'John', 'last_name' => 'Doe', 'employee_id' => '742617000027'],
     *      ['first_name' => 'Jane', 'last_name' => 'Jackson', 'employee_id' => '0003645'],
     *      ['first_name' => 'Dede', 'last_name' => 'Gore', 'OMG12324']
     * ];
     *
     * OR
     *
     * $data = [
     *      ['John', 'Doe', '742617000027'],
     *      ['Jane', 'Jackson', '01011970'],
     *      ['Dede', 'Gore', 'OMG1234']
     * ];
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->rawData = $data;
    }

    /**
     * Will set the header array from the indexes of the two dimensional array
     * if the array is empty, the header will be set to an empty array.
     */
    public function setHeaderFromIndexes()
    {
        if (empty($this->rawData)) {
            $this->header = new Header([]);
            return;
        }
        if ((!isset($this->rawData[0])) || (!is_array($this->rawData[0]))) {
            throw new \InvalidArgumentException('Expected two dimensional array');
        }
        $this->header = new Header(array_keys($this->rawData[0]));
    }
}
