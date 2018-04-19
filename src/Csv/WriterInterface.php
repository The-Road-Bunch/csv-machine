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

use RoadBunch\Csv\Formatter\FormatterInterface;

/**
 * Interface CsvWriterInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
interface WriterInterface extends CsvInterface
{
    /**
     * @param array $header
     * @param FormatterInterface[] $formatters
     * @return void
     */
    public function setHeader(array $header, array $formatters = []);

    /**
     * @param array $row
     * @return void
     */
    public function addRow(array $row = []);

    /**
     * @param array $rows
     * @return void
     */
    public function addRows(array $rows);

    /**
     * Write the CSV to the stream
     * This can be a file, or any other type of streamable resource
     *
     * Currently the writer will close the handle, so if you pass in php://memory or php://temp, you will lose
     * your information. For now, write to string and file_put_contents. Soon you will be able to open a stream and
     * return the handle
     *
     * 'example.csv', 'php://output'
     *
     * @param string $filename
     */
    public function saveToFile(string $filename);

    /**
     * Return the CSV as a string
     *
     * @return string
     */
    public function writeToString(): string;
}
