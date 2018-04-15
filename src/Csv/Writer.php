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

use RoadBunch\Csv\Exception\InvalidInputArrayException;

/**
 * Class Writer
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class Writer extends Csv implements WriterInterface
{
    /** @var array */
    protected $header;

    /** @var array */
    protected $rows = [];

    /**
     * @param array $header
     */
    public function setHeader(array $header)
    {
        $this->header = $header;
        array_unshift($this->rows, $header);
    }

    /**
     * @param  array $row
     * @return WriterInterface
     */
    public function addRow(array $row): WriterInterface
    {
        $this->rows[] = $row;
        return $this;
    }

    /**
     * @param array $rows
     * @throws InvalidInputArrayException
     */
    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            if (!is_array($row)) {
                throw new InvalidInputArrayException('Element must be an array');
            }
            $this->rows[] = $row;
        }
    }

    /**
     * Write the CSV to the stream
     *
     * @param string $filename
     * @throws \Exception
     */
    public function write(string $filename)
    {
        $handle = $this->openStream($filename);

        foreach ($this->rows as $row) {
            fputcsv($handle, $row, $this->delimiter, $this->enclosure, $this->escape);

            if (is_file($filename)) {
                $this->updateNewLine($handle);
            }
        }

        $this->closeStream($handle);
    }

    /**
     * @param string $filename
     * @return bool|resource
     * @throws \Exception
     */
    private function openStream(string $filename)
    {
        return fopen($filename, 'w+');
    }

    /**
     * @param $handle
     */
    private function closeStream($handle)
    {
        fclose($handle);
    }

    private function updateNewLine($handle)
    {
        if ((Newline::NEWLINE_LF !== $this->newline) && (0 === fseek($handle, -1, SEEK_CUR))) {
            fwrite($handle, $this->newline);
        }
    }
}
