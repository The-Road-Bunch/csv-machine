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


class Csv
{
    /** @var array */
    protected $rawData = [];

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
    public function __construct(array $data = [])
    {
        $this->rawData = $data;
    }
}