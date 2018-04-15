<?php

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv;

/**
 * Interface CsvWriterInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
interface WriterInterface
{
    /**
     * @param array $header
     */
    public function setHeader(array $header);

    /**
     * @param array $row
     * @return WriterInterface
     */
    public function addRow(array $row): WriterInterface;

    /**
     * @param array $rows
     * @return mixed
     */
    public function addRows(array $rows);

    /**
     * Write the CSV to the stream
     * @param string $filename
     */
    public function write(string $filename);
}
